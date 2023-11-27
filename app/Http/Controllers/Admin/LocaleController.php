<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Locale\StoreRequest;
use App\Http\Requests\Admin\Locale\UpdateRequest;
use App\Models\Locale;
use App\Services\ImageService;
use Illuminate\Support\Facades\Redirect;

class LocaleController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locales = Locale::orderBy('created_at', 'desc')->get();
        return view('admin.locales.index', compact('locales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.locales.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if (isset($data['icon'])) {
            $data['icon'] = $this->imageService->saveWebp($data['icon']);
        }

        Locale::create($data);

        return redirect()->route('admin.locales.index');
    }

    /**
     * Display the specified resource.
     * @param Locale $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(Locale $locale)
    {
        return view('admin.locales.show', compact('locale'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Locale $locale
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(Locale $locale)
    {
        return view('admin.locales.edit', compact('locale'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateRequest $request
     * @param Locale $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Locale $locale)
    {
        $data = $request->validated();

        // Проверка поля slug на уникальность
        if (isset($data['slug'])) {
            $loc = Locale::where('code', $data['code'])->whereNot('id', $locale->id)->first();
            if (!is_null($loc)) {
                return Redirect::back()->withErrors(['code' => ['The code must be unique.']]);
            }
        }

        if (isset($data['icon'])) {
            $data['icon'] = $this->imageService->saveWebp($data['icon']);
        }

        $locale->update($data);

        return redirect()->route('admin.locales.edit', compact('locale'));
    }

    /**
     * Remove the specified resource from storage.
     * @param Locale $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Locale $locale)
    {
        $locale->delete();
        return redirect()->route('admin.locales.index');
    }
}
