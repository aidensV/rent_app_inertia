<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Labs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = (new Items())->newQuery();
        $labs->where("type", "lab");
        if (request()->has('search')) {
            $labs->where('name', 'Like', '%' . request()->input('search') . '%');
        }

        if (request()->query('sort')) {
            $attribute = request()->query('sort');
            $sort_order = 'ASC';
            if (strncmp($attribute, '-', 1) === 0) {
                $sort_order = 'DESC';
                $attribute = substr($attribute, 1);
            }
            $labs->orderBy($attribute, $sort_order);
        } else {
            $labs->latest();
        }

        $labs = $labs->paginate(5)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Admin/LabManagement/Index', [
            'labs' => $labs,
            'filters' => request()->all('search'),
            'can' => [
                'create' => Auth::user()->can('manajemen lab create'),
                'edit' => Auth::user()->can('manajemen lab edit'),
                'delete' => Auth::user()->can('manajemen lab delete'),
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
        return Inertia::render('Admin/LabManagement/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Items::create($request->all());

        return redirect()->route('lab-manage.index')
        ->with('message', __('created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\labs  $labs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lab = Items::find($id);
        return Inertia::render('Admin/LabManagement/Show', [
            'labs' => $lab,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\labs  $labs
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lab = Items::find($id);
        return Inertia::render('Admin/LabManagement/Edit', [
            'labs' => $lab,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\labs  $labs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lab = Items::find($id);
        $lab->update($request->all());

        return redirect()->route('lab-manage.index')
        ->with('message', __('Data updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\labs  $labs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lab = Items::find($id);
        $lab->delete();

        return redirect()->route('lab-manage.index')
        ->with('message', __('Data deleted successfully'));
    }
}
