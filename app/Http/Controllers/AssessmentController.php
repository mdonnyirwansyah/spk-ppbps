<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitments = Recruitment::all();

        return view('app.assessment.index', compact('recruitments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $request->validate([
            'recruitment' => 'required',
        ]);

        $recruitment = Recruitment::find($request->recruitment);

        return redirect(route('assessment.assessment', $recruitment));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_criterias' => 'required'
        ]);

        if ($validator->passes()) {
            if (count(Criteria::where('recruitment_id', $request['recruitment'])->get()) == count($request['sub_criterias'])) {
                $assessments=[];
                foreach($request['criterias'] as $index => $criteria){
                    $assessments[] = [
                        'candidate' => $request['candidate'],
                        'criteria' => $criteria,
                        'weight' => $request['sub_criterias'][$index]
                    ];
                }

                DB::transaction(function() use ($assessments) {
                    foreach ($assessments as $assessment) {
                        Assessment::updateOrCreate([
                            'candidate_id' => $assessment['candidate'],
                            'criteria_id' => $assessment['criteria'],
                        ], [
                            'weight' => $assessment['weight']
                        ]);
                    }
                });

                return response()->json(['success' => 'Data kriteria berhasil diperbarui!']);
            } else {
                return response()->json(['error' => 'Silahkan pilih semua kriteria!']);
            }
        } else {
            return response()->json(['error' => 'Data kriteria gagal diperbarui!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function assessment(Recruitment $recruitment)
    {
        return view('app.assessment.assessment', compact('recruitment'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function weight(Recruitment $recruitment)
    {
        $candidates = Candidate::where('recruitment_id', $recruitment->id)->orderBy('name','Asc')->has('assessments')->get();

        return view('app.assessment.weight', compact('recruitment', 'candidates'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function preference(Recruitment $recruitment)
    {
        $sawResults = Assessment::dss_saw($recruitment->id);

        return view('app.assessment.preference', compact('recruitment', 'sawResults'));
    }
}
