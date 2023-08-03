<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExchangeRate\StoreRequest;
use App\Http\Requests\Admin\ExchangeRate\UpdateRequest;
use App\Models\ExchangeRate;
use Illuminate\Support\Facades\Storage;

class ExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exchange_rates = ExchangeRate::orderBy('created_at', 'desc')->get();
        return view('admin.ExchangeRate.index', compact('exchange_rates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exchange_names = ExchangeRate::getExchangeNames();
        return view('admin.ExchangeRate.create', compact('exchange_names'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        ExchangeRate::create($data);

        return redirect()->route('admin.exchange_rates.index');
    }

    /**
     * Display the specified resource.
     * @param ExchangeRate $exchange_rate
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(ExchangeRate $exchange_rate)
    {
        $exchange_names = ExchangeRate::getExchangeNames();
        return view('admin.ExchangeRate.show', compact('exchange_rate', 'exchange_names'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param ExchangeRate $exchange_rate
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(ExchangeRate $exchange_rate)
    {
        $exchange_names = ExchangeRate::getExchangeNames();
        return view('admin.ExchangeRate.edit', compact('exchange_rate', 'exchange_names'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRequest $request
     * @param ExchangeRate $exchange_rate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, ExchangeRate $exchange_rate)
    {
        $data = $request->validated();
        $exchange_rate->update($data);

        return redirect()->route('admin.exchange_rates.show', compact('exchange_rate'));
    }

    /**
     * Remove the specified resource from storage.
     * @param ExchangeRate $exchange_rate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(ExchangeRate $exchange_rate)
    {
        $exchange_rate->delete();
        return redirect()->route('admin.exchange_rates.index');
    }
}
