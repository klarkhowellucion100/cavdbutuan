<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FarmMechanization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\FarmMechanizationBlockDates;

class FarmMechanizationBlockDatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function blockdatesindex(Request $request)
    {
        $filterDate = $request->input('filter_date');

        $blockedDates = FarmMechanizationBlockDates::get();

        $allBlockedDatesQuery = FarmMechanizationBlockDates::query();

        if ($filterDate) {
            $allBlockedDatesQuery->whereDate('block_date', '=', $filterDate);
        }

        $allBlockedDates = $allBlockedDatesQuery->paginate(10, ['*'], 'allBlockedDates_page');


        return view('userviews.services.farmmechanization.blockdates.index', [
            'allBlockedDates' => $allBlockedDates,
            'blockedDates' => $blockedDates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function blockdatescreate()
    {
        return view('userviews.services.farmmechanization.blockdates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function blockdatesstore(Request $request)
    {
        $request->validate([
            'block_date' => ['required'],
            'reason' => ['required']
        ]);

        $blockDate = FarmMechanizationBlockDates::create([
            'block_date' => $request->block_date,
            'reason' => $request->reason,
            'user_id' => Auth::id(),
            'code' => Str::uuid()
        ]);

        return redirect()->back()->with('success', 'Successfully blocked the date');
    }

    public function blockdatesbulkdelete(Request $request)
    {
        $ids = $request->input('selected_ids');
        if ($ids) {
            DB::table('farm_mechanization_block_dates')->whereIn('id', $ids)->delete();
        }
        return redirect()->back()->with('success', 'Selected records deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FarmMechanizationBlockDates $farmMechanizationBlockDates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FarmMechanizationBlockDates $farmMechanizationBlockDates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FarmMechanizationBlockDates $farmMechanizationBlockDates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FarmMechanizationBlockDates $farmMechanizationBlockDates)
    {
        //
    }
}
