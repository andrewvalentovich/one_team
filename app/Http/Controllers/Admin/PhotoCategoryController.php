<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PhotoCategory\UpdateRequest;
use App\Http\Requests\Admin\PhotoCategory\StoreRequest;
use App\Models\PhotoCategory;
use App\Models\PhotoTable;

class PhotoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photo_categories = PhotoCategory::orderBy('id', 'desc')->get();
        return view('admin.photo_categories.index', compact('photo_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.photo_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        PhotoCategory::create($data);

        return redirect()->route('admin.photo_categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PhotoCategory $photo_category)
    {
        return view('admin.photo_categories.show', compact('photo_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhotoCategory $photo_category)
    {
        return view('admin.photo_categories.edit', compact('photo_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, PhotoCategory $photo_category)
    {
        $data = $request->validated();

        $photo_category->update($data);

        return redirect()->route('admin.photo_categories.show', compact('photo_category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoCategory $photo_category)
    {
        PhotoTable::where('category_id', $photo_category->id)->update(['category_id' => null]);

        $photo_category->delete();
        return redirect()->route('admin.photo_categories.index');
    }
}
