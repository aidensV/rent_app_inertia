<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormClearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FormclearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cl = (new FormClearance())->newQuery();
        if (request()->has('search')) {
            $cl->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (!Auth::user()->can('clearance approve')){
            $cl->where('user_id', Auth::user()->id );
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $cl->orderBy($attribute, $sort_order);
        } else {
            $cl->latest();
        }

        $cl = $cl->with('user')->paginate(5)->onEachSide(2)->appends(request()->query());
        $canCreate = Auth::user()->can('clearance create');
        if (FormClearance::where('user_id', Auth::user()->id)->exists()) {
            $canCreate = false;
        }
        return Inertia::render('Admin/FormClerance/Index', [
            'clearance' => $cl,
            'filters' => request()->all('search'),
            'can' => [
                'create' => $canCreate,
                'approve' => Auth::user()->can('clearance approve'),
                'delete' => Auth::user()->can('clearance delete'),
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
        $user = Auth::user();
        return Inertia::render('Admin/FormClerance/Create',compact("user"));
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
        $cl->user_id = AUth::user()->id;
        $cl->date_trx = now();
        $cl->save();
        return redirect()->route('form-clearance.index')
        ->with('message', __('Data created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cl = FormClearance::with('user')->find($id);

        return Inertia::render('Admin/FormClerance/Show', [
            'clearance' => $cl,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cl =  FormClearance::find($id);
        $cl->status = 'approved';
        $cl->update();
        return redirect()->route('form-clearance.index')
        ->with('message', __('Data updated successfully.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cl =  FormClearance::find($id);
        $cl->delete();
        return redirect()->route('form-clearance.index')
        ->with('message', __('Data updated successfully.'));
    }
}
