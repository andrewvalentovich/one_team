<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Template\StoreRequest;
use App\Http\Requests\Panel\Template\UpdateRequest;
use App\Models\Landing;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::all();
        return view('panel.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Template::create($data);

        return redirect()->route('panel.templates.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        return view('panel.templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        return view('panel.templates.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Template $template)
    {
        $data = $request->validated();
        $template->update($data);

        return redirect()->route('panel.templates.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        Landing::where('template_id', $template->id)->update(['template_id' => null]);
        $template->delete();

        return redirect()->route('panel.templates.index');
    }
}
