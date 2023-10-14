<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Landing\StoreRequest;
use App\Http\Requests\Panel\Landing\UpdateRequest;
use App\Models\CountryAndCity;
use App\Models\Landing;
use App\Models\Product;
use App\Models\Template;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $landings = Landing::orderBy('id', 'desc')
            ->get()
            ->transform(function ($row) {
                if ($row->template->path === "region") {
                    $filter = \App\Models\CountryAndCity::find($row->relation_id);
                    $row->relation_name = isset($filter->name) ? $filter->name : "Ну выбрано";
                }

                if ($row->template->path === "country") {
                    $filter = \App\Models\CountryAndCity::find($row->relation_id);
                    $row->relation_name = isset($filter->name) ? $filter->name : "Нe выбрано";
                }

                if ($row->template->path === "complex") {
                    $filter = Product::find($row->relation_id);
                    $row->relation_name = isset($filter->name) ? $filter->name : "Нe выбрано";
                }

                return $row;
            });


        return view('panel.landings.index', compact('landings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = CountryAndCity::whereNull('parent_id')->get();
        $cities = CountryAndCity::whereNotNull('parent_id')->with('country')->get();
        $complexes = Product::has('layouts')->orderBy('name')->get();
        $templates = Template::all();
        return view('panel.landings.create', compact('templates', 'countries', 'cities', 'complexes'));
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

        // Кладём картинку в хранилище Storage
        if (isset($data['main_photo'])) {
            $data['main_photo'] = $this->save_image($data['main_photo']);
        }

        // Кладём картинку в хранилище Storage
        if (isset($data['territory'])) {
            $data['territory'] = $this->save_image($data['territory']);
        }

        // Кодируем массив в json
        if (isset($data['main_lists'])) {
            $data['main_lists'] = json_encode($data['main_lists']);
        }

        // Сохраняем картинку и кодируем массив в json
        if (isset($data['about_description'])) {
            foreach ($data['about_description'] as $key => $value) {
                if (isset($value['photo'])) {
                    $data['about_description'][$key]['photo'] = $this->save_image($value['photo']);
                }
            }

            $data['about_description'] = json_encode($data['about_description']);
        }

        if (isset($data['purchase_terms'])) {
            $data['purchase_terms'] = json_encode($data['purchase_terms']);
        }

        if (isset($data['sight_cards'])) {
            foreach ($data['sight_cards'] as $key => $value) {
                if (isset($value['photo'])) {
                    $data['sight_cards'][$key]['photo'] = $this->save_image($value['photo']);
                }
            }

            $data['sight_cards'] = json_encode($data['sight_cards']);
        }

        Landing::create($data);
        return new JsonResponse(['data' => $data],200);
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
        $countries = CountryAndCity::whereNull('parent_id')->get();
        $cities = CountryAndCity::whereNotNull('parent_id')->with('country')->get();
        $complexes = Product::has('layouts')->orderBy('name')->get();
        $templates = Template::all();
        return view('panel.landings.edit', compact('landing', 'countries', 'cities', 'complexes', 'templates'));
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

        // Кладём картинку в хранилище Storage
        if (isset($data['main_photo'])) {
            $data['main_photo'] = $this->save_image($data['main_photo']);
        } else {
            unset($data['main_photo']);
        }

        // Кладём картинку в хранилище Storage
        if (isset($data['territory'])) {
            $data['territory'] = $this->save_image($data['territory']);
        } else {
            unset($data['territory']);
        }

        // Кодируем массив в json
        if (isset($data['main_lists'])) {
            $data['main_lists'] = json_encode($data['main_lists']);
        }

        // Сохраняем картинку и кодируем массив в json
        if (isset($data['about_description'])) {
            foreach ($data['about_description'] as $key => $value) {
                if (isset($value['photo'])) {
                    $data['about_description'][$key]['photo'] = $this->save_image($value['photo']);
                } else {
                    $decoded = json_decode($landing->about_description);
                    $data['about_description'][$key]['photo'] = $decoded[$key]->photo;
                }
            }

            $data['about_description'] = json_encode($data['about_description']);
        }

        if (isset($data['purchase_terms'])) {
            $data['purchase_terms'] = json_encode($data['purchase_terms']);
        }

        if (isset($data['sight_cards'])) {
            $decoded = json_decode($landing->sight_cards);

            foreach ($data['sight_cards'] as $key => $value) {
                if (isset($value['photo'])) {
                    $data['sight_cards'][$key]['photo'] = $this->save_image($value['photo']);
                } else {
                    $data['sight_cards'][$key]['photo'] = $decoded[$key]->photo;
                }
            }

            $data['sight_cards'] = json_encode($data['sight_cards']);
        }

        $landing->update($data);
        return new JsonResponse(['data' => $data],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Landing $landing)
    {
        $landing->delete();

        return redirect()->route('panel.landings.index');
    }

    private function save_image($image) : string
    {
//        $data['image'] = Storage::disk('public')->put('/images', $data['image']);
        $fileName = 'landing_' . rand() . '.' . $image->getClientOriginalExtension();
        $filePath = $image->move('uploads', $fileName);
        return $filePath;
    }
}
