<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Option\UpdateRequest;
use App\Http\Requests\Admin\Option\StoreRequest;
use App\Models\Option;
use App\Models\Product;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = Option::orderBy('id', 'desc')->get();
        return view('admin.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Option::create($data);

        return redirect()->route('admin.options.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        return view('admin.options.show', compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return view('admin.options.edit', compact('option'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Option $option)
    {
        $data = $request->validated();

        $option->update($data);

        return redirect()->route('admin.options.show', compact('option'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        Product::where('option_id', $option->id)->update(['option_id' => null]);

        $option->delete();
        return redirect()->route('admin.options.index');
    }
}
