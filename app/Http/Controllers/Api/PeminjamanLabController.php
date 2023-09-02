<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class PeminjamanLabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transactions::with('user', 'item')->whereHas("item")->get();
        return response()->json(
            [
                "message" => "Success",
                "data" => $transactions
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $transaction = new Transactions();
            $transaction->name = $request->name;
            $transaction->trx_date = $request->date_trx;
            $transaction->course = $request->course;
            $transaction->start_time = $request->start_jam;
            $transaction->end_time = $request->start_jam;
            $transaction->item_id = $request->items;
            $transaction->user_id = $request->user()->id;
            $transaction->description = $request->description;
            $transaction->dosen_nip = $request->dosen_nip;
            $transaction->dosen_name = $request->dosen_name;
            $transaction->save();
            return response()->json([
                "message" => "success",
                "data" => $transaction
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
            ],500);
        }
      
    }
}
