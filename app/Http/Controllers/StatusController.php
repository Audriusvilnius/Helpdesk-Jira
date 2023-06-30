<?php

namespace App\Http\Controllers;

// use App\Models\Status;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class StatusController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:status-list|status-create|status-edit|status-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:status-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:status-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:status-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Status::orderBy('id', 'DESC')->paginate(10);

        return view('back.status.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.status.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
        $input = $request->except(['_token']);

        Status::create($input);

        return redirect()->route('status.index')
            ->with('success', 'Status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $status = Status::find($id);

        return view('back.status.show', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $status = Status::find($id);

        return view('back.status.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $ticket = Status::find($id);

        $ticket->update($request->all());

        return redirect()->route('status.index')
            ->with('success', 'Staus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Status::find($id)->delete();

        return redirect()->route('status.index')
            ->with('success', 'Status deleted successfully.');
    }
}
