<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FarmMechanizationAvailability;

class FarmMechanizationAvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function availabilityindex()
    {
        $availabilityDates = FarmMechanizationAvailability::orderByRaw("
    FIELD(day_name, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')
")->get();


        return view('userviews.services.farmmechanization.availability.index', [
            'availabilityDates' => $availabilityDates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function availabilitycreate(Request $request)
    {
        return view('userviews.services.farmmechanization.availability.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function availabilitystore(Request $request)
    {
        $request->validate([
            'day_name' => ['required'],
            'time_from' => ['required'],
            'time_to' => ['required']
        ]);

        FarmMechanizationAvailability::create([
            'code' => Str::uuid(),
            'day_name' => $request->day_name,
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'status' => 1,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('farmmechanization.user.availability.index')->with('success', 'Schedule added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function availabilitybulkdelete(Request $request)
    {
        $ids = $request->input('selected_ids');
        if ($ids) {
            DB::table('farm_mechanization_availabilities')->whereIn('id', $ids)->delete();
        }
        return redirect()->back()->with('success', 'Selected records deleted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function availabilitybulkdisable(Request $request)
    {

        $ids = $request->input('selected_ids');
        if ($ids) {
            DB::table('farm_mechanization_availabilities')->whereIn('id', $ids)->update(['status' => 0]);
        }
        return redirect()->back()->with('success', 'Selected records disable successfully.');
    }

    public function availabilitybulkenable(Request $request)
    {
        $ids = $request->input('selected_ids');
        if ($ids) {
            DB::table('farm_mechanization_availabilities')->whereIn('id', $ids)->update(['status' => 1]);
        }
        return redirect()->back()->with('success', 'Selected records enabled successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FarmMechanizationAvailability $farmMechanizationAvailability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FarmMechanizationAvailability $farmMechanizationAvailability)
    {
        //
    }
}
