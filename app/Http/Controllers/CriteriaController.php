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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitments = Recruitment::all();

        return view('app.criteria.index', compact('recruitments'));
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

        return redirect(route('criteria.create', $recruitment));
    }

    /**
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function create(Recruitment $recruitment)
    {
        return view('app.criteria.create', compact('recruitment'));
    }

    /**
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

        $weight = floatval($request->weight / 100);
        $slug = Str::slug($request->name.'-'.$request->recruitment);
        $isDuplicate = Criteria::where('slug', $slug)->first() ? true : false;

        if ($isDuplicate) {
            return redirect()->back()->with('error', 'Data sudah ada!');
        } else {
            $limit = 1;
            $totalWeight = Criteria::where('recruitment_id', $request->recruitment)->sum('weight') + $weight;
            $isWeightOverLimit = $totalWeight > $limit ? true : false;
            if ($isWeightOverLimit) {
                return redirect()->back()->with('error', 'Bobot melebihi batas!');
            } else {
                Criteria::create([
                    'recruitment_id' => $request->recruitment,
                    'name' => $request->name,
                    'type' => $request->type,
                    'weight' => $weight,
                    'slug' => $slug
                ]);

                return redirect()->route('criteria.index')->with('success', 'Data baru berhasil ditambah!');
            }
        }
    }

    /**
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Criteria $criteria)
    {
        return view('app.criteria.edit', compact('criteria'));
    }

    /**
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

        $weight = floatval($request->weight / 100);
        $slug = Str::slug($request->name.'-'.$request->recruitment);
        $isDuplicate = Criteria::where('slug', $slug)->first() ? true : false;

        if ($isDuplicate && $criteria->weight == $request->weight) {
            return redirect()->back()->with('error', 'Data sudah ada!');
        } else {
            $limit = 1;
            $totalWeight = Criteria::where('recruitment_id', $request->recruitment)->sum('weight') - $criteria->weight + $weight;
            $isWeightOverLimit = $totalWeight > $limit ? true : false;
            if ($isWeightOverLimit) {
                return redirect()->back()->with('error', 'Bobot melebihi batas!');
            } else {
                $criteria->update([
                    'recruitment_id' => $request->recruitment,
                    'name' => $request->name,
                    'type' => $request->type,
                    'weight' => $weight,
                    'slug' => $slug
                ]);

                return redirect()->route('criteria.index')->with('success', 'Data berhasil diperbarui!');
            }
        }
    }

    /**
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criteria)
    {
        $criteria->delete();

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_all(Request $request)
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
