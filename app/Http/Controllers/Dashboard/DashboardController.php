<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ganttSendings;

class DashboardController extends Controller
{
    //
    public function index(){
        setBreadCrumb('Dashboard');

        return view('dashboard.dashboard');
    }

    public function getSendingToday(){
        return $sendings = ganttSendings::where('client_id', '=', client_id())
            ->whereDate('start_date', date('Y-m-d'))
            ->orderBy('start_date')
            ->get();
    }
}
