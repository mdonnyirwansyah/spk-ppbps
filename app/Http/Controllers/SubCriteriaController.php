<?php

namespace App\Http\Controllers;

use App\DataTables\SubCriteriaDataTable;
use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCriteria  $subCriteria
     * @return \Illuminate\Http\Response
     */
    public function show(SubCriteria $subCriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCriteria  $subCriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCriteria $subCriteria)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCriteria  $subCriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCriteria $subCriteria)
    {
        //
    }
}
