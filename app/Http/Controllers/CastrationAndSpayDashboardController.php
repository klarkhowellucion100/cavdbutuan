<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CastrationAndSpay;
use Illuminate\Support\Facades\DB;

class CastrationAndSpayDashboardController extends Controller
{
    public function index()
    {
        $filterDateFrom = '';
        $filterDateTo = '';

        $totalClientRequestCount = DB::table('castration_and_spays')->select(DB::raw('COUNT(id) as total_count'))->first();

        $totalClientsServedCount = DB::table('castration_and_spays')->where('request_status', 1)->select(DB::raw('COUNT(id) as total_count'))->first();

        //Overall Requests Count
        $totalOverallRequestCount = DB::table('castration_and_spays')->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageOverallRequestPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageOverallRequestPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyOverallData = DB::table('castration_and_spays')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartOverallData = [];
        $labelsOverall = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsOverall = [];

        foreach ($monthlyOverallData as $dataOverall) {
            $yearsOverall[$dataOverall->year] = true;
            $chartOverallData[$dataOverall->year][$dataOverall->month - 1] = $dataOverall->total_clients;
        }

        foreach ($yearsOverall as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartOverallData[$year][$i])) {
                    $chartOverallData[$year][$i] = 0;
                }
            }
            ksort($chartOverallData[$year]);
        }

        $colorsOverall = [];
        foreach ($yearsOverall as $year => $_) {
            $colorsOverall[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsOverall = [];
        foreach ($chartOverallData as $year => $dataPoints) {
            $datasetsOverall[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsOverall[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupOverall = CastrationAndSpay::select('animal_type', DB::raw('COUNT(*) as total_per_group'))->groupBy('animal_type')->get();

        //Overall Served Count
        $totalOverallServedCount = DB::table('castration_and_spays')->where('request_status', 1)->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageOverallServedPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('request_status', 1)->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageOverallServedPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('request_status', 1)->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyOverallServedData = DB::table('castration_and_spays')->where('request_status', 1)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartOverallServedData = [];
        $labelsOverallServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsOverallServed = [];

        foreach ($monthlyOverallServedData as $dataOverallServed) {
            $yearsOverallServed[$dataOverallServed->year] = true;
            $chartOverallServedData[$dataOverallServed->year][$dataOverallServed->month - 1] = $dataOverallServed->total_clients;
        }

        foreach ($yearsOverallServed as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartOverallServedData[$year][$i])) {
                    $chartOverallServedData[$year][$i] = 0;
                }
            }
            ksort($chartOverallServedData[$year]);
        }

        $colorsOverallServed = [];
        foreach ($yearsOverallServed as $year => $_) {
            $colorsOverallServed[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsOverallServed = [];
        foreach ($chartOverallServedData as $year => $dataPoints) {
            $datasetsOverallServed[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsOverallServed[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupOverallServed = CastrationAndSpay::select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('request_status', 1)->groupBy('animal_type')->get();

        //Castration Requests Count
        $totalCastrationRequestCount = DB::table('castration_and_spays')->where('service_type', 'Castration')->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageCastrationRequestPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('service_type', 'Castration')->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageCastrationRequestPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('service_type', 'Castration')->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyCastrationData = DB::table('castration_and_spays')->where('service_type', 'Castration')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartCastrationData = [];
        $labelsCastration = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsCastration = [];

        foreach ($monthlyCastrationData as $dataCastration) {
            $yearsCastration[$dataCastration->year] = true;
            $chartCastrationData[$dataCastration->year][$dataCastration->month - 1] = $dataCastration->total_clients;
        }

        foreach ($yearsCastration as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartCastrationData[$year][$i])) {
                    $chartCastrationData[$year][$i] = 0;
                }
            }
            ksort($chartCastrationData[$year]);
        }

        $colorsCastration = [];
        foreach ($yearsCastration as $year => $_) {
            $colorsCastration[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsCastration = [];
        foreach ($chartCastrationData as $year => $dataPoints) {
            $datasetsCastration[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsCastration[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupCastration = CastrationAndSpay::select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('service_type', 'Castration')->groupBy('animal_type')->get();

        //Castration Served Count
        $totalCastrationServedCount = DB::table('castration_and_spays')->where('service_type', 'Castration')->where('request_status', 1)->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageCastrationServedPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('service_type', 'Castration')->where('request_status', 1)->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageCastrationServedPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('service_type', 'Castration')->where('request_status', 1)->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyCastrationServedData = DB::table('castration_and_spays')->where('service_type', 'Castration')->where('request_status', 1)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartCastrationServedData = [];
        $labelsCastrationServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsCastrationServed = [];

        foreach ($monthlyCastrationServedData as $dataCastrationServed) {
            $yearsCastrationServed[$dataCastrationServed->year] = true;
            $chartCastrationServedData[$dataCastrationServed->year][$dataCastrationServed->month - 1] = $dataCastrationServed->total_clients;
        }

        foreach ($yearsCastrationServed as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartCastrationServedData[$year][$i])) {
                    $chartCastrationServedData[$year][$i] = 0;
                }
            }
            ksort($chartCastrationServedData[$year]);
        }

        $colorsCastrationServed = [];
        foreach ($yearsCastrationServed as $year => $_) {
            $colorsCastrationServed[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsCastrationServed = [];
        foreach ($chartCastrationServedData as $year => $dataPoints) {
            $datasetsCastrationServed[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsCastrationServed[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupCastrationServed = CastrationAndSpay::select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('service_type', 'Castration')->where('request_status', 1)->groupBy('animal_type')->get();

        //Spay Requests Count
        $totalSpayRequestCount = DB::table('castration_and_spays')->where('service_type', 'Spay')->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageSpayRequestPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('service_type', 'Spay')->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageSpayRequestPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('service_type', 'Spay')->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlySpayData = DB::table('castration_and_spays')->where('service_type', 'Spay')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartSpayData = [];
        $labelsSpay = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsSpay = [];

        foreach ($monthlySpayData as $dataSpay) {
            $yearsSpay[$dataSpay->year] = true;
            $chartSpayData[$dataSpay->year][$dataSpay->month - 1] = $dataSpay->total_clients;
        }

        foreach ($yearsSpay as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartSpayData[$year][$i])) {
                    $chartSpayData[$year][$i] = 0;
                }
            }
            ksort($chartSpayData[$year]);
        }

        $colorsSpay = [];
        foreach ($yearsSpay as $year => $_) {
            $colorsSpay[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsSpay = [];
        foreach ($chartSpayData as $year => $dataPoints) {
            $datasetsSpay[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsSpay[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupSpay = CastrationAndSpay::select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('service_type', 'Spay')->groupBy('animal_type')->get();

        //Spay Served Count
        $totalSpayServedCount = DB::table('castration_and_spays')->where('service_type', 'Spay')->where('request_status', 1)->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageSpayServedPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('service_type', 'Spay')->where('request_status', 1)->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageSpayServedPerMonthCount = DB::query()
            ->fromSub(function ($query) {
                $query->from('castration_and_spays')->where('service_type', 'Spay')->where('request_status', 1)->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlySpayServedData = DB::table('castration_and_spays')->where('service_type', 'Spay')->where('request_status', 1)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartSpayServedData = [];
        $labelsSpayServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsSpayServed = [];

        foreach ($monthlySpayServedData as $dataCastrationServed) {
            $yearsSpayServed[$dataCastrationServed->year] = true;
            $chartSpayServedData[$dataCastrationServed->year][$dataCastrationServed->month - 1] = $dataCastrationServed->total_clients;
        }

        foreach ($yearsSpayServed as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartSpayServedData[$year][$i])) {
                    $chartSpayServedData[$year][$i] = 0;
                }
            }
            ksort($chartSpayServedData[$year]);
        }

        $colorsSpayServed = [];
        foreach ($yearsSpayServed as $year => $_) {
            $colorsSpayServed[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsSpayServed = [];
        foreach ($chartSpayServedData as $year => $dataPoints) {
            $datasetsSpayServed[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsSpayServed[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupSpayServed = CastrationAndSpay::select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('service_type', 'Spay')->where('request_status', 1)->groupBy('animal_type')->get();

        return view('userviews.services.dashboard.castrationandspay.index', [
            'totalClientRequestCount' => $totalClientRequestCount,
            'totalClientsServedCount' => $totalClientsServedCount,

            'filterDateFrom' => $filterDateFrom,
            'filterDateTo' => $filterDateTo,

            'totalCastrationRequestCount' => $totalCastrationRequestCount,
            'averageCastrationRequestPerDayCount' => $averageCastrationRequestPerDayCount,
            'averageCastrationRequestPerMonthCount' => $averageCastrationRequestPerMonthCount,
            'labelsCastration' => $labelsCastration,
            'datasetsCastration' => $datasetsCastration,
            'animalGroupCastration' => $animalGroupCastration,

            'totalCastrationServedCount' => $totalCastrationServedCount,
            'averageCastrationServedPerDayCount' => $averageCastrationServedPerDayCount,
            'averageCastrationServedPerMonthCount' => $averageCastrationServedPerMonthCount,
            'labelsCastrationServed' => $labelsCastrationServed,
            'datasetsCastrationServed' => $datasetsCastrationServed,
            'animalGroupCastrationServed' => $animalGroupCastrationServed,

            'totalSpayRequestCount' => $totalSpayRequestCount,
            'averageSpayRequestPerDayCount' => $averageSpayRequestPerDayCount,
            'averageSpayRequestPerMonthCount' => $averageSpayRequestPerMonthCount,
            'labelsSpay' => $labelsSpay,
            'datasetsSpay' => $datasetsSpay,
            'animalGroupSpay' => $animalGroupSpay,

            'totalSpayServedCount' => $totalSpayServedCount,
            'averageSpayServedPerDayCount' => $averageSpayServedPerDayCount,
            'averageSpayServedPerMonthCount' => $averageSpayServedPerMonthCount,
            'labelsSpayServed' => $labelsSpayServed,
            'datasetsSpayServed' => $datasetsSpayServed,
            'animalGroupSpayServed' => $animalGroupSpayServed,

            'totalOverallRequestCount' => $totalOverallRequestCount,
            'averageOverallRequestPerDayCount' => $averageOverallRequestPerDayCount,
            'averageOverallRequestPerMonthCount' => $averageOverallRequestPerMonthCount,
            'labelsOverall' => $labelsOverall,
            'datasetsOverall' => $datasetsOverall,
            'animalGroupOverall' => $animalGroupOverall,

            'totalOverallServedCount' => $totalOverallServedCount,
            'averageOverallServedPerDayCount' => $averageOverallServedPerDayCount,
            'averageOverallServedPerMonthCount' => $averageOverallServedPerMonthCount,
            'labelsOverallServed' => $labelsOverallServed,
            'datasetsOverallServed' => $datasetsOverallServed,
            'animalGroupOverallServed' => $animalGroupOverallServed
        ]);
    }

    public function search(Request $request)
    {
        $filterDateFrom = $request->input('start');
        $filterDateTo = $request->input('end');

        $totalClientRequestCount = DB::table('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select(DB::raw('COUNT(id) as total_count'))->first();

        $totalClientsServedCount = DB::table('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('request_status', 1)->select(DB::raw('COUNT(id) as total_count'))->first();

        //Overall Requests Count
        $totalOverallRequestCount = DB::table('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageOverallRequestPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageOverallRequestPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->select(DB::raw('COUNT(*) as total_count'))->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyOverallData = DB::table('castration_and_spays')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartOverallData = [];
        $labelsOverall = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsOverall = [];

        foreach ($monthlyOverallData as $dataOverall) {
            $yearsOverall[$dataOverall->year] = true;
            $chartOverallData[$dataOverall->year][$dataOverall->month - 1] = $dataOverall->total_clients;
        }

        foreach ($yearsOverall as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartOverallData[$year][$i])) {
                    $chartOverallData[$year][$i] = 0;
                }
            }
            ksort($chartOverallData[$year]);
        }

        $colorsOverall = [];
        foreach ($yearsOverall as $year => $_) {
            $colorsOverall[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsOverall = [];
        foreach ($chartOverallData as $year => $dataPoints) {
            $datasetsOverall[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsOverall[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupOverall = CastrationAndSpay::whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select('animal_type', DB::raw('COUNT(*) as total_per_group'))->groupBy('animal_type')->get();

        //Overall Served Count
        $totalOverallServedCount = DB::table('castration_and_spays')->where('request_status', 1)->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageOverallServedPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->where('request_status', 1)->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageOverallServedPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->where('request_status', 1)->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyOverallServedData = DB::table('castration_and_spays')->where('request_status', 1)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartOverallServedData = [];
        $labelsOverallServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsOverallServed = [];

        foreach ($monthlyOverallServedData as $dataOverallServed) {
            $yearsOverallServed[$dataOverallServed->year] = true;
            $chartOverallServedData[$dataOverallServed->year][$dataOverallServed->month - 1] = $dataOverallServed->total_clients;
        }

        foreach ($yearsOverallServed as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartOverallServedData[$year][$i])) {
                    $chartOverallServedData[$year][$i] = 0;
                }
            }
            ksort($chartOverallServedData[$year]);
        }

        $colorsOverallServed = [];
        foreach ($yearsOverallServed as $year => $_) {
            $colorsOverallServed[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsOverallServed = [];
        foreach ($chartOverallServedData as $year => $dataPoints) {
            $datasetsOverallServed[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsOverallServed[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupOverallServed = CastrationAndSpay::whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('request_status', 1)->groupBy('animal_type')->get();

        //Castration Requests Count
        $totalCastrationRequestCount = DB::table('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Castration')->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageCastrationRequestPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Castration')->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageCastrationRequestPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Castration')->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyCastrationData = DB::table('castration_and_spays')->where('service_type', 'Castration')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartCastrationData = [];
        $labelsCastration = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsCastration = [];

        foreach ($monthlyCastrationData as $dataCastration) {
            $yearsCastration[$dataCastration->year] = true;
            $chartCastrationData[$dataCastration->year][$dataCastration->month - 1] = $dataCastration->total_clients;
        }

        foreach ($yearsCastration as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartCastrationData[$year][$i])) {
                    $chartCastrationData[$year][$i] = 0;
                }
            }
            ksort($chartCastrationData[$year]);
        }

        $colorsCastration = [];
        foreach ($yearsCastration as $year => $_) {
            $colorsCastration[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsCastration = [];
        foreach ($chartCastrationData as $year => $dataPoints) {
            $datasetsCastration[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsCastration[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupCastration = CastrationAndSpay::whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('service_type', 'Castration')->groupBy('animal_type')->get();

        //Castration Served Count
        $totalCastrationServedCount = DB::table('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Castration')->where('request_status', 1)->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageCastrationServedPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Castration')->where('request_status', 1)->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageCastrationServedPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Castration')->where('request_status', 1)->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlyCastrationServedData = DB::table('castration_and_spays')->where('service_type', 'Castration')->where('request_status', 1)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartCastrationServedData = [];
        $labelsCastrationServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsCastrationServed = [];

        foreach ($monthlyCastrationServedData as $dataCastrationServed) {
            $yearsCastrationServed[$dataCastrationServed->year] = true;
            $chartCastrationServedData[$dataCastrationServed->year][$dataCastrationServed->month - 1] = $dataCastrationServed->total_clients;
        }

        foreach ($yearsCastrationServed as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartCastrationServedData[$year][$i])) {
                    $chartCastrationServedData[$year][$i] = 0;
                }
            }
            ksort($chartCastrationServedData[$year]);
        }

        $colorsCastrationServed = [];
        foreach ($yearsCastrationServed as $year => $_) {
            $colorsCastrationServed[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsCastrationServed = [];
        foreach ($chartCastrationServedData as $year => $dataPoints) {
            $datasetsCastrationServed[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsCastrationServed[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupCastrationServed = CastrationAndSpay::whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('service_type', 'Castration')->where('request_status', 1)->groupBy('animal_type')->get();

        //Spay Requests Count
        $totalSpayRequestCount = DB::table('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Spay')->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageSpayRequestPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Spay')->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageSpayRequestPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Spay')->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlySpayData = DB::table('castration_and_spays')->where('service_type', 'Spay')->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartSpayData = [];
        $labelsSpay = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsSpay = [];

        foreach ($monthlySpayData as $dataSpay) {
            $yearsSpay[$dataSpay->year] = true;
            $chartSpayData[$dataSpay->year][$dataSpay->month - 1] = $dataSpay->total_clients;
        }

        foreach ($yearsSpay as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartSpayData[$year][$i])) {
                    $chartSpayData[$year][$i] = 0;
                }
            }
            ksort($chartSpayData[$year]);
        }

        $colorsSpay = [];
        foreach ($yearsSpay as $year => $_) {
            $colorsSpay[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsSpay = [];
        foreach ($chartSpayData as $year => $dataPoints) {
            $datasetsSpay[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsSpay[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupSpay = CastrationAndSpay::whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('service_type', 'Spay')->groupBy('animal_type')->get();

        //Spay Served Count
        $totalSpayServedCount = DB::table('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Spay')->where('request_status', 1)->select(DB::raw('COUNT(id) as total_count'))->first();

        $averageSpayServedPerDayCount = DB::table('castration_and_spays')
            ->select(DB::raw('AVG(daily.total_count) as average_count'))
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Spay')->where('request_status', 1)->select('visitation_schedule', DB::raw('COUNT(*) as total_count'))->groupBy('visitation_schedule');
            }, 'daily')
            ->value('average_count');

        $averageSpayServedPerMonthCount = DB::query()
            ->fromSub(function ($query) use ($filterDateFrom, $filterDateTo) {
                $query->from('castration_and_spays')->whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->where('service_type', 'Spay')->where('request_status', 1)->select(DB::raw('COUNT(*) as total_count'))->groupBy(DB::raw('DATE_FORMAT(visitation_schedule, "%Y-%m")'));
            }, 'monthly')
            ->select(DB::raw('AVG(total_count) as average_count'))
            ->value('average_count');

        $monthlySpayServedData = DB::table('castration_and_spays')->where('service_type', 'Spay')->where('request_status', 1)->select(DB::raw('YEAR(visitation_schedule) as year'), DB::raw('MONTH(visitation_schedule) as month'), DB::raw('COUNT(id) as total_clients'))->groupBy(DB::raw('YEAR(visitation_schedule), MONTH(visitation_schedule)'))->orderBy('year', 'asc')->orderBy('month', 'asc')->get();

        $chartSpayServedData = [];
        $labelsSpayServed = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $yearsSpayServed = [];

        foreach ($monthlySpayServedData as $dataCastrationServed) {
            $yearsSpayServed[$dataCastrationServed->year] = true;
            $chartSpayServedData[$dataCastrationServed->year][$dataCastrationServed->month - 1] = $dataCastrationServed->total_clients;
        }

        foreach ($yearsSpayServed as $year => $_) {
            for ($i = 0; $i < 12; $i++) {
                if (!isset($chartSpayServedData[$year][$i])) {
                    $chartSpayServedData[$year][$i] = 0;
                }
            }
            ksort($chartSpayServedData[$year]);
        }

        $colorsSpayServed = [];
        foreach ($yearsSpayServed as $year => $_) {
            $colorsSpayServed[$year] = 'rgb(' . rand(50, 200) . ',' . rand(50, 200) . ',' . rand(50, 200) . ')';
        }

        $datasetsSpayServed = [];
        foreach ($chartSpayServedData as $year => $dataPoints) {
            $datasetsSpayServed[] = [
                'label' => $year,
                'data' => array_values($dataPoints),
                'borderColor' => $colorsSpayServed[$year],
                'backgroundColor' => 'transparent',
                'tension' => 0.3,
            ];
        }

        $animalGroupSpayServed = CastrationAndSpay::whereBetween('visitation_schedule', [$filterDateFrom, $filterDateTo])->select('animal_type', DB::raw('COUNT(*) as total_per_group'))->where('service_type', 'Spay')->where('request_status', 1)->groupBy('animal_type')->get();

        return view('userviews.services.dashboard.castrationandspay.index', [
            'totalClientRequestCount' => $totalClientRequestCount,
            'totalClientsServedCount' => $totalClientsServedCount,

            'filterDateFrom' => $filterDateFrom,
            'filterDateTo' => $filterDateTo,

            'totalCastrationRequestCount' => $totalCastrationRequestCount,
            'averageCastrationRequestPerDayCount' => $averageCastrationRequestPerDayCount,
            'averageCastrationRequestPerMonthCount' => $averageCastrationRequestPerMonthCount,
            'labelsCastration' => $labelsCastration,
            'datasetsCastration' => $datasetsCastration,
            'animalGroupCastration' => $animalGroupCastration,

            'totalCastrationServedCount' => $totalCastrationServedCount,
            'averageCastrationServedPerDayCount' => $averageCastrationServedPerDayCount,
            'averageCastrationServedPerMonthCount' => $averageCastrationServedPerMonthCount,
            'labelsCastrationServed' => $labelsCastrationServed,
            'datasetsCastrationServed' => $datasetsCastrationServed,
            'animalGroupCastrationServed' => $animalGroupCastrationServed,

            'totalSpayRequestCount' => $totalSpayRequestCount,
            'averageSpayRequestPerDayCount' => $averageSpayRequestPerDayCount,
            'averageSpayRequestPerMonthCount' => $averageSpayRequestPerMonthCount,
            'labelsSpay' => $labelsSpay,
            'datasetsSpay' => $datasetsSpay,
            'animalGroupSpay' => $animalGroupSpay,

            'totalSpayServedCount' => $totalSpayServedCount,
            'averageSpayServedPerDayCount' => $averageSpayServedPerDayCount,
            'averageSpayServedPerMonthCount' => $averageSpayServedPerMonthCount,
            'labelsSpayServed' => $labelsSpayServed,
            'datasetsSpayServed' => $datasetsSpayServed,
            'animalGroupSpayServed' => $animalGroupSpayServed,

            'totalOverallRequestCount' => $totalOverallRequestCount,
            'averageOverallRequestPerDayCount' => $averageOverallRequestPerDayCount,
            'averageOverallRequestPerMonthCount' => $averageOverallRequestPerMonthCount,
            'labelsOverall' => $labelsOverall,
            'datasetsOverall' => $datasetsOverall,
            'animalGroupOverall' => $animalGroupOverall,

            'totalOverallServedCount' => $totalOverallServedCount,
            'averageOverallServedPerDayCount' => $averageOverallServedPerDayCount,
            'averageOverallServedPerMonthCount' => $averageOverallServedPerMonthCount,
            'labelsOverallServed' => $labelsOverallServed,
            'datasetsOverallServed' => $datasetsOverallServed,
            'animalGroupOverallServed' => $animalGroupOverallServed
        ]);
    }
}
