<?php

namespace App\Http\Controllers;

use App\DataTables\CriteriaDataTable;
use App\Models\Criteria;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CriteriaDataTable $dataTable)
    {
        return $dataTable->render('app.criteria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recruitment = Recruitment::all();

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
        $validator = Validator::make($request->all(), [
            'recruitment' => 'required',
            'name' => 'required',
            'weight' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            $slug = Str::slug($request->name.'-'.$request->recruitment);
            $isDuplicate = Criteria::where('slug', $slug)->first() ? true : false;

            if ($isDuplicate) {
                return response()->json(['failed' => 'Data sudah ada!']);
            } else {
                $limit = 1;
                $totalWeight = Criteria::where('recruitment_id', $request->recruitment)->sum('weight') + $request->weight;
                $isWeightOverLimit = $totalWeight >= $limit ? true : false;
                if ($isWeightOverLimit) {
                    return response()->json(['warning' => 'Bobot melebihi batas!']);
                } else {
                    $criteria = new Criteria();
                    $criteria->recruitment_id = $request->recruitment;
                    $criteria->name = $request->name;
                    $criteria->weight = floatval($request->weight);
                    $criteria->slug = $slug;
                    $criteria->save();

                    return response()->json(['success' => 'Data baru berhasil ditambah!']);
                }
            }
        } else {
            return response()->json(['error' => $validator->errors()]);
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
        $recruitment = Recruitment::all();

        return view('app.criteria.edit', compact('criteria', 'recruitment'));
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
        $validator = Validator::make($request->all(), [
            'recruitment' => 'required',
            'name' => 'required|unique:criterias,name',
            'weight' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            $slug = Str::slug($request->name.'-'.$request->recruitment);
            $limit = 1;
            $totalWeight = Criteria::where('recruitment_id', $request->recruitment)->sum('weight') - $criteria->weight + $request->weight;
            $isWeightOverLimit = $totalWeight > $limit ? true : false;
            if ($isWeightOverLimit) {
                return response()->json(['warning' => 'Bobot melebihi batas!']);
            } else {
                $criteria->recruitment_id = $request->recruitment;
                $criteria->name = $request->name;
                $criteria->weight = floatval($request->weight);
                $criteria->slug = $slug;
                $criteria->save();

                return response()->json(['success' => 'Data berhasil diperbarui!']);
            }
        } else {
            return response()->json(['error' => $validator->errors()]);
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
}
