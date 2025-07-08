<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AreaRegion;
use Illuminate\Http\Request;
use App\Models\CastrationAndSpay;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Storage;
use App\Models\CastrationAndSpayAvailability;

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
             ->orderBy('a.time_from', 'asc')
            ->paginate(10, ['*'], 'scheduledOperationList_page');

        return view('userviews.services.castrationandspay.scheduled.index', [
            'scheduledOperationCount' => $scheduledOperationCount,
            'servedClientsCount' => $servedClientsCount,
            'scheduledOperation' => $scheduledOperation,
            'scheduledOperationList' => $scheduledOperationList
        ]);
    }

   public function scheduledbulkdelete(Request $request)
    {
        $ids = $request->input('selected_ids');

        if ($ids) {
            $records = DB::table('castration_and_spays')->whereIn('id', $ids)->get();

            foreach ($records as $record) {
                if ($record->vaccination_card) {
                    $filePath = storage_path('app/public/' . $record->vaccination_card);
                    if (file_exists($filePath)) {
                        unlink($filePath); // Direct file deletion
                    }
                }
            }

            DB::table('castration_and_spays')->whereIn('id', $ids)->delete();
        }

        return redirect()->back()->with('success', 'Selected records and their files deleted successfully.');
    }


    public function scheduledbulkserved(Request $request){
        $ids = $request->input('selected_ids');

        if ($ids) {
            DB::table('castration_and_spays')->whereIn('id', $ids)->update(['request_status' => 1]);
        }
        return redirect()->back()->with('success', 'Selected records served successfully.');
    }

    public function scheduledform($id){
        $formData = DB::table('castration_and_spays as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->where('a.id', $id)
            ->first();

        return view('userviews.services.castrationandspay.scheduled.form', [
            'formData' => $formData
        ]);
    }

    public function scheduledcard($id){
        $vaccinationCard = CastrationAndSpay::find($id);

        return view('userviews.services.castrationandspay.scheduled.card', [
            'vaccinationCard' => $vaccinationCard
        ]);
    }

      public function servedindex(Request $request){

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

        $servedOperation = DB::table('castration_and_spays as a')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 1)
            ->select(
                'a.visitation_schedule',
                DB::raw('COUNT(a.id) as total_count')
            )
            ->groupBy('a.visitation_schedule')
            ->get();

        $servedOperationListQuery = DB::table('castration_and_spays as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            // ->where('a.visitation_schedule', '>=', $today)
            ->where('a.request_status', 1);

        // Apply date filter if provided
        if ($filterDate) {
            $servedOperationListQuery->whereDate('a.visitation_schedule', '=', $filterDate);
        }

        if ($search) {
            $servedOperationListQuery->where(function ($query) use ($search) {
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

        $servedOperationList = $servedOperationListQuery
            ->select('a.*', 'b.region_name as region', 'c.province_name as province', 'd.municipality_name as municipality', 'e.barangay_name as barangay')
            ->orderBy('a.visitation_schedule', 'desc')
             ->orderBy('a.time_from', 'asc')
            ->paginate(10, ['*'], 'servedOperationList_page');

        return view('userviews.services.castrationandspay.served.index', [
            'scheduledOperationCount' => $scheduledOperationCount,
            'servedClientsCount' => $servedClientsCount,
            'servedOperation' => $servedOperation,
            'servedOperationList' => $servedOperationList
        ]);
    }

    public function servedform($id){
        $formData = DB::table('castration_and_spays as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->where('a.id', $id)
            ->first();

        return view('userviews.services.castrationandspay.served.form', [
            'formData' => $formData
        ]);
    }

    public function servedcard($id){
        $vaccinationCard = CastrationAndSpay::find($id);

        return view('userviews.services.castrationandspay.served.card', [
            'vaccinationCard' => $vaccinationCard
        ]);
    }


    public function admincreate()
    {
        $regions = AreaRegion::orderBy('region_name', 'asc')->get();

        $blockAppointmentDates = DB::table('castration_and_spay_block_dates')
            ->select('block_date')
            ->groupBy('block_date')
            ->pluck('block_date') // only values, not objects
            ->values()
            ->toArray();

        $scheduledTime = CastrationAndSpayAvailability::where('status', 1)->get();
        $groupedSchedule = $scheduledTime->groupBy('day_name');

        $bookedSlots = DB::table('castration_and_spays')
            ->select(
                DB::raw('DATE(visitation_schedule) as date'),
                'time_from',
                'time_to'
            )
            ->whereNotNull('visitation_schedule')
            ->get()
            ->groupBy('date')
            ->map(function ($items) {
                return $items->map(function ($item) {
                    return [
                        'time_from' => $item->time_from,
                        'time_to' => $item->time_to,
                    ];
                })->values();
            });

        return view('userviews.services.castrationandspay.admin.index', [
            'regions' => $regions,
            'blockAppointmentDates' => $blockAppointmentDates,
            'groupedSchedule' => $groupedSchedule,
            'bookedSlots' => $bookedSlots,
        ]);
    }
    public function adminpost(Request $request){
         $data = $request->validate([
            'full_name' => ['required'],
            'sex' => ['required'],
            'birthdate' => ['nullable'],
            'contact_number' => ['nullable'],
            'email' => ['nullable'],
            'region_id' => ['required'],
            'province_id' => ['required'],
            'municipality_id' => ['required'],
            'barangay_id' => ['required'],
            'specific_location' => ['nullable'],
            'service_type' => ['required'],
            'animal_type' => ['required'],
            'animal_specie' => ['nullable'],
            'animal_name' => ['required'],
            'animal_sex' => ['required'],
            'animal_age_year' => ['nullable'],
            'animal_age_month' => ['nullable'],
            'animal_color' => ['nullable'],
            'visitation_schedule' => ['required'],
            'vaccination_date' => ['required'],
            'time_from' => ['required'],
            'time_to' => ['required'],
            'vaccination_card' => ['required', File::types(['png', 'jpg', 'webp', 'pdf'])->max(200048)],
        ]);

        $visitation_date = Carbon::parse($request->visitation_schedule)->format('Ymd');
        $microtime = str_replace('.', '', microtime(true));

        // Count existing records for the same visitation date
        $countForDate = CastrationAndSpay::whereDate('visitation_schedule', Carbon::parse($request->visitation_schedule))
            ->count() + 1; // Add 1 for the new entry

        // Format as 5 digits with leading zeros
        $incrementalNumber = str_pad($countForDate, 5, '0', STR_PAD_LEFT);

        $transaction_number = 'TRC' . '-' . $visitation_date . '-' . $microtime . '-' . $incrementalNumber;

        $data['transaction_number'] = $transaction_number;
        $data['request_status'] = 0;
        $data['vaccination_status'] = "Vaccinated";

        if ($request->hasFile('vaccination_card')) {
            $data['vaccination_card'] = $this->uploadVaccinationCardPic($request->file('vaccination_card'));
        } else {
            $data['vaccination_card'] = null; // Set to null if no file is uploaded
        }

        $record = CastrationAndSpay::create($data);

        return redirect()->route(
            'castrationandspay.user.scheduled.admincreate',
            $record->id
        )->with('success', 'Request successfully recorded!');
    }

     public function uploadVaccinationCardPic($file)
    {
        if (!$file) {
            return null; // Handle case when no file is provided
        }

        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;

        if ($extension === 'pdf') {
            $path = $file->storeAs('card_pdfs', $filename, 'public');
        } else {
            $path = $file->storeAs('card', $filename, 'public');
        }

        if (!$path) {
            throw new \Exception('Failed to store the file.');
        }

        return $path;
    }
}

