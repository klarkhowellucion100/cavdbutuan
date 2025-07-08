<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AreaRegion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FarmMechanization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File;
use App\Models\FarmMechanizationUpload;
use Illuminate\Support\Facades\Storage;
use App\Models\FarmMechanizationCashCollection;

class FarmMechanizationUserController extends Controller
{
    public function pendingindex(Request $request)
    {
        // $today = Carbon::now('Asia/Manila')->format('Y-m-d');

        $filterDate = $request->input('filter_date');
        $search = $request->input('search');

        $pendingVisitationCount = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $approvedVisitationCount = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 1)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $scheduledVisitationCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 2)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $servedClientsCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 3)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $pendingVisitation = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0)
            ->select(
                'a.visitation_schedule',
                DB::raw('COUNT(a.id) as total_count'),
                DB::raw('SUM(a.area_size) as total_area')
            )
            ->groupBy('a.visitation_schedule')
            ->get();

        $pendingVisitationListQuery = DB::table('farm_mechanizations as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0);

        // Apply date filter if provided
        if ($filterDate) {
            $pendingVisitationListQuery->whereDate('a.visitation_schedule', '=', $filterDate);
        }

        if ($search) {
            $pendingVisitationListQuery->where(function ($query) use ($search) {
                $query->where('a.transaction_number', 'like', '%' . $search . '%')
                    ->orWhere('a.full_name', 'like', '%' . $search . '%')
                    ->orWhere('a.email', 'like', '%' . $search . '%')
                    ->orWhere('a.contact_number', 'like', '%' . $search . '%')
                    ->orWhere('e.barangay_name', 'like', '%' . $search . '%')
                    ->orWhere('d.municipality_name', 'like', '%' . $search . '%')
                    ->orWhere('c.province_name', 'like', '%' . $search . '%')
                    ->orWhere('b.region_name', 'like', '%' . $search . '%');
            });
        }

        $pendingVisitationList = $pendingVisitationListQuery
            ->select('a.*', 'b.region_name as region', 'c.province_name as province', 'd.municipality_name as municipality', 'e.barangay_name as barangay')
            ->orderBy('a.visitation_schedule', 'desc')
            ->orderBy('a.time_from', 'asc')
            ->paginate(10, ['*'], 'pendingVisitationList_page');

        return view('userviews.services.farmmechanization.pending.index', [
            'pendingVisitation' => $pendingVisitation,
            'pendingVisitationCount' => $pendingVisitationCount,
            'approvedVisitationCount' => $approvedVisitationCount,
            'pendingVisitationList' => $pendingVisitationList,
            'scheduledVisitationCount' => $scheduledVisitationCount,
            'servedClientsCount' => $servedClientsCount
        ]);
    }

    public function pendingbulkdelete(Request $request)
    {
        $ids = $request->input('selected_ids');
        if ($ids) {
            DB::table('farm_mechanizations')->whereIn('id', $ids)->delete();
        }
        return redirect()->back()->with('success', 'Selected records deleted successfully.');
    }

    public function pendingbulkapprove(Request $request)
    {
        $ids = $request->input('selected_ids');
        if ($ids) {
            DB::table('farm_mechanizations')->whereIn('id', $ids)->update(['request_status' => 1]);
        }
        return redirect()->back()->with('success', 'Selected records approved successfully.');
    }

    public function approvedindex(Request $request)
    {
        // $today = Carbon::now('Asia/Manila')->format('Y-m-d');

        $filterDate = $request->input('filter_date');
        $search = $request->input('search');

        $pendingVisitationCount = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $approvedVisitationCount = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 1)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $scheduledVisitationCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 2)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $servedClientsCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 3)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $approvedVisitation = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 1)
            ->select(
                'a.visitation_schedule',
                DB::raw('COUNT(a.id) as total_count'),
                DB::raw('SUM(a.area_size) as total_area')
            )
            ->groupBy('a.visitation_schedule')
            ->get();

        $approvedVisitationListQuery = DB::table('farm_mechanizations as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 1);

        // Apply date filter if provided
        if ($filterDate) {
            $approvedVisitationListQuery->whereDate('a.visitation_schedule', '=', $filterDate);
        }

        if ($search) {
            $approvedVisitationListQuery->where(function ($query) use ($search) {
                $query->where('a.transaction_number', 'like', '%' . $search . '%')
                    ->orWhere('a.full_name', 'like', '%' . $search . '%')
                    ->orWhere('a.email', 'like', '%' . $search . '%')
                    ->orWhere('a.contact_number', 'like', '%' . $search . '%')
                    ->orWhere('e.barangay_name', 'like', '%' . $search . '%')
                    ->orWhere('d.municipality_name', 'like', '%' . $search . '%')
                    ->orWhere('c.province_name', 'like', '%' . $search . '%')
                    ->orWhere('b.region_name', 'like', '%' . $search . '%');
            });
        }

        $approvedVisitationList = $approvedVisitationListQuery
            ->select('a.*', 'b.region_name as region', 'c.province_name as province', 'd.municipality_name as municipality', 'e.barangay_name as barangay')
            ->orderBy('a.visitation_schedule', 'desc')
            ->orderBy('a.time_from', 'asc')
            ->paginate(10, ['*'], 'approvedVisitationList_page');

        return view('userviews.services.farmmechanization.approved.index', [
            'approvedVisitation' => $approvedVisitation,
            'pendingVisitationCount' => $pendingVisitationCount,
            'approvedVisitationCount' => $approvedVisitationCount,
            'approvedVisitationList' => $approvedVisitationList,
            'scheduledVisitationCount' => $scheduledVisitationCount,
            'servedClientsCount' => $servedClientsCount
        ]);
    }

    public function approvedshow($id)
    {
        // $today = Carbon::now('Asia/Manila')->format('Y-m-d');
        $scheduled = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 2)
            ->select(
                'b.final_schedule',
                DB::raw('COUNT(a.id) as total_count'),
                DB::raw('SUM(a.area_size) as total_size')
            )
            ->groupBy('b.final_schedule')
            ->get();

        $farmMechanization = FarmMechanization::findOrFail($id);

        $approvingOfficer = User::where('id', 3)->first();

        $allUsers = User::get();

        return view('userviews.services.farmmechanization.approved.show', [
            'farmMechanization' => $farmMechanization,
            'approvingOfficer' => $approvingOfficer,
            'allUsers' => $allUsers,
            'scheduled' => $scheduled,
            // 'today' => $today
        ]);
    }

    public function approvedcashcollection(Request $request)
    {
        $data = $request->validate([
            'farm_mechanization_id' => ['required'],
            'transaction_number' => ['required'],
            'endorsed_to_id' => ['required'],
            'date_endorsed' => ['required'],
            'remarks' => ['nullable'],
            'responsible_person_id' => ['required'],
            'approved_by_id' => ['required'],
            'date_approved' => ['required'],
            'fees_charge' => ['required'],
            'issuance_officer_id' => ['required'],
            'final_schedule' => ['required'],
        ]);
        $to_date = Carbon::parse($request->proposed_schedule);
        $currentDate = $to_date->format('Ymd'); // Format the current date as YYYYMMDD
        $microtime = str_replace('.', '', microtime(true)); // Get microtime and remove the decimal point
        $control_number = 'CN-' . $currentDate . '-' . $microtime . '-' . rand(1000, 9999);

        $data['control_number'] = $control_number;
        $data['user_id'] = Auth::id();
        $data['code'] = Str::uuid();

        FarmMechanizationCashCollection::create($data);
        FarmMechanization::where('id', $request->farm_mechanization_id)->update(['request_status' => 2]);
        return redirect()->route('farmmechanization.user.approved.index')->with('success', 'Request have been scheduled successfully!');
    }

    public function scheduledindex(Request $request)
    {
        // $today = Carbon::now('Asia/Manila')->format('Y-m-d');

        $filterDate = $request->input('filter_date');
        $search = $request->input('search');

        $pendingVisitationCount = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $approvedVisitationCount = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 1)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $scheduledVisitationCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 2)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $servedClientsCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 3)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $scheduledVisitation = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 2)
            ->select(
                'b.final_schedule',
                DB::raw('COUNT(b.id) as total_count'),
                DB::raw('SUM(a.area_size) as total_area')
            )
            ->groupBy('b.final_schedule')
            ->get();

        $scheduledVisitationListQuery = DB::table('farm_mechanizations as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->join('farm_mechanization_cash_collections as f', 'a.id', 'f.farm_mechanization_id')
            // ->where('f.final_schedule', '>=', $today)
            ->where('a.request_status', 2);

        // Apply date filter if provided
        if ($filterDate) {
            $scheduledVisitationListQuery->whereDate('f.final_schedule', '=', $filterDate);
        }

        if ($search) {
            $scheduledVisitationListQuery->where(function ($query) use ($search) {
                $query->where('a.transaction_number', 'like', '%' . $search . '%')
                    ->orWhere('a.full_name', 'like', '%' . $search . '%')
                    ->orWhere('a.email', 'like', '%' . $search . '%')
                    ->orWhere('a.contact_number', 'like', '%' . $search . '%')
                    ->orWhere('e.barangay_name', 'like', '%' . $search . '%')
                    ->orWhere('d.municipality_name', 'like', '%' . $search . '%')
                    ->orWhere('c.province_name', 'like', '%' . $search . '%')
                    ->orWhere('b.region_name', 'like', '%' . $search . '%');
            });
        }

        $scheduledVisitationList = $scheduledVisitationListQuery
            ->select('a.*', 'b.region_name as region', 'c.province_name as province', 'd.municipality_name as municipality', 'e.barangay_name as barangay', 'f.final_schedule')
            ->orderBy('f.final_schedule', 'desc')
            ->paginate(10, ['*'], 'scheduledVisitationList_page');

        return view('userviews.services.farmmechanization.scheduled.index', [
            'scheduledVisitation' => $scheduledVisitation,
            'pendingVisitationCount' => $pendingVisitationCount,
            'approvedVisitationCount' => $approvedVisitationCount,
            'scheduledVisitationList' => $scheduledVisitationList,
            'scheduledVisitationCount' => $scheduledVisitationCount,
            'servedClientsCount' => $servedClientsCount
        ]);
    }

    public function scheduledform($id)
    {
        $clientForm = DB::table('farm_mechanizations as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->join('farm_mechanization_cash_collections as f', 'a.id', 'f.farm_mechanization_id')
            ->join('users as g', 'f.endorsed_to_id', 'g.id')
            ->join('users as h', 'f.responsible_person_id', 'h.id')
            ->join('users as i', 'f.approved_by_id', 'i.id')
            ->join('users as j', 'f.issuance_officer_id', 'j.id')
            ->join('users as k', 'f.user_id', 'k.id')
            ->where('a.request_status', 2)
            ->where('a.id', $id)
            ->select(
                'a.*',
                'f.*',
                'g.name as endorsed_name',
                'g.position as endorsed_position',
                'h.name as responsible_name',
                'i.name as approved_name',
                'i.position as approved_position',
                'j.name as issuer_name',
                'j.position as issuer_position',
                'k.name as encoder_name',
                'b.region_name as region',
                'c.province_name as province',
                'd.municipality_name as municipality',
                'e.barangay_name as barangay',
                'f.final_schedule'
            )
            ->first();

        return view('userviews.services.farmmechanization.scheduled.form', [
            'clientForm' => $clientForm
        ]);
    }

    public function schedulededit($id)
    {
        // $today = Carbon::now('Asia/Manila')->format('Y-m-d');
        $updateSchedule = FarmMechanizationCashCollection::where('farm_mechanization_id', $id)->first();
        $scheduled = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 2)
            ->select(
                'b.final_schedule',
                DB::raw('COUNT(a.id) as total_count'),
                DB::raw('SUM(a.area_size) as total_size')
            )
            ->groupBy('b.final_schedule')
            ->get();
        return view('userviews.services.farmmechanization.scheduled.edit', [
            'updateSchedule' => $updateSchedule,
            'scheduled' => $scheduled
        ]);
    }

    public function scheduledupdate(Request $request, $id)
    {
        $updateSchedule = FarmMechanizationCashCollection::findOrFail($id);
        $dataUpdate = $request->validate([
            'final_schedule' => ['required'],
            'fees_charge' => ['required']
        ]);

        $updateSchedule->update($dataUpdate);

        return redirect()->back()->with('success', 'Successfully Reschduled!');
    }

    public function scheduledupload($id)
    {
        $uploadFile = FarmMechanization::findOrFail($id);

        $fileExists = FarmMechanizationUpload::where('farm_mechanization_id', $id)->first();

        return view('userviews.services.farmmechanization.scheduled.upload', [
            'uploadFile' => $uploadFile,
            'fileExists' => $fileExists,
        ]);
    }

    public function scheduleduploadstore(Request $request)
    {
        $orUpload = $request->validate([
            'farm_mechanization_id' => ['required'],
            'transaction_number' => ['required'],
            'or_number' => ['required'],
            'or_date' => ['required'],
            'uploaded_file' => ['nullable', File::types(['png', 'jpg', 'webp', 'pdf'])->max(200048)],
        ]);

        $orUpload['code'] = Str::uuid();

        if ($request->hasFile('uploaded_file')) {
            $orUpload['uploaded_file'] = $this->uploadOrPic($request->file('uploaded_file'));
        } else {
            $orUpload['uploaded_file'] = null; // Set to null if no file is uploaded
        }

        FarmMechanizationUpload::create($orUpload);
        return redirect()->back()->with('success', 'OR uploaded successfully!');
    }

    public function uploadOrPic($file)
    {
        if (!$file) {
            return null; // Handle case when no file is provided
        }

        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;

        if ($extension === 'pdf') {
            $path = $file->storeAs('or_pdfs', $filename, 'public');
        } else {
            $path = $file->storeAs('or', $filename, 'public');
        }

        if (!$path) {
            throw new \Exception('Failed to store the file.');
        }

        return $path;
    }

    public function scheduleddelete($id)
    {
        $orDelete = FarmMechanizationUpload::findOrFail($id);

        // Check if there is a file path before deleting
        if ($orDelete->uploaded_file) {
            Storage::disk('public')->delete($orDelete->uploaded_file);
        }

        $orDelete->delete();

        return redirect()->back()->with('success', 'OR deleted successfully.');
    }

    public function servedindex(Request $request)
    {

        $filterDate = $request->input('filter_date');
        $search = $request->input('search');

        $pendingVisitationCount = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 0)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $approvedVisitationCount = DB::table('farm_mechanizations as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 1)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $scheduledVisitationCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 2)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $servedClientsCount = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 3)
            ->select(DB::raw('COUNT(a.id) as total_count'))
            ->first();

        $servedClients = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('b.final_schedule', '>=', $today)
            ->where('a.request_status', 3)
            ->select(
                'b.final_schedule',
                DB::raw('COUNT(b.id) as total_count'),
                DB::raw('SUM(a.area_size) as total_area')
            )
            ->groupBy('b.final_schedule')
            ->get();

        $servedClientsListQuery = DB::table('farm_mechanizations as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->join('farm_mechanization_cash_collections as f', 'a.id', 'f.farm_mechanization_id')
            // ->where('f.final_schedule', '>=', $today)
            ->where('a.request_status', 3);

        // Apply date filter if provided
        if ($filterDate) {
            $servedClientsListQuery->whereDate('f.final_schedule', '=', $filterDate);
        }

        if ($search) {
            $servedClientsListQuery->where(function ($query) use ($search) {
                $query->where('a.transaction_number', 'like', '%' . $search . '%')
                    ->orWhere('a.full_name', 'like', '%' . $search . '%')
                    ->orWhere('a.email', 'like', '%' . $search . '%')
                    ->orWhere('a.contact_number', 'like', '%' . $search . '%')
                    ->orWhere('e.barangay_name', 'like', '%' . $search . '%')
                    ->orWhere('d.municipality_name', 'like', '%' . $search . '%')
                    ->orWhere('c.province_name', 'like', '%' . $search . '%')
                    ->orWhere('b.region_name', 'like', '%' . $search . '%');
            });
        }

        $servedClientsList = $servedClientsListQuery
            ->select('a.*', 'b.region_name as region', 'c.province_name as province', 'd.municipality_name as municipality', 'e.barangay_name as barangay', 'f.final_schedule')
            ->orderBy('f.final_schedule', 'desc')
            ->paginate(10, ['*'], 'scheduledVisitationList_page');


        return view('userviews.services.farmmechanization.served.index', [
            'servedClients' => $servedClients,
            'pendingVisitationCount' => $pendingVisitationCount,
            'approvedVisitationCount' => $approvedVisitationCount,
            'servedClientsList' => $servedClientsList,
            'scheduledVisitationCount' => $scheduledVisitationCount,
            'servedClientsCount' => $servedClientsCount
        ]);
    }

    public function servedbulkserved(Request $request)
    {
        $ids = $request->input('selected_ids');
        if ($ids) {
            DB::table('farm_mechanizations')->whereIn('id', $ids)->update(['request_status' => 3]);
        }
        return redirect()->back()->with('success', 'Selected records updated successfully.');
    }


    public function admincreate()
    {
        $approvingOfficer = User::where('id', 3)->first();
        $allUsers = User::get();

        $oldClients = FarmMechanization::select('full_name')->groupBy('full_name')->orderBy('full_name', 'asc')->get();
        $regions = AreaRegion::orderBy('region_name', 'asc')->get();
        $scheduled = DB::table('farm_mechanizations as a')
            ->join('farm_mechanization_cash_collections as b', 'a.id', 'b.farm_mechanization_id')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 2)
            ->select(
                'b.final_schedule',
                DB::raw('COUNT(a.id) as total_count'),
                DB::raw('SUM(a.area_size) as total_size')
            )
            ->groupBy('b.final_schedule')
            ->get();
        return view('userviews.services.farmmechanization.admin.index', [
            'oldClients' => $oldClients,
            'regions' => $regions,
            'scheduled' => $scheduled,
            'approvingOfficer' => $approvingOfficer,
            'allUsers' => $allUsers
        ]);
    }

    public function adminpost(Request $request)
    {

        $data = $request->validate([
            'full_name' => ['required'],
            'machinery' => ['required'],
            'sex' => ['required'],
            'birthdate' => ['nullable'],
            'contact_number' => ['nullable'],
            'email' => ['nullable'],
            'region_id' => ['required'],
            'province_id' => ['required'],
            'municipality_id' => ['required'],
            'barangay_id' => ['required'],
            'specific_location' => ['nullable'],
            'category' => ['required'],
            'area_size' => ['required'],
            'details' => ['nullable'],
            'proposed_schedule' => ['required'],
            'visitation_schedule' => ['required'],
        ]);

        $visitation_date = Carbon::parse($request->visitation_schedule)->format('Ymd');
        $microtime = str_replace('.', '', microtime(true));

        // Count existing records for the same visitation date
        $countForDate = FarmMechanization::whereDate('visitation_schedule', Carbon::parse($request->visitation_schedule))
            ->count() + 1; // Add 1 for the new entry

        // Format as 5 digits with leading zeros
        $incrementalNumber = str_pad($countForDate, 5, '0', STR_PAD_LEFT);

        $transaction_number = 'TRF' . '-' . $visitation_date . '-' . $microtime . '-' . $incrementalNumber;

        $data['transaction_number'] = $transaction_number;
        $data['request_status'] = 2;

        $record = FarmMechanization::create($data);

        $cashCollectionData = $request->validate([
            'endorsed_to_id' => ['required'],
            'date_endorsed' => ['required'],
            'remarks' => ['nullable'],
            'responsible_person_id' => ['required'],
            'approved_by_id' => ['required'],
            'date_approved' => ['required'],
            'fees_charge' => ['required'],
            'issuance_officer_id' => ['required'],
            'final_schedule' => ['required'],
        ]);

        $control_number = 'CN' . '-' . $visitation_date . '-' . $microtime . '-' . $incrementalNumber;
        $cashCollectionData['farm_mechanization_id'] = $record->id;
        $cashCollectionData['transaction_number'] = $record->transaction_number;
        $cashCollectionData['control_number'] = $control_number;
        $cashCollectionData['user_id'] = Auth::id();
        $cashCollectionData['code'] = Str::uuid();

        FarmMechanizationCashCollection::create($cashCollectionData);

        return redirect()->back()->with('success', 'Request recorded successfully.');
    }

    public function admindelete($id)
    {
        $farmMechanization = FarmMechanization::findOrFail($id);
        $farmMechanization->delete();

        // Delete related uploads (if any)
        $uploads = FarmMechanizationUpload::where('farm_mechanization_id', $id)->get();
        foreach ($uploads as $upload) {
            if ($upload->uploaded_file) {
                Storage::disk('public')->delete($upload->uploaded_file);
            }
            $upload->delete();
        }

        // Delete related cash collections (if any)
        $cashCollections = FarmMechanizationCashCollection::where('farm_mechanization_id', $id)->get();
        foreach ($cashCollections as $collection) {
            $collection->delete();
        }

        return redirect()->back()->with('success', 'Request deleted successfully.');
    }
}
