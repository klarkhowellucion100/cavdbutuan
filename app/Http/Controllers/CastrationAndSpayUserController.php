<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CastrationAndSpayUserController extends Controller
{
    public function scheduledindex(Request $request){

        $filterDate = $request->input('filter_date');
        $search = $request->input('search');

        $scheduledOperationCount = DB::table('castration_and_spays as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $servedClientsCount = DB::table('castration_and_spays as a')
            ->where('a.request_status', 1)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $scheduledOperation = DB::table('castration_and_spays as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0)
            ->select(
                'a.visitation_schedule',
                DB::raw('COUNT(a.id) as total_count')
            )
            ->groupBy('a.visitation_schedule')
            ->get();

        $scheduledOperationListQuery = DB::table('castration_and_spays as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0);

        // Apply date filter if provided
        if ($filterDate) {
            $scheduledOperationListQuery->whereDate('a.visitation_schedule', '=', $filterDate);
        }

        if ($search) {
            $scheduledOperationListQuery->where(function ($query) use ($search) {
                $query->where('a.transaction_number', 'like', '%' . $search . '%')
                    ->orWhere('a.full_name', 'like', '%' . $search . '%')
                    ->orWhere('a.animal_type', 'like', '%' . $search . '%')
                    ->orWhere('a.service_type', 'like', '%' . $search . '%')
                    ->orWhere('a.email', 'like', '%' . $search . '%')
                    ->orWhere('a.contact_number', 'like', '%' . $search . '%')
                    ->orWhere('e.barangay_name', 'like', '%' . $search . '%')
                    ->orWhere('d.municipality_name', 'like', '%' . $search . '%')
                    ->orWhere('c.province_name', 'like', '%' . $search . '%')
                    ->orWhere('b.region_name', 'like', '%' . $search . '%');
            });
        }

        $scheduledOperationList = $scheduledOperationListQuery
            ->select('a.*', 'b.region_name as region', 'c.province_name as province', 'd.municipality_name as municipality', 'e.barangay_name as barangay')
            ->orderBy('a.visitation_schedule', 'desc')
            ->paginate(10, ['*'], 'scheduledOperationList_page');

        return view('userviews.services.castrationandspay.scheduled.index', [
            'scheduledOperationCount' => $scheduledOperationCount,
            'servedClientsCount' => $servedClientsCount,
            'scheduledOperation' => $scheduledOperation,
            'scheduledOperationList' => $scheduledOperationList
        ]);
    }

    public function scheduledbulkdelete(Request $request){
        $ids = $request->input('selected_ids');

        if ($ids) {
            DB::table('castration_and_spays')->whereIn('id', $ids)->delete();
        }
        return redirect()->back()->with('success', 'Selected records deleted successfully.');
    }

    public function scheduledbulkserved(Request $request){
        $ids = $request->input('selected_ids');

        if ($ids) {
            DB::table('castration_and_spays')->whereIn('id', $ids)->update(['request_status' => 1]);
        }
        return redirect()->back()->with('success', 'Selected records served successfully.');
    }
}

