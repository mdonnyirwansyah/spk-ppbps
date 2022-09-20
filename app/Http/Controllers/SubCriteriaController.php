<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Recruitment;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SubCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitments = Recruitment::all();

        return view('app.sub-criteria.index', compact('recruitments'));
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
            'criteria' => 'required'
        ]);

        $criteria = Criteria::find($request->criteria);

        return redirect(route('sub-criteria.create', $criteria));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function create(Criteria $criteria)
    {
        return view('app.sub-criteria.create', compact('criteria'));
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
            'name' => 'required',
            'rating' => 'required',
        ]);

        $weight = $request->rating;

        switch ($weight) {
            case 'Sangat Tinggi':
                $weight = 5;
                break;

            case 'Tinggi':
                $weight = 4;
                break;

            case 'Cukup':
                $weight = 3;
                break;

            case 'Rendah':
                $weight = 2;
                break;

            case 'Sangat Rendah':
                $weight = 1;
                break;

            default:
                $weight = null;
                break;
        }

        $slug = Str::slug($request->name.'-'.$request->criteria);
        $isDuplicate = SubCriteria::where('criteria_id', $request->criteria)->where('rating', $request->rating)->first() ? true : false;

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Data sudah ada!');
        } else {
            SubCriteria::create([
                'criteria_id' => $request->criteria,
                'name' => $request->name,
                'rating' => $request->rating,
                'weight' => $weight,
                'slug' => $slug
            ]);

            return redirect()->route('sub-criteria.index')->with('success', 'Data baru berhasil ditambah!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCriteria  $subCriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCriteria $subCriteria)
    {
        $criteria = Criteria::find($subCriteria->criteria_id);

        return view('app.sub-criteria.edit', compact('subCriteria', 'criteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCriteria  $subCriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCriteria $subCriteria)
    {
        $request->validate([
            'name' => 'required',
            'rating' => 'required'
        ]);

        $weight = $request->rating;

        switch ($weight) {
            case 'Sangat Tinggi':
                $weight = 5;
                break;

            case 'Tinggi':
                $weight = 4;
                break;

            case 'Cukup':
                $weight = 3;
                break;

            case 'Rendah':
                $weight = 2;
                break;

            case 'Sangat Rendah':
                $weight = 1;
                break;

            default:
                $weight = null;
                break;
        }

        $slug = Str::slug($request->name.'-'.$request->criteria);
        $isDuplicate = SubCriteria::where('id', '!=', $subCriteria->id)->where('criteria_id', $request->criteria)->where('rating', $request->rating)->count() >= 1 ? true : false;

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Data sudah ada!');
        } else {
            $subCriteria->update([
                'criteria_id' => $request->criteria,
                'name' => $request->name,
                'rating' => $request->rating,
                'weight' => $weight,
                'slug' => $slug
            ]);

            return redirect()->route('sub-criteria.index')->with('success', 'Data berhasil diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCriteria  $subCriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCriteria $subCriteria)
    {
        $subCriteria->delete();

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
        $subCriterias = SubCriteria::where('criteria_id', $request->criteria)->get();

        return DataTables::of($subCriterias)
        ->addIndexColumn()
        ->addColumn('action', function ($subCriteria) {
            return '
                <a data-toggle="tooltip" data-placement="top" title="Edit" href="'.route('sub-criteria.edit', $subCriteria).'" class="btn btn-icon">
                    <i class="fas fa-pen text-info"></i>
                </a>
                <button data-toggle="tooltip" data-placement="top" title="Hapus" onClick="deleteRecord('.$subCriteria->id.')" id="delete-'.$subCriteria->id.'" delete-route="'.route('sub-criteria.destroy', $subCriteria).'" class="btn btn-icon">
                    <i class="fas fa-trash text-danger"></i>
                </button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCriteria(Request $request)
    {
        $criterias = Criteria::where('recruitment_id', $request->recruitment)->get();

        return response()->json(['criterias' => $criterias]);
    }
}
