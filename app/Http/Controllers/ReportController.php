<?php

namespace App\Http\Controllers;

use App\Exports\AssessmentsExport;
use App\Models\Assessment;
use App\Models\Recruitment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitments = Recruitment::all();

        return view('app.report.index', compact('recruitments'));
    }

    /**
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
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function show(Recruitment $recruitment)
    {
        $sawResults = Assessment::dss_saw($recruitment->id);

        return view('app.report.show', compact('recruitment', 'sawResults'));
    }

    /**
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function pdf_export(Recruitment $recruitment)
    {
        $fileName = (str_replace(' ', '-', strtolower('report-'.$recruitment->title.'.pdf')));
        $sawResults = Assessment::dss_saw($recruitment->id);
        $pdf = Pdf::loadView('app.report.pdf', compact('recruitment', 'sawResults'))
        ->setPaper('a4');

        return $pdf->stream($fileName);
    }

    /**
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function excel_export(Recruitment $recruitment)
    {
        $fileName = (str_replace(' ', '-', strtolower('report-'.$recruitment->title.'.xlsx')));

        return Excel::download(new AssessmentsExport($recruitment->id), $fileName);
    }
}
