<?php

namespace App\Http\Controllers;

use App\Models\Recruitment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $totalRecruitment = Recruitment::count();
        $recruitment = Recruitment::orderBy('id', 'DESC')->take(3)->get();

        return view('app.dashboard', compact( 'totalRecruitment', 'recruitment'));
    }
}
