<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Criteria;
use App\Models\Recruitment;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitment = Recruitment::all();

        return view('app.candidate.index', compact('recruitment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Validator::make($request->all(), [
            'recruitment' => 'required',
        ])->validate();

        $recruitment = Recruitment::find($request->recruitment);

        return view('app.candidate.create', compact('recruitment'));
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
            'name' => 'required'
        ]);

        $slug = Str::slug($request->name);
        $countSlug = Candidate::where('slug', $slug)->count();

        if ($countSlug > 1) {
            $slug = Str::slug($request->name.'-'.$countSlug);
        }

        if ($validator->passes()) {
            $candidate = new Candidate();
            $candidate->recruitment_id = $request->recruitment;
            $candidate->name = $request->name;
            $candidate->slug = $slug;
            $candidate->save();

            return response()->json(['success' => 'Data baru berhasil ditambah!']);
        } else {
            return response()->json(['error' => $validator->errors()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        return view('app.candidate.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required, unique:candidates,name'
        ]);

        $slug = Str::slug($request->name);
        $countSlug = Candidate::where('slug', $slug)->count();

        if ($countSlug > 1) {
            $slug = Str::slug($request->name.'-'.$countSlug);
        }

        if ($validator->passes()) {
            $candidate = new Candidate();
            $candidate->recruitment_id = $request->recruitment;
            $candidate->name = $request->name;
            $candidate->slug = $slug;
            $candidate->save();

            return response()->json(['success' => 'Data baru berhasil ditambah!']);
        } else {
            return response()->json(['error' => $validator->errors()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $candidate = Candidate::where('recruitment_id', $request->recruitment)->get();

        return DataTables::of($candidate)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {
            return '
                <a data-toggle="tooltip" data-placement="top" title="Penilaian" href="'.route('candidate.grading', $data).'" class="btn btn-icon">
                    <i class="fas fa-file text-warning"></i>
                </a>
                <a data-toggle="tooltip" data-placement="top" title="Edit" href="'.route('candidate.edit', $data).'" class="btn btn-icon">
                    <i class="fas fa-pen text-info"></i>
                </a>
                <button data-toggle="tooltip" data-placement="top" title="Hapus" onClick="deleteRecord('.$data->id.')" id="delete-'.$data->id.'" delete-route="'.route('candidate.destroy', $data).'" class="btn btn-icon">
                    <i class="fas fa-trash text-danger"></i>
                </button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function grading(Candidate $candidate)
    {
        $criteria = Criteria::where('recruitment_id', $candidate->recruitment_id)->get();

        return view('app.candidate.grading', compact('candidate', 'criteria'));
    }
}
