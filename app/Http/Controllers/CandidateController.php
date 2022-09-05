<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

use function PHPSTORM_META\map;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitments = Recruitment::all();

        return view('app.candidate.index', compact('recruitments'));
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

        return redirect(route('candidate.create', $recruitment));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function create(Recruitment $recruitment)
    {
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
        $request->validate([
            'name' => 'required'
        ]);

        $slug = Str::slug($request->name);
        $countSlug = Candidate::where('slug', $slug)->count();

        if ($countSlug > 1) {
            $slug = Str::slug($request->name.'-'.$countSlug);
        }

        Candidate::create([
            'recruitment_id' => $request->recruitment,
            'name' => $request->name,
            'slug' => $slug
        ]);

        return redirect()->route('candidate.index')->with('success', 'Data baru berhasil ditambah!');
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
        $request->validate([
            'name' => 'required|unique:candidates,name'
        ]);

        $slug = Str::slug($request->name);
        $countSlug = Candidate::where('slug', $slug)->count();

        if ($countSlug > 1) {
            $slug = Str::slug($request->name.'-'.$countSlug);
        }

        $candidate->update([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return redirect()->route('candidate.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Candidate $candidate)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required'
        ]);

        if ($validator->passes()) {
            $candidate->update([
                'status' => $request->status
            ]);

            return response()->json(['success' => 'Data status berhasil diperbarui!']);
        } else {
            return response()->json(['error' => 'Data status gagal diperbarui!']);
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
        $candidates = Candidate::where('recruitment_id', $request->recruitment)->get();

        return DataTables::of($candidates)
        ->addIndexColumn()
        ->addColumn('action', function ($candidate) {
            return '
                <a data-toggle="tooltip" data-placement="top" title="Edit" href="'.route('candidate.edit', $candidate).'" class="btn btn-icon">
                    <i class="fas fa-pen text-info"></i>
                </a>
                <button data-toggle="tooltip" data-placement="top" title="Hapus" onClick="deleteRecord('.$candidate->id.')" id="delete-'.$candidate->id.'" delete-route="'.route('candidate.destroy', $candidate).'" class="btn btn-icon">
                    <i class="fas fa-trash text-danger"></i>
                </button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
