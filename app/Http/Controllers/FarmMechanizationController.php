<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AreaRegion;
use Illuminate\Support\Str;
use App\Models\AreaBarangay;
use App\Models\AreaProvince;
use Illuminate\Http\Request;
use App\Models\AreaMunicipality;
use App\Models\FarmMechanization;
use Illuminate\Support\Facades\DB;
use App\Mail\FarmMechanizationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\File;
use App\Models\FarmMechanizationUpload;
use App\Models\FarmMechanizationAvailability;
use App\Models\FarmMechanizationCashCollection;

class FarmMechanizationController extends Controller
{
    public function create()
    {
        $regions = AreaRegion::orderBy('region_name', 'asc')->get();

        // $blockDates = FarmMechanizationCashCollection::select('final_schedule')
        //     ->groupBy('final_schedule')
        //     ->pluck('final_schedule')
        //     ->toArray();

        $blockDatesRaw = DB::table('farm_mechanization_cash_collections as a')
            ->join('farm_mechanizations as b', 'a.farm_mechanization_id', 'b.id')
            ->select(
                'a.final_schedule',
                DB::raw('SUM(b.area_size) as total_area_size')
            )
            ->groupBy('a.final_schedule')
            ->get();

        // Filter only dates with area_size >= 4
        $blockDates = $blockDatesRaw
            ->filter(fn($item) => $item->total_area_size >= 4)
            ->pluck('final_schedule')
            ->values()
            ->toArray();

        $blockAppointmentDates = DB::table('farm_mechanization_block_dates')
            ->select('block_date')
            ->groupBy('block_date')
            ->pluck('block_date') // only values, not objects
            ->values()
            ->toArray();

        $scheduledTime = FarmMechanizationAvailability::where('status', 1)->get();
        $groupedSchedule = $scheduledTime->groupBy('day_name');

        $bookedSlots = DB::table('farm_mechanizations')
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


        return view('guestviews.services.farmmechanization.create', [
            'regions' => $regions,
            'blockDates' => $blockDates,
            'blockAppointmentDates' => $blockAppointmentDates,
            'scheduledTime' => $scheduledTime,
            'groupedSchedule' => $groupedSchedule,
            'bookedSlots' => $bookedSlots->map->values() // ensure it's JSON serializable
        ]);
    }

    public function getProvinces($region_id)
    {
        $provinces = AreaProvince::where('region_id', $region_id)->orderBy('province_name', 'asc')->get();
        return response()->json($provinces);
    }

    public function getMunicipalities($province_id)
    {
        $municipalities = AreaMunicipality::where('province_id', $province_id)->orderBy('municipality_name', 'asc')->get();
        return response()->json($municipalities);
    }

    public function getBarangays($municipality_id)
    {
        $barangays = AreaBarangay::where('municipality_id', $municipality_id)->orderBy('barangay_name', 'asc')->get();
        return response()->json($barangays);
    }
    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'full_name' => ['required'],
    //         'machinery' => ['required'],
    //         'sex' => ['required'],
    //         'birthdate' => ['nullable'],
    //         'contact_number' => ['nullable'],
    //         'email' => ['nullable'],
    //         'region_id' => ['required'],
    //         'province_id' => ['required'],
    //         'municipality_id' => ['required'],
    //         'barangay_id' => ['required'],
    //         'specific_location' => ['nullable'],
    //         'category' => ['required'],
    //         'area_size' => ['required'],
    //         'details' => ['nullable'],
    //         'proposed_schedule' => ['required'],
    //         'visitation_schedule' => ['required'],
    //     ]);
    //     $to_date = Carbon::parse($request->proposed_schedule);
    //     $currentDate = $to_date->format('Ymd'); // Format the current date as YYYYMMDD
    //     $microtime = str_replace('.', '', microtime(true)); // Get microtime and remove the decimal point
    //     $transaction_number = 'TRC-' . $currentDate . '-' . $microtime . '-' . rand(1000, 9999);

    //     $data['transaction_number'] = $transaction_number;
    //     $data['request_status'] = 0;

    //     $record = FarmMechanization::create($data);

    //     return redirect()->route(
    //         'farmmechanization.form',
    //         $record->id
    //     )->with('success', 'Request successfully sent!');
    // }

