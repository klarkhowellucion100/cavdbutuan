<?php

namespace App\Http\Controllers;

use App\Mail\CastrationAndSpayEmail;
use Carbon\Carbon;
use App\Models\AreaRegion;
use App\Models\AreaBarangay;
use App\Models\AreaProvince;
use Illuminate\Http\Request;
use App\Models\AreaMunicipality;
use App\Models\CastrationAndSpay;
use Illuminate\Support\Facades\DB;
use App\Models\CastrationAndSpayAvailability;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\File;

class CastrationAndSpayController extends Controller
{

    public function create()
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

        return view('guestviews.services.castrationandspay.create', [
            'regions' => $regions,
            'blockAppointmentDates' => $blockAppointmentDates,
            'groupedSchedule' => $groupedSchedule,
            'bookedSlots' => $bookedSlots,
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

    public function store(Request $request)
    {
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
            'g-recaptcha-response' => ['required']
        ], [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.', // ✅ Custom message
        ]);

        unset($data['g-recaptcha-response']);

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

        if (!empty($data['email'])) {
            Mail::to($data['email'])->send(new CastrationAndSpayEmail($data));
        };

        return redirect()->route(
            'castrationandspay.form',
            $record->id
        )->with('success', 'Request successfully sent!');
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

    public function form($id)
    {
        $record = DB::table('castration_and_spays as a')
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

        return view('guestviews.services.castrationandspay.form', [
            'record' => $record,
            'qrBase64' => $qrBase64
        ]);
    }

    public function track()
    {
        return view('guestviews.services.castrationandspay.track');
    }

    public function tracksearch(Request $request)
    {
        $request->validate([
            'tracking_number' => ['required']
        ]);

        $trackData = DB::table('castration_and_spays as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->where('a.transaction_number', $request->tracking_number)
            ->select(
                'a.*',
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

        return view('guestviews.services.castrationandspay.trackresult', [
            'trackData' => $trackData,
            'qrBase64' => $qrBase64
        ]);
    }

    public function tracksearchFromLink(Request $request)
    {
        $request->validate([
            'tracking_number' => ['required']
        ]);

        $trackData = DB::table('castration_and_spays as a')
            ->join('area_regions as b', 'a.region_id', 'b.region_id')
            ->join('area_provinces as c', 'a.province_id', 'c.province_id')
            ->join('area_municipalities as d', 'a.municipality_id', 'd.municipality_id')
            ->join('area_barangays as e', 'a.barangay_id', 'e.barangay_id')
            ->where('a.transaction_number', $request->tracking_number)
            ->select(
                'a.*',
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

        return view('guestviews.services.castrationandspay.trackresult', [
            'trackData' => $trackData,
            'qrBase64' => $qrBase64
        ]);
    }
}
