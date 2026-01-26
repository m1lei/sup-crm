<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Deal;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(Request $request){

        return view('dashboard');
    }
}