    public function store(Request $request)
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
            'time_from' => ['required'],
            'time_to' => ['required'],
            'g-recaptcha-response' => ['required']
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.', // ✅ Custom message
        ]);

        unset($data['g-recaptcha-response']);

        $visitation_date = Carbon::parse($request->visitation_schedule)->format('Ymd');
        $microtime = str_replace('.', '', microtime(true));

        // Count existing records for the same visitation date
        $countForDate = FarmMechanization::whereDate('visitation_schedule', Carbon::parse($request->visitation_schedule))
            ->count() + 1; // Add 1 for the new entry

        // Format as 5 digits with leading zeros
        $incrementalNumber = str_pad($countForDate, 5, '0', STR_PAD_LEFT);

        $transaction_number = 'TRF' . '-' . $visitation_date . '-' . $microtime . '-' . $incrementalNumber;

        $data['transaction_number'] = $transaction_number;
        $data['request_status'] = 0;

        $record = FarmMechanization::create($data);

        if (!empty($data['email'])) {
            Mail::to($data['email'])->send(new FarmMechanizationEmail($data));
        };

        return redirect()->route(
            'farmmechanization.form',
            $record->id
        )->with('success', 'Request successfully sent!');
    }

    /**
     * Display the specified resource.
     */
    public function form($id)
    {
        $record = DB::table('farm_mechanizations as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->where('a.id', $id)
            ->select(
                'a.*',
                'b.region_name as region',
                'c.province_name as province',
                'd.municipality_name as municipality',
                'e.barangay_name as barangay',
            )
            ->first();

        // Prepare the data and URL encode it properly
        $data = $record->transaction_number;

        $encodedData = urlencode($data);

        // URL encode the query data (excluding &&)
        $encodedData = urlencode($data);

        // Construct the final URL
        $final_url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $encodedData;

        // Now, fetch the QR code image content
        $qrImageData = file_get_contents($final_url);

        // Base64 encode the image
        $qrBase64 = 'data:image/png;base64,' . base64_encode($qrImageData);

        return view('guestviews.services.farmmechanization.form', [
            'record' => $record,
            'qrBase64' => $qrBase64
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function track()
    {
        return view('guestviews.services.farmmechanization.track');
    }

    public function tracksearch(Request $request)
    {
        $request->validate([
            'tracking_number' => ['required']
        ]);

        $trackData = DB::table('farm_mechanizations as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->leftJoin('farm_mechanization_cash_collections as f', 'a.transaction_number', 'f.transaction_number')
            ->leftJoin('farm_mechanization_uploads as g', 'a.transaction_number', 'g.transaction_number')
            ->where('a.transaction_number', $request->tracking_number)
            ->select(
                'a.id as id',
                'a.transaction_number as transaction_number',
                'a.full_name as full_name',
                'a.machinery as machinery',
                'a.created_at as created_at',
                'a.updated_at as updated_at',
                'a.sex as sex',
                'a.time_from as time_from',
                'a.time_to as time_to',
                'a.birthdate as birthdate',
                'a.contact_number as contact_number',
                'a.email as email',
                'a.specific_location as specific_location',
                'a.category as category',
                'a.area_size as area_size',
                'a.details as details',
                'a.proposed_schedule as proposed_schedule',
                'a.visitation_schedule as visitation_schedule',
                'a.request_status as request_status',
                'f.fees_charge as fees_charge',
                'f.final_schedule as final_schedule',
                'g.uploaded_file as uploaded_file',
                'b.region_name as region',
                'c.province_name as province',
                'd.municipality_name as municipality',
                'e.barangay_name as barangay',
            )
            ->first();

        $data = $trackData->transaction_number;

        $encodedData = urlencode($data);

        // URL encode the query data (excluding &&)
        $encodedData = urlencode($data);

        // Construct the final URL
        $final_url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $encodedData;

        // Now, fetch the QR code image content
        $qrImageData = file_get_contents($final_url);

        // Base64 encode the image
        $qrBase64 = 'data:image/png;base64,' . base64_encode($qrImageData);

        return view('guestviews.services.farmmechanization.trackresult', [
            'trackData' => $trackData,
            'qrBase64' => $qrBase64
        ]);
    }

    public function tracksearchFromLink(Request $request)
    {
        $request->validate([
            'tracking_number' => ['required']
        ]);

        $trackData = DB::table('farm_mechanizations as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->leftJoin('farm_mechanization_cash_collections as f', 'a.transaction_number', 'f.transaction_number')
            ->leftJoin('farm_mechanization_uploads as g', 'a.transaction_number', 'g.transaction_number')
            ->where('a.transaction_number', $request->tracking_number)
            ->select(
                'a.id as id',
                'a.transaction_number as transaction_number',
                'a.full_name as full_name',
                'a.machinery as machinery',
                'a.created_at as created_at',
                'a.updated_at as updated_at',
                'a.sex as sex',
                'a.time_from as time_from',
                'a.time_to as time_to',
                'a.birthdate as birthdate',
                'a.contact_number as contact_number',
                'a.email as email',
                'a.specific_location as specific_location',
                'a.category as category',
                'a.area_size as area_size',
                'a.details as details',
                'a.proposed_schedule as proposed_schedule',
                'a.visitation_schedule as visitation_schedule',
                'a.request_status as request_status',
                'f.fees_charge as fees_charge',
                'f.final_schedule as final_schedule',
                'g.uploaded_file as uploaded_file',
                'b.region_name as region',
                'c.province_name as province',
                'd.municipality_name as municipality',
                'e.barangay_name as barangay',
            )
            ->first();

        $data = $trackData->transaction_number;

        $encodedData = urlencode($data);

        // URL encode the query data (excluding &&)
        $encodedData = urlencode($data);

        // Construct the final URL
        $final_url = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $encodedData;

        // Now, fetch the QR code image content
        $qrImageData = file_get_contents($final_url);

        // Base64 encode the image
        $qrBase64 = 'data:image/png;base64,' . base64_encode($qrImageData);

        return view('guestviews.services.farmmechanization.trackresult', [
            'trackData' => $trackData,
            'qrBase64' => $qrBase64
        ]);
    }

    public function trackresultupload(Request $request)
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
        return redirect()->route('farmmechanization.track')
            ->with('success', 'OR uploaded successfully!');
    }

    public function uploadOrPic($file)
    {
        if (!$file) {
            return null; // Handle case when no file is provided
        }

        $extension = $file->getClientOriginalExtension();
        $filename = time() . '_' . uniqid() . '.' . $extension;

        if ($extension === 'pdf') {
            $path = $file->storeAs('vaccination_pdfs', $filename, 'public');
        } else {
            $path = $file->storeAs('vaccination_or', $filename, 'public');
        }

        if (!$path) {
            throw new \Exception('Failed to store the file.');
        }

        return $path;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FarmMechanization $farmMechanization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FarmMechanization $farmMechanization)
    {
        //
    }
}
