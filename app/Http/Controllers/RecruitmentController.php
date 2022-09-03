<?php

namespace App\Http\Controllers;

use App\DataTables\RecruitmentDataTable;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RecruitmentDataTable $dataTable)
    {
        return $dataTable->render('app.recruitment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.recruitment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate( [
            'title' => 'required|unique:recruitments',
        ]);

        Recruitment::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title)
        ]);

        return redirect()->route('recruitment.index')->with('success', 'Data baru berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function edit(Recruitment $recruitment)
    {
        return view('app.recruitment.edit', compact('recruitment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recruitment $recruitment)
    {
        $request->validate([
            'title' => 'required|unique:recruitments,title',
        ]);

        $recruitment->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title)
         ]);

        return redirect()->route('recruitment.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recruitment $recruitment)
    {
        $recruitment->delete();

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}
