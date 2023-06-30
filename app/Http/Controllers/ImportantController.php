<?php

namespace App\Http\Controllers;

// use App\Models\Status;

use App\Models\Important;
use Illuminate\Http\Request;


class ImportantController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:important-list|important-create|important-edit|important-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:important-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:important-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:important-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Important::orderBy('id', 'DESC')->paginate(10);

        return view('back.important.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.important.create');
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

        Important::create($input);

        return redirect()->route('important.index')
            ->with('success', 'Important created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $important = Important::find($id);

        return view('back.important.show', compact('important'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $important = Important::find($id);

        return view('back.important.edit', compact('important'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $ticket = Important::find($id);

        $ticket->update($request->all());

        return redirect()->route('important.index')
            ->with('success', 'Staus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Important::find($id)->delete();

        return redirect()->route('important.index')
            ->with('success', 'Important deleted successfully.');
    }
}
