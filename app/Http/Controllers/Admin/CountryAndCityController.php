<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryAndCity\StoreRequest;
use App\Http\Requests\Admin\CountryAndCity\UpdateRequest;
use App\Models\Locale;
use App\Models\ProductLocale;
use App\Models\RegionLocale;
use App\Services\ImageService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use Illuminate\Support\Facades\File;
use App\Models\Metric;
use Illuminate\Support\Facades\Redirect;
use Stichoza\GoogleTranslate\GoogleTranslate;

class CountryAndCityController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function get_city(Request $request){
        $get = CountryAndCity::where('parent_id', $request->country_id)->get();

        return response()->json([
            'status' => true,
            'data' => $get
        ],200);
    }

    public function all_country(){
      $get =   CountryAndCity::where('parent_id', null)->orderBy('name')->paginate(10);
      return view('admin.Country.all', compact('get'));
    }

    public function new_country_page(){
        $metric = Metric::orderBy('name', 'asc')->get();
        return view('admin.Country.new',compact('metric'));
    }


    public function create_country(StoreRequest $request)
    {
        $data = $request->validated();
        $photo = null;
        $flag = null;

        // Если есть фото, создаём фото
        if (isset($data['photo'])){
            $data['photo'] = $this->imageService->saveWebp($data['photo']);
        }

        // Если есть флаг, создаём флаг
        if (isset($data['flag'])){
            $data['flag'] = $this->imageService->saveWebp($data['flag']);
        }

        // Объявление параметров для перевода
        $name = $data['name'];
        $div = $data['div'];
        unset($data['div']);

        // Создание региона
        $region = CountryAndCity::create($data);

        // Перевод названия и описания на разные языки
        $this->translateForNew($region, $name, $div);
        unset($name, $div);

        return redirect()->back()->with('true', 'Успешно добавлено - ' . $region->name);
    }


    public function single_country($id){
        $metric = Metric::orderBy('name', 'asc')->get();
        $locales = Locale::all();
        $get = CountryAndCity::with('locale_fields')->find($id);

        if ($get == null){
            return redirect()->back();
        }
        return view('admin.Country.single', compact('get','metric', 'locales'));
    }

    public function update_country(UpdateRequest $request){
        $data = $request->validated();
        $get = CountryAndCity::find($data['id']);
        if ($get == null){
            return redirect()->back();
        }
        unset($data['id']);

        // Проверка поля slug на уникальность
        if (isset($data['slug'])) {
            $country_and_city = CountryAndCity::where('slug', $data['slug'])->whereNot('id', $get->id)->first();
            if (!is_null($country_and_city)) {
                return Redirect::back()->withErrors(['slug' => ['Название города в url не уникально']]);
            }
        }

        $photo = null;
        $flag = null;

        if (isset($data['photo'])){
            $data['photo'] = $this->imageService->saveWebp($data['photo']);
        }

        if (isset($data['flag'])){
            $data['flag'] = $this->imageService->saveWebp($data['flag']);
        }

        // Обновление текстовых полей description и disposition
        $this->updateNameAndDiv($get, $data['name'], $data['div'] ?? null);
        $name = $data['name']['ru'];
        unset($data['name'], $data['div']);

        // Обновление полей региона
        $data['name'] = $name;
        $get->update($data);

        return redirect()->back()->with('true', 'Вы успешно завершили редактирование');

    }

    public function delete_country($id){
        $get = CountryAndCity::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }
        $image_path = public_path("uploads/{$get->photo}");
        if (File::exists($image_path)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        $get->delete();

        if ($get->parent_id == null){
            return redirect()->route('all_country')->with('true', "Вы успешно удалили страну из списка $get->name");
        } else {
            return redirect()->route('single_country',$get->parent_id)->with('true', "Вы успешно удалили город из списка $get->name");
        }
    }

    private function translateForNew($region, $name, $div)
    {
        $locales = Locale::all();

        $tr = new GoogleTranslate(); // init GoogleTranslate
        foreach ($locales as $locale) {

            $tmp_name = !empty($name) ? $tr->trans($name, $locale->code, "ru") : null;
            $tmp_div = !empty($div) ? $tr->trans($div, $locale->code, "ru") : null;

            RegionLocale::create([
                "region_id" => $region->id,
                "locale_id" => $locale->id,
                "name" => $tmp_name,
                "div" => $tmp_div,
            ]);

            unset($tmp_name, $tmp_div);
        }
    }

    private function updateNameAndDiv($region, $name, $div = null)
    {
        $locales = Locale::all();

        foreach ($region->locale_fields as $key => $value) {
            if (!is_null($locales->where('code', $value->locale->code)->first())) {
                unset($locales[$locales->where('code', $value->locale->code)->first()->id - 1]);
            }

            $value->name = $name[$value->locale->code];
            if (!is_null($div)) {
                $value->div = $div[$value->locale->code];
            } else {
                $value->div = null;
            }
            $value->save();
        }

        // Не заполненные поля
        if (!empty($locales)) {
            foreach ($locales as $key => $locale) {
                RegionLocale::create([
                    "region_id" => $region->id,
                    "locale_id" => $locale->id,
                    "name" => $name[$locale->code],
                    "div" => !is_null($div) ? $div[$locale->code] : null,
                ]);
            }
        }
    }
}
