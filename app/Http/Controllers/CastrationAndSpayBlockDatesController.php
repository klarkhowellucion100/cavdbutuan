<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\CastrationAndSpayBlockDates;
use App\Models\FarmMechanizationBlockDates;

class CastrationAndSpayBlockDatesController extends Controller
{
    public function blockdatesindex(Request $request)
    {
        $filterDate = $request->input('filter_date');

        $blockedDates = CastrationAndSpayBlockDates::get();

        $allBlockedDatesQuery = CastrationAndSpayBlockDates::query();

        if ($filterDate) {
            $allBlockedDatesQuery->whereDate('block_date', '=', $filterDate);
        }

        $allBlockedDates = $allBlockedDatesQuery->paginate(10, ['*'], 'allBlockedDates_page');


        return view('userviews.services.castrationandspay.blockdates.index', [
            'allBlockedDates' => $allBlockedDates,
            'blockedDates' => $blockedDates
        ]);
    }

    public function blockdatescreate()
    {
        return view('userviews.services.castrationandspay.blockdates.create');
    }

    public function blockdatesstore(Request $request)
    {
        $request->validate([
            'block_date' => ['required'],
            'reason' => ['required']
        ]);

        $blockDate = CastrationAndSpayBlockDates::create([
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
            DB::table('castration_and_spay_block_dates')->whereIn('id', $ids)->delete();
        }
        return redirect()->back()->with('success', 'Selected records deleted successfully.');
    }
}
