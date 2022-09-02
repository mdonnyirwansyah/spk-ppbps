<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Candidate;
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
        $recruitment = Recruitment::all();

        return view('app.assessment.index', compact('recruitment'));
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

        return redirect(route('assessment.show', $recruitment));
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
            'sub_criterias' => 'required|array',
            "sub_criterias.*"  => "required|string|min:1",
        ]);

        if ($validator->passes()) {

            $assessments=[];
            foreach($request['criteria'] as $key => $criteria){
                $assessments[]=[
                    'candidate_id'=>$request->candidate_id,
                    'criteria_id'=>$criteria,
                    'weight'=>$request['sub_criterias'][$key]
                ];
            }

            DB::transaction(function() use ($request, $assessments) {
                foreach ($assessments as $assessment) {
                    Assessment::updateOrCreate([
                        'recruitment_id'=>$request['recruitment_id'],
                        'candidate_id'=>$request['candidate_id'],
                        'criteria_id'=>$assessment['criteria_id'],
                        ],[
                        'weight'=>$assessment['weight']
                        ]);
                }
            });

            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function show(Recruitment $recruitment)
    {
        $candidates = Candidate::where('recruitment_id', $recruitment->id)->orderBy('name','Asc')->has('assessments')->get();
        $sawResults = Assessment::dss_saw($recruitment->id);

        return view('app.assessment.show', compact('recruitment', 'candidates','sawResults'));
    }
}
