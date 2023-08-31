<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Landing\StoreRequest;
use App\Http\Requests\Panel\Landing\UpdateRequest;
use App\Models\Landing;
use App\Models\Template;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landings = Landing::all();
        return view('panel.landings.index', compact('landings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $templates = Template::all();
        return view('panel.landings.create', compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        // Кладём в переменную $data['domain'] полный url с поддоменом - subdomain.domain.com
        $domain = explode("//", config('app.url'));
        $domain[0] = $domain[0]."//{$data['subdomain']}.";
        $data['domain'] = implode($domain);

        Landing::create($data);

        return redirect()->route('panel.landings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Landing $landing)
    {
        return view('panel.landings.show', compact('landing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Landing $landing)
    {
        $templates = Template::all();
        return view('panel.landings.edit', compact('landing', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Landing $landing)
    {
        $data = $request->validated();

        $domain = explode("//", config('app.url'));
        $domain[0] = $domain[0]."//{$data['subdomain']}.";
        $data['domain'] = implode($domain);

        $landing->update($data);

        return redirect()->route('panel.landings.show', compact('landing'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Landing $landing)
    {
        $landing->delete();

        return redirect()->route('panel.landings.index');
    }
}
