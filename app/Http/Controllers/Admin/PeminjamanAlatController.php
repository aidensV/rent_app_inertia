<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Transactions;
use App\Models\TransactionsAlat;
use App\Models\TransactionsItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PeminjamanAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = (new TransactionsAlat())->newQuery();
        if (request()->has('search')) {
            $transactions->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $transactions->orderBy($attribute, $sort_order);
        } else {
            $transactions->latest();
        }

        $transactions = $transactions->with('user')->paginate(5)->onEachSide(2)->appends(request()->query());
        return Inertia::render('Admin/PeminjamanAlat/Index', [
            'transactions' => $transactions,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('peminjaman alat create'),
                'edit' => Auth::user()->can('peminjaman alat edit'),
                'delete' => Auth::user()->can('peminjaman alat delete'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Items::where('status', 'available')->where("type", "other")->get();
        $user = Auth::user();
        return Inertia::render('Admin/PeminjamanAlat/Create', compact("items", "user"));
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
            $date = $request->date_trx;
            $transaction = new TransactionsAlat();
            $transaction->trx_date = $date;
            $transaction->user_id = Auth::user()->id;
            $transaction->description = $request->description;
            $transaction->save();
            $qty = array_filter($request->qty);
            $myarray = array_values($qty);
            $items = [];
            foreach ($request->items as $key => $value) {
                array_push($items,[
                    "transactions_alat_id" => $transaction->id,
                    "item_id" => $value,
                    "qty" => $myarray[$key]
                ]);
                $it = Items::find($value);
                $it->qty -= $myarray[$key];
                $it->update();
            }
            
            TransactionsItems::insert($items);
            DB::commit();
            return redirect()->route('peminjaman-alat.index')
                ->with('message', __('created successfully.'));
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions = TransactionsAlat::with('user','items.item')->find($id);

        return Inertia::render('Admin/PeminjamanAlat/Edit', [
            'transactions' => $transactions,
            'can' => [
                'create' => Auth::user()->can('peminjaman alat create'),
                'edit' => Auth::user()->can('peminjaman alat edit'),
                'delete' => Auth::user()->can('peminjaman alat delete'),
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transactions = Transactions::find($id);
        $transactions->status = "approved";
        $transactions->update();
        return redirect()->route('peminjaman.index')
        ->with('message', __('Approve successfully.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        foreach ($request->items as $key => $value) {
          TransactionsItems::where('id', $value['id'])->update([
            'description' => $value['description']
          ]);
        }
        $transactions = TransactionsAlat::find($id);
        $transactions->status = 'approved';
        $transactions->update();
        return redirect()->route('peminjaman-alat.index')
        ->with('message', __('Approve successfully.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactions = Transactions::find($id);
        $transactions->status = "canceled";
        $transactions->update();
        return redirect()->route('peminjaman.index')
        ->with('message', __('Cancel successfully.'));
    }
}
