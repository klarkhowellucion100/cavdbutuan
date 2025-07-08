<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmMechanizationDashboardController extends Controller
{
    public function index()
    {
        return view('userviews.services.dashboard.farmmechanization.index');
    }
}
