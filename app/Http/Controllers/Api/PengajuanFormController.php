<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FormClearance;
use Illuminate\Http\Request;

class PengajuanFormController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cl = FormClearance::with('user')->get();
        return response()->json([
            "message" => "success",
            "data" => $cl
        ]);
    
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cl = new FormClearance();
        $cl->description = $request->description;
        $cl->status = 'waiting';
        $cl->user_id = $request->user()->id;
        $cl->date_trx = now();
        $cl->save();
        return response()->json([
            "message" => "success",
            "data" => $cl
        ]);
    }
}
