<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitment = Recruitment::all();

        return view('app.preference.index', compact('recruitment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'sub_criterias' => 'required|array',
            "sub_criterias.*"  => "required|string|distinct|min:1",
        ]);

        if ($validator->passes()) {
            DB::transaction(function() use ($request) {
                $preference = new Preference();
                $preference->candidate_id = $request->candidate_id;
                $preference->save();

                if ($preference) {
                    $preference->sub_criterias()->sync($request->sub_criterias);
                }
            });

            return response()->json(['success' => 'Data baru berhasil ditambah!']);
        } else {
            return response()->json(['error' => $validator->errors()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function show(Preference $preference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function edit(Preference $preference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preference $preference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preference $preference)
    {
        //
    }
}
