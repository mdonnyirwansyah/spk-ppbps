<?php

namespace App\Http\Controllers;

use App\DataTables\RecruitmentDataTable;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RecruitmentController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(RecruitmentDataTable $dataTable)
    {
        return $dataTable->render('app.recruitment.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.recruitment.create');
    }

    /**
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
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function edit(Recruitment $recruitment)
    {
        return view('app.recruitment.edit', compact('recruitment'));
    }

    /**
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
     * @param  \App\Models\Recruitment  $recruitment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recruitment $recruitment)
    {
        $recruitment->delete();

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}
