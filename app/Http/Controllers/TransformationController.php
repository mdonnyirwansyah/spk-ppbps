<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruitment = Recruitment::all();
        $preference = Preference::whereRelation(
            'candidate', 'recruitment_id', 4
        )->first();
        $preferences = Preference::whereRelation(
            'candidate', 'recruitment_id', 4
        )->get();

        return view('app.transformation.index', compact('recruitment', 'preference', 'preferences'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $preference = Preference::whereRelation(
            'candidate', 'recruitment_id', $request->recruitment
        )->get();

        return DataTables::of($preference)
        ->addIndexColumn()
        ->addColumn('candidate', function ($preference) {
            return $preference->candidate->name;
        })
        ->addColumn('sub_criterias', function ($preference) {
            return $preference->sub_criterias->implode('name', ' | ');
        })
        ->make(true);
    }
}
