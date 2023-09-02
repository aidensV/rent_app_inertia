<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = (new Transactions())->newQuery();
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

        $transactions = $transactions->with('item')->paginate(5)->onEachSide(2)->appends(request()->query());
        $canCreate = Auth::user()->can('peminjaman create');
        return Inertia::render('Admin/Peminjaman/Index', [
            'transactions' => $transactions,
            'filters' => request()->all('search'),
            'can' => [
                'create' => $canCreate,
                'approve' => Auth::user()->can('peminjaman approve'),
                'delete' => Auth::user()->can('peminjaman delete'),
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
        $items = Items::where('status', 'available')->where("type", "lab")->get();
        $user = Auth::user();
        return Inertia::render('Admin/Peminjaman/Create', compact("items", "user"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $startTime = str_pad($request->start_jam, 2, '0', STR_PAD_LEFT) . ':' . str_pad($request->start_menit, 2, '0', STR_PAD_LEFT);
        // $endTime = str_pad("23", 2, '0', STR_PAD_LEFT) . ':' . str_pad("00", 2, '0', STR_PAD_LEFT);
        $transaction = new Transactions();
        $transaction->name = $request->name;
        $transaction->trx_date = $request->date_trx;
        $transaction->course = $request->course;
        $transaction->start_time = str_replace(' ', '', $startTime);
        // $transaction->end_time = str_replace(' ', '', $endTime);
        $transaction->item_id = $request->items;
        $transaction->user_id = Auth::user()->id;
        $transaction->description = $request->description;
        $transaction->dosen_nip = $request->dosen_nip;
        $transaction->dosen_name = $request->dosen_name;
        $transaction->save();
        return redirect()->route('peminjaman.index')
            ->with('message', __('created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
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
    public function update(Request $request,$id)
    {
        $transactions = Transactions::find($id);
        $transactions->status = "finished";
        $transactions->status = "finished";
        $transactions->description = $request->description;
        $transactions->end_time = now();
        $transactions->update();
        return redirect()->route('peminjaman.index')
        ->with('message', __('data has been saved successfully'));
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

    public function reportPdf($id)
    {
        $transaction = Transactions::with('user','item')->find($id);
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('report.pdf.peminjaman.report', compact('transaction'));
        return $pdf->stream('report.pdf');
    }

    public function closed($id)
    {
        $transaction = Transactions::with('user', 'item')->find($id);
        return Inertia::render('Admin/Peminjaman/Edit', [
            'transaction' => $transaction,
        ]);
        
    }
}
