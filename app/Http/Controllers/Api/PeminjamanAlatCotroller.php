<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\TransactionsAlat;
use App\Models\TransactionsItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanAlatCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = TransactionsAlat::with('user', 'items.item')->get();
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
        DB::beginTransaction();
        try {
            $alat = json_decode($request->barang);
            $date = $request->tgl_trx;
            $transaction = new TransactionsAlat();
            $transaction->trx_date = $date;
            $transaction->user_id = $request->user()->id;
            $transaction->description = $request->description;
            $transaction->save();
            $items = [];
            foreach ($alat as $key => $value) {
                array_push($items, [
                    "transactions_alat_id" => $transaction->id,
                    "item_id" => $value->id,
                    "qty" => $value->qty
                ]);
                $it = Items::find($value->id);
                $it->qty -= $value->qty;
                $it->update();
            }

            TransactionsItems::insert($items);
            DB::commit();
            return response()->json(
                [
                    "message" => "Success",
                    "data" => $transaction
                ]
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                [
                    "message" => $th->getMessage()
                ],
                500
            );
        }
    }
}
