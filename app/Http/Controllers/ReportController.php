<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Recruitment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitments = Recruitment::all();

        return view('app.report.index', compact('recruitments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        Validator::make($request->all(), [
            'recruitment' => 'required',
        ])->validate();

        $recruitment = Recruitment::find($request->recruitment);

        return redirect(route('report.show', $recruitment));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function show(Recruitment $recruitment)
    {
        $sawResults = Assessment::dss_saw($recruitment->id);

        return view('app.report.show', compact('recruitment', 'sawResults'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function print(Recruitment $recruitment)
    {
        $sawResults = Assessment::dss_saw($recruitment->id);
        $fileName = (str_replace(' ', '-', strtolower('report-'.$recruitment->title.'.pdf')));
        $pdf = Pdf::loadView('app.report.print', compact('recruitment', 'sawResults'))
        ->setPaper('a4');

        return $pdf->stream($fileName);
    }
}
