<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitments = Recruitment::all();

        return view('app.criteria.index', compact('recruitments'));
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

        return redirect(route('criteria.create', $recruitment));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function create(Recruitment $recruitment)
    {
        return view('app.criteria.create', compact('recruitment'));
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
            'type' => 'required',
            'weight' => 'required|numeric|gt:0'
        ]);

        $slug = Str::slug($request->name.'-'.$request->recruitment);
        $isDuplicate = Criteria::where('slug', $slug)->first() ? true : false;

        if ($isDuplicate) {
            return response()->json(['failed' => 'Data sudah ada!']);
        } else {
            $limit = 1;
            $totalWeight = Criteria::where('recruitment_id', $request->recruitment)->sum('weight') + $request->weight;
            $isWeightOverLimit = $totalWeight > $limit ? true : false;
            if ($isWeightOverLimit) {
                return response()->json(['warning' => 'Bobot melebihi batas!']);
            } else {
                Criteria::create([
                    'recruitment_id' => $request->recruitment,
                    'name' => $request->name,
                    'type' => $request->type,
                    'weight' => floatval($request->weight),
                    'slug' => $slug
                ]);

                return redirect()->route('criteria.index')->with('success', 'Data baru berhasil ditambah!');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Criteria $criteria)
    {
        return view('app.criteria.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criteria $criteria)
    {
        $request->validate([
            'name' => 'required',
            'weight' => 'required|numeric',
        ]);

        $slug = Str::slug($request->name.'-'.$request->recruitment);
        $isDuplicate = Criteria::where('slug', $slug)->first() ? true : false;

        if ($isDuplicate && $criteria->weight == $request->weight) {
            return response()->json(['failed' => 'Data sudah ada!']);
        } else {
            $limit = 1;
            $totalWeight = Criteria::where('recruitment_id', $request->recruitment)->sum('weight') - $criteria->weight + $request->weight;
            $isWeightOverLimit = $totalWeight > $limit ? true : false;
            if ($isWeightOverLimit) {
                return response()->json(['warning' => 'Bobot melebihi batas!']);
            } else {
                $criteria->update([
                    'recruitment_id' => $request->recruitment,
                    'name' => $request->name,
                    'type' => $request->type,
                    'weight' => floatval($request->weight),
                    'slug' => $slug
                ]);

                return redirect()->route('criteria.index')->with('success', 'Data berhasil diperbarui!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criteria)
    {
        $criteria->delete();

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
        $criterias = Criteria::where('recruitment_id', $request->recruitment)->get();

        return DataTables::of($criterias)
        ->addIndexColumn()
        ->addColumn('weight', function ($criteria) {
            $percentage = $criteria->weight * 100;

            return $percentage.'%';
        })
        ->addColumn('action', function ($criteria) {
            return '
                <a data-toggle="tooltip" data-placement="top" title="Edit" href="'.route('criteria.edit', $criteria).'" class="btn btn-icon">
                    <i class="fas fa-pen text-info"></i>
                </a>
                <button data-toggle="tooltip" data-placement="top" title="Hapus" onClick="deleteRecord('.$criteria->id.')" id="delete-'.$criteria->id.'" delete-route="'.route('criteria.destroy', $criteria).'" class="btn btn-icon">
                    <i class="fas fa-trash text-danger"></i>
                </button>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
