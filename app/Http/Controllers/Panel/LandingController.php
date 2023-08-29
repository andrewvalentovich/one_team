<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Landing\StoreRequest;
use App\Http\Requests\Panel\Landing\UpdateRequest;
use App\Models\Landing;
use App\Models\Template;
use Illuminate\Http\Request;
use ValueError;

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

        // Вызов команды для создания SSL-сертификата
        $this->ssl_create_command($data['subdomain']);

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

        // Удаление ssl для старого поддомена и создание ssl для нового
        $this->ssl_delete_command($landing->subdomain);
        $this->ssl_create_command($data['subdomain']);

        $landing->update($data);

        return redirect()->route('panel.landings.show', compact('landing'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Landing $landing)
    {
        $landing->delete();

        // Выполнение команды удаления ssl-сертификата
        $this->ssl_delete_command($landing->subdomain);

        return redirect()->route('panel.landings.index');
    }

    /**
     * Команда удаления ssl-сертификата
     * @param string $subdomain
     */
    private function ssl_delete_command(string $subdomain) :void
    {
        $command = "sudo certbot delete --cert-name ".$subdomain.".".config('app.domain');
        $command_code = 0;
        $command_result = [];

        exec($command, $command_result, $command_code);
    }

    /**
     * Команда создания ssl-сертификата
     * @param string $subdomain
     * @return mixed
     */
    private function ssl_create_command(string $subdomain)
    {
        $command = "sudo certbot certonly -d ".$subdomain.".".config('app.domain')." --expand --nginx";
        $command_code = 0;
        $command_result = [];

        try {
            exec($command, $command_result, $command_code);
        } catch (ValueError $exception) {
            return back()->withError("Сommand $command was not called")->withInput();
        }
    }
}
