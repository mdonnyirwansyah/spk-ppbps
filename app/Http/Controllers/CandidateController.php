<?php

namespace App\Http\Controllers;

use App\Exports\CandidatesExport;
use App\Imports\CandidateImport;
use App\Models\Candidate;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

use function PHPSTORM_META\map;

class CandidateController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitments = Recruitment::all();

        return view('app.candidate.index', compact('recruitments'));
    }

    /**
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
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function create(Recruitment $recruitment)
    {
        return view('app.candidate.create', compact('recruitment'));
    }

    /**
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

        if ($countSlug >= 1) {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);

        if ($validator->passes()) {
            Excel::import(new CandidateImport($request->recruitment), $request->file('file'));

            return response()->json(['success' => 'Data baru berhasil diimport!']);
        }

        return response()->json(['error' => $validator->errors()]);
    }

    /**
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        return view('app.candidate.edit', compact('candidate'));
    }

    /**
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update_status(Request $request, Candidate $candidate)
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
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        $candidate->delete();

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_all(Request $request)
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

    /**
     * @return \Illuminate\Http\Response
     */
    public function export()
    {
        $export = new CandidatesExport([
            ['Kandidat Satu'],
            ['Kandidat Dua']
        ]);

        return Excel::download($export, 'candidates.xlsx');
    }
}
