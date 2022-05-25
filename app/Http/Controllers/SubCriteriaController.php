<?php

namespace App\Http\Controllers;

use App\DataTables\SubCriteriaDataTable;
use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SubCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubCriteriaDataTable $dataTable)
    {
        return $dataTable->render('app.sub-criteria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $criteria = Criteria::all();

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
        $validator = Validator::make($request->all(), [
            'criteria' => 'required',
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

        if ($validator->passes()) {
            $slug = Str::slug($request->name.'-'.$request->criteria);
            $isDuplicate = SubCriteria::where('slug', $slug)->first() || SubCriteria::where('criteria_id', $request->criteria)->where('rating', $request->rating)->first() ? true : false;

            if ($isDuplicate) {
                return response()->json(['failed' => 'Data sudah ada!']);
            } else {
                $subCriteria = new SubCriteria();
                $subCriteria->criteria_id = $request->criteria;
                $subCriteria->name = $request->name;
                $subCriteria->rating = $request->rating;
                $subCriteria->weight = $weight;
                $subCriteria->slug = $slug;
                $subCriteria->save();

                return response()->json(['success' => 'Data baru berhasil ditambah!']);
            }
        } else {
            return response()->json(['error' => $validator->errors()]);
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
        $criteria = Criteria::all();

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
        $validator = Validator::make($request->all(), [
            'criteria' => 'required',
            'name' => 'required|unique:sub_criterias,name',
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

        if ($validator->passes()) {
            $slug = Str::slug($request->name.'-'.$request->criteria);
            $isDuplicate = SubCriteria::where('slug', $slug)->first() || SubCriteria::where('criteria_id', $request->criteria)->where('rating', $request->rating)->first() ? true : false;

            if ($isDuplicate) {
                return response()->json(['failed' => 'Data sudah ada!']);
            } else {
                $subCriteria->criteria_id = $request->criteria;
                $subCriteria->name = $request->name;
                $subCriteria->rating = $request->rating;
                $subCriteria->weight = $weight;
                $subCriteria->slug = $slug;
                $subCriteria->save();

                return response()->json(['success' => 'Data berhasil diperbarui!']);
            }
        } else {
            return response()->json(['error' => $validator->errors()]);
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
}
