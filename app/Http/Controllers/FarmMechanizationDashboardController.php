<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FarmMechanizationDashboardController extends Controller
{
    public function index()
    {
        $filterDateFrom = '';
        $filterDateTo = '';

        $collections = DB::table('farm_mechanization_cash_collections')->select(DB::raw('SUM(fees_charge) as total_collection'))->first();

        $pendingVisitationCount = DB::table('farm_mechanizations as a')->where('a.request_status', 0)->select(DB::raw('COUNT(a.id) as total_count'))->first();

        $approvedVisitationCount = DB::table('farm_mechanizations as a')->where('a.request_status', 1)->select(DB::raw('COUNT(a.id) as total_count'))->first();

        $scheduledVisitationCount = DB::table('farm_mechanizations as a')->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')->where('a.request_status', 2)->select(DB::raw('COUNT(a.id) as total_count'))->first();

        $servedClientsCount = DB::table('farm_mechanizations as a')->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')->where('a.request_status', 3)->select(DB::raw('COUNT(a.id) as total_count'))->first();

        //Client Request Summary
        $totalClientRequestCount = DB::table('farm_mechanizations as a')->select(DB::raw('COUNT(a.id) as total_count'))->first();

        $averageClientRequestPerDayCount = DB::table('farm_mechanizations as a')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) {
                $query->from('farm_mechanizations as a')->select('a.visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('a.visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageClientRequestPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('farm_mechanizations')->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyData = DB::table('farm_mechanizations')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartData = [];
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $years = [];

        foreach ($monthlyData as $data) {
            $years[$data->year] = true;
            $chartData[$data->year][$data->month - 1] = $data->total_clients;
        }

        foreach ($years as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartData[$year][$i])) {
                    $chartData[$year][$i] = 0;
                }
            }
            ksort($chartData[$year]);
        }

        $colors = [];
        foreach ($years as $year => $_) {
            $colors[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasets = [];
        foreach ($chartData as $year => $dataPoints) {
            $datasets[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colors[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        //Area Request Summary
        $totalAreaRequestTotal = DB::table('farm_mechanizations as a')->select(DB::raw('SUM(a.area_size) as total_area'))->first();

        $averageAreaRequestPerDayTotal = DB::table('farm_mechanizations as a')
            ->select(DB::raw('AVG(daily.total_area) as average_area_total'))
            ->fromSub(function ($query) {
                $query->from('farm_mechanizations as a')->select('a.visitation_schedule', DB::raw('SUM(a.area_size) as total_area'))->groupBy('a.visitation_schedule');
            }, 'daily')
            ->value('average_area_count');

        $averageAreaRequestPerMonthTotal = DB::query()
            ->fromSub(function ($query) {
                $query->from('farm_mechanizations')->select(DB::raw('SUM(area_size) as total_area'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_area) as average_area_total'))
            ->value('average_area_total');

        $monthlyAreaData = DB::table('farm_mechanizations')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('SUM(area_size) as total_area'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartAreaData = [];
        $labelsArea = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsArea = [];

        foreach ($monthlyAreaData as $areaData) {
            $yearsArea[$areaData->year] = true;
            $chartAreaData[$areaData->year][$areaData->month - 1] = $areaData->total_area;
        }

        foreach ($yearsArea as $areaYear => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartAreaData[$areaYear][$i])) {
                    $chartAreaData[$areaYear][$i] = 0;
                }
            }
            ksort($chartAreaData[$areaYear]);
        }

        $colorsArea = [];
        foreach ($yearsArea as $areaYear => $_) {
            $colorsArea[$areaYear] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsArea = [];
        foreach ($chartAreaData as $areaYear => $dataPoints) {
            $datasetsArea[] = [
                'label' => $areaYear,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsArea[$areaYear],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        //Clients Served Summary
        $totalClientsServedCount = DB::table('farm_mechanizations as a')->where('a.request_status', 3)->select(DB::raw('COUNT(a.id) as total_count'))->first();

        $averageClientsServedPerDayCount = DB::table(DB::raw('(select visitation_schedule, COUNT(*) as total_count from farm_mechanizations where request_status = 3 group by visitation_schedule) as daily'))->select(DB::raw('AVG(daily.total_count) as average_count'))->value('average_count');

        $averageClientsServedPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('farm_mechanizations')->where('request_status', 3)->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyClientsServedData = DB::table('farm_mechanizations')->where('request_status', 3)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartClientsServedData = [];
        $labelsClientsServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsClientsServed = [];

        foreach ($monthlyClientsServedData as $data) {
            $yearsClientsServed[$data->year] = true;
            $chartClientsServedData[$data->year][$data->month - 1] = $data->total_clients;
        }

        foreach ($yearsClientsServed as $yearClientsServed => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartClientsServedData[$yearClientsServed][$i])) {
                    $chartClientsServedData[$yearClientsServed][$i] = 0;
                }
            }
            ksort($chartClientsServedData[$yearClientsServed]);
        }

        $colorsClientsServed = [];
        foreach ($yearsClientsServed as $yearClientsServed => $_) {
            $colorsClientsServed[$yearClientsServed] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsClientsServed = [];
        foreach ($chartClientsServedData as $yearClientsServed => $dataPoints) {
            $datasetsClientsServed[] = [
                'label' => $yearClientsServed,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsClientsServed[$yearClientsServed],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        //Area Served Summary
        $totalAreaServedTotal = DB::table('farm_mechanizations as a')->where('a.request_status', 3)->select(DB::raw('SUM(a.area_size) as total_area'))->first();

        $averageAreaServedPerDayTotal = DB::table(DB::raw('(select visitation_schedule, SUM(area_size) as total_area from farm_mechanizations where request_status = 3 group by visitation_schedule) as daily'))->select(DB::raw('AVG(daily.total_area) as average_count'))->value('average_count');

        $averageAreaServedPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('farm_mechanizations')->where('request_status', 3)->select(DB::raw('SUM(area_size) as total_area'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_area) as average_count'))
            ->value('average_count');

        $monthlyAreaServedData = DB::table('farm_mechanizations')->where('request_status', 3)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('SUM(area_size) as total_area'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartAreaServedData = [];
        $labelsAreaServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsAreaServed = [];

        foreach ($monthlyAreaServedData as $areaServedData) {
            $yearsAreaServed[$areaServedData->year] = true;
            $chartAreaServedData[$areaServedData->year][$areaServedData->month - 1] = $areaServedData->total_area;
        }

        foreach ($yearsAreaServed as $areaServedYear => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartAreaServedData[$areaServedYear][$i])) {
                    $chartAreaServedData[$areaServedYear][$i] = 0;
                }
            }
            ksort($chartAreaServedData[$areaServedYear]);
        }

        $colorsAreaServed = [];
        foreach ($yearsAreaServed as $areaServedYear => $_) {
            $colorsAreaServed[$areaServedYear] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsAreaServed = [];
        foreach ($chartAreaServedData as $areaServedYear => $dataPoints) {
            $datasetsAreaServed[] = [
                'label' => $areaServedYear,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsAreaServed[$areaServedYear],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        return view('userviews.services.dashboard.farmmechanization.index', [
            'filterDateFrom' => $filterDateFrom,
            'filterDateTo' => $filterDateTo,
            'pendingVisitationCount' => $pendingVisitationCount,
            'approvedVisitationCount' => $approvedVisitationCount,
            'scheduledVisitationCount' => $scheduledVisitationCount,
            'servedClientsCount' => $servedClientsCount,
            'totalClientRequestCount' => $totalClientRequestCount,
            'averageClientRequestPerDayCount' => $averageClientRequestPerDayCount,
            'averageClientRequestPerMonthCount' => $averageClientRequestPerMonthCount,
            'labels' => $labels,
            'datasets' => $datasets,
            'labelsArea' => $labelsArea,
            'datasetsArea' => $datasetsArea,
            'labelsClientsServed' => $labelsClientsServed,
            'datasetsClientsServed' => $datasetsClientsServed,
            'labelsAreaServed' => $labelsAreaServed,
            'datasetsAreaServed' => $datasetsAreaServed,
            'totalAreaServedTotal' => $totalAreaServedTotal,
            'averageAreaServedPerDayTotal' => $averageAreaServedPerDayTotal,
            'averageAreaServedPerMonthCount' => $averageAreaServedPerMonthCount,
            'totalClientsServedCount' => $totalClientsServedCount,
            'averageClientsServedPerDayCount' => $averageClientsServedPerDayCount,
            'averageClientsServedPerMonthCount' => $averageClientsServedPerMonthCount,
            'chartClientsServedData' => $chartClientsServedData,
            'totalAreaRequestTotal' => $totalAreaRequestTotal,
            'averageAreaRequestPerDayTotal' => $averageAreaRequestPerDayTotal,
            'averageAreaRequestPerMonthTotal' => $averageAreaRequestPerMonthTotal,
            'collections' => $collections,
        ]);
    }

    public function search(Request $request)
    {
        $filterDateFrom = $request->input('start');
        $filterDateTo = $request->input('end');

        $collections = DB::table('farm_mechanization_cash_collections')
            ->whereBetween('date_approved', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('SUM(fees_charge) as total_collection'))
            ->first();

        $pendingVisitationCount = DB::table('farm_mechanizations as a')
            ->where('a.request_status', 0)
            ->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $approvedVisitationCount = DB::table('farm_mechanizations as a')
            ->where('a.request_status', 1)
            ->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $scheduledVisitationCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            ->where('a.request_status', 2)
            ->whereBetween('a.visitation_schedule', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $servedClientsCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            ->where('a.request_status', 3)
            ->whereBetween('b.final_schedule', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        //Client Request Summary
        $totalClientRequestCount = DB::table('farm_mechanizations as a')
            ->whereBetween('a.visitation_schedule', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $averageClientRequestPerDayCount = DB::table('farm_mechanizations as a')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query
                    ->from('farm_mechanizations as a')
                    ->select('a.visitation_schedule', DB::raw('COUNT(*) as total_count'))
                    ->whereBetween('a.visitation_schedule', [$filterDateFrom, $filterDateTo])
                    ->groupBy('a.visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageClientRequestPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query
                    ->from('farm_mechanizations')
                    ->select(DB::raw('COUNT(*) as total_count'))
                    ->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])
                    ->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyData = DB::table('farm_mechanizations')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartData = [];
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $years = [];

        foreach ($monthlyData as $data) {
            $years[$data->year] = true;
            $chartData[$data->year][$data->month - 1] = $data->total_clients;
        }

        foreach ($years as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartData[$year][$i])) {
                    $chartData[$year][$i] = 0;
                }
            }
            ksort($chartData[$year]);
        }

        $colors = [];
        foreach ($years as $year => $_) {
            $colors[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasets = [];
        foreach ($chartData as $year => $dataPoints) {
            $datasets[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colors[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        //Area Request Summary
        $totalAreaRequestTotal = DB::table('farm_mechanizations as a')
            ->whereBetween('a.visitation_schedule', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('SUM(a.area_size) as total_area'))
            ->first();

        $averageAreaRequestPerDayTotal = DB::table('farm_mechanizations as a')
            ->select(DB::raw('AVG(daily.total_area) as average_area_total'))
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query
                    ->from('farm_mechanizations as a')
                    ->select('a.visitation_schedule', DB::raw('SUM(a.area_size) as total_area'))
                    ->whereBetween('a.visitation_schedule', [$filterDateFrom, $filterDateTo])
                    ->groupBy('a.visitation_schedule');
            }, 'daily')
            ->value('average_area_total');

        $averageAreaRequestPerMonthTotal = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query
                    ->from('farm_mechanizations')
                    ->select(DB::raw('SUM(area_size) as total_area'))
                    ->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])
                    ->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_area) as average_area_total'))
            ->value('average_area_total');

        $monthlyAreaData = DB::table('farm_mechanizations')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('SUM(area_size) as total_area'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartAreaData = [];
        $labelsArea = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsArea = [];

        foreach ($monthlyAreaData as $areaData) {
            $yearsArea[$areaData->year] = true;
            $chartAreaData[$areaData->year][$areaData->month - 1] = $areaData->total_area;
        }

        foreach ($yearsArea as $areaYear => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartAreaData[$areaYear][$i])) {
                    $chartAreaData[$areaYear][$i] = 0;
                }
            }
            ksort($chartAreaData[$areaYear]);
        }

        $colorsArea = [];
        foreach ($yearsArea as $areaYear => $_) {
            $colorsArea[$areaYear] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsArea = [];
        foreach ($chartAreaData as $areaYear => $dataPoints) {
            $datasetsArea[] = [
                'label' => $areaYear,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsArea[$areaYear],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        //Clients Served Summary
        $totalClientsServedCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', '=', 'b.farm_mechanization_id')
            ->where('a.request_status', 3)
            ->whereBetween('b.final_schedule', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $averageClientsServedPerDayCount = DB::table(
            DB::raw("
                (
                    SELECT a.visitation_schedule, COUNT(*) as total_count
                    FROM farm_mechanizations a
                    JOIN farm_mechanization_cash_collections b ON a.id = b.farm_mechanization_id
                    WHERE a.request_status = 3
                    AND b.final_schedule BETWEEN '$filterDateFrom' AND '$filterDateTo'
                    GROUP BY a.visitation_schedule
                ) as daily
            "),
        )
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->value('average_count');

        $averageClientsServedPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query
                    ->from('farm_mechanizations as a')
                    ->join('farm_mechanization_cash_collections as b', 'a.id', '=', 'b.farm_mechanization_id')
                    ->where('a.request_status', 3)
                    ->whereBetween('b.final_schedule', [$filterDateFrom, $filterDateTo])
                    ->select(DB::raw('COUNT(*) as total_count'))
                    ->groupBy(DB::raw('DATE_FORMAT(a.visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyClientsServedData = DB::table('farm_mechanizations')->where('request_status', 3)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartClientsServedData = [];
        $labelsClientsServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsClientsServed = [];

        foreach ($monthlyClientsServedData as $data) {
            $yearsClientsServed[$data->year] = true;
            $chartClientsServedData[$data->year][$data->month - 1] = $data->total_clients;
        }

        foreach ($yearsClientsServed as $yearClientsServed => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartClientsServedData[$yearClientsServed][$i])) {
                    $chartClientsServedData[$yearClientsServed][$i] = 0;
                }
            }
            ksort($chartClientsServedData[$yearClientsServed]);
        }

        $colorsClientsServed = [];
        foreach ($yearsClientsServed as $yearClientsServed => $_) {
            $colorsClientsServed[$yearClientsServed] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsClientsServed = [];
        foreach ($chartClientsServedData as $yearClientsServed => $dataPoints) {
            $datasetsClientsServed[] = [
                'label' => $yearClientsServed,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsClientsServed[$yearClientsServed],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        //Area Served Summary
        $totalAreaServedTotal = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', '=', 'b.farm_mechanization_id')
            ->where('a.request_status', 3)
            ->whereBetween('b.final_schedule', [$filterDateFrom, $filterDateTo])
            ->select(DB::raw('SUM(a.area_size) as total_area'))
            ->first();

        $averageAreaServedPerDayTotal = DB::table(
            DB::raw("
                (
                    SELECT a.visitation_schedule, SUM(a.area_size) as total_area
                    FROM farm_mechanizations a
                    JOIN farm_mechanization_cash_collections b ON a.id = b.farm_mechanization_id
                    WHERE a.request_status = 3
                    AND b.final_schedule BETWEEN '$filterDateFrom' AND '$filterDateTo'
                    GROUP BY a.visitation_schedule
                ) as daily
            "),
        )
            ->select(DB::raw('AVG(daily.total_area) as average_count'))
            ->value('average_count');

        $averageAreaServedPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query
                    ->from('farm_mechanizations as a')
                    ->join('farm_mechanization_cash_collections as b', 'a.id', '=', 'b.farm_mechanization_id')
                    ->where('a.request_status', 3)
                    ->whereBetween('b.final_schedule', [$filterDateFrom, $filterDateTo])
                    ->select(DB::raw('SUM(a.area_size) as total_area'))
                    ->groupBy(DB::raw('DATE_FORMAT(a.visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_area) as average_count'))
            ->value('average_count');

        $monthlyAreaServedData = DB::table('farm_mechanizations')->where('request_status', 3)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('SUM(area_size) as total_area'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartAreaServedData = [];
        $labelsAreaServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsAreaServed = [];

        foreach ($monthlyAreaServedData as $areaServedData) {
            $yearsAreaServed[$areaServedData->year] = true;
            $chartAreaServedData[$areaServedData->year][$areaServedData->month - 1] = $areaServedData->total_area;
        }

        foreach ($yearsAreaServed as $areaServedYear => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartAreaServedData[$areaServedYear][$i])) {
                    $chartAreaServedData[$areaServedYear][$i] = 0;
                }
            }
            ksort($chartAreaServedData[$areaServedYear]);
        }

        $colorsAreaServed = [];
        foreach ($yearsAreaServed as $areaServedYear => $_) {
            $colorsAreaServed[$areaServedYear] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsAreaServed = [];
        foreach ($chartAreaServedData as $areaServedYear => $dataPoints) {
            $datasetsAreaServed[] = [
                'label' => $areaServedYear,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsAreaServed[$areaServedYear],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        return view('userviews.services.dashboard.farmmechanization.index', [
            'filterDateFrom' => $filterDateFrom,
            'filterDateTo' => $filterDateTo,
            'pendingVisitationCount' => $pendingVisitationCount,
            'approvedVisitationCount' => $approvedVisitationCount,
            'scheduledVisitationCount' => $scheduledVisitationCount,
            'servedClientsCount' => $servedClientsCount,
            'totalClientRequestCount' => $totalClientRequestCount,
            'averageClientRequestPerDayCount' => $averageClientRequestPerDayCount,
            'averageClientRequestPerMonthCount' => $averageClientRequestPerMonthCount,
            'labels' => $labels,
            'datasets' => $datasets,
            'labelsArea' => $labelsArea,
            'datasetsArea' => $datasetsArea,
            'labelsClientsServed' => $labelsClientsServed,
            'datasetsClientsServed' => $datasetsClientsServed,
            'labelsAreaServed' => $labelsAreaServed,
            'datasetsAreaServed' => $datasetsAreaServed,
            'totalAreaServedTotal' => $totalAreaServedTotal,
            'averageAreaServedPerDayTotal' => $averageAreaServedPerDayTotal,
            'averageAreaServedPerMonthCount' => $averageAreaServedPerMonthCount,
            'totalClientsServedCount' => $totalClientsServedCount,
            'averageClientsServedPerDayCount' => $averageClientsServedPerDayCount,
            'averageClientsServedPerMonthCount' => $averageClientsServedPerMonthCount,
            'chartClientsServedData' => $chartClientsServedData,
            'totalAreaRequestTotal' => $totalAreaRequestTotal,
            'averageAreaRequestPerDayTotal' => $averageAreaRequestPerDayTotal,
            'averageAreaRequestPerMonthTotal' => $averageAreaRequestPerMonthTotal,
            'collections' => $collections,
        ]);
    }
}
