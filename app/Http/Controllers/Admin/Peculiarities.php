<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Peculiarity\StoreRequest;
use App\Http\Requests\Admin\Peculiarity\UpdateRequest;
use App\Models\Locale;
use App\Models\PeculiarityLocale;
use App\Models\RegionLocale;
use Illuminate\Http\Request;
use App\Models\Peculiarities as Peculiaritie;
use Illuminate\Support\Facades\Redirect;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Peculiarities extends Controller
{
    public function peculiarities_peculiarities($string){
        $get = Peculiaritie::where('type' , $string)->paginate(10);

        $type = $string;
        return view('admin.Peculiarities.peculiarities', compact('get','type'));
    }

    public function new_peculiarities($string){
        return view('admin.Peculiarities.new', compact('string'));
    }

    public function create_peculiarities(StoreRequest $request){
        $data = $request->validated();

        // Создание
        $peculiarity = Peculiaritie::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'type' => 'До моря'
        ]);

        // Перевод
        $this->translateForNew($peculiarity, $data['name']);

        return redirect()->back()->with('true', 'Добавление успешно завершено');
    }

    public function single_peculiarities($id)
    {
        $get = Peculiaritie::with('locale_fields.locale')->find($id);

        if ($get == null){
            return redirect()->back();
        }

        $string = $get->type;

        return view('admin.Peculiarities.single', compact('get','string'));
    }

    public function update_peculiarities(UpdateRequest $request)
    {
        $data = $request->validated();

        $get =  Peculiaritie::where('id', $request->id)->first();

        // Возвращаемся обратно, если не найдена особенность
        if ($get == null){
            return redirect()->back();
        }

        // Проверка поля slug на уникальность
        if (isset($data['slug'])) {
            $peculiarity = Peculiaritie::where('slug', $data['slug'])->whereNot('id', $get->id)->first();
            if (!is_null($peculiarity)) {
                return Redirect::back()->withErrors(['slug' => ['Название особенности в url не уникально']]);
            }
        }

        // Обновление названий
        $this->updateName($get, $data['name']);

        // Обновление данных
        $data['name'] = $data['name']['ru'];
        $get->update($data);

        return redirect()->back()->with('true', 'Редактирование Успешно завершено');

    }

    public function delete_peculiarities($id){
        $get =  Peculiaritie::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }
        $get->delete();
        return redirect()->route('peculiarities_peculiarities',$get->type )->with('true',"Вы успешно удалили $get->type  $get->name");
    }

    private function translateForNew($peculiarity, $name)
    {
        $locales = Locale::all();

        $tr = new GoogleTranslate(); // init GoogleTranslate
        foreach ($locales as $locale) {

            $tmp_name = !empty($name) ? $tr->trans($name, $locale->code, "ru") : null;

            PeculiarityLocale::create([
                "peculiarity_id" => $peculiarity->id,
                "locale_id" => $locale->id,
                "name" => $tmp_name,
            ]);

            unset($tmp_name);
        }
    }

    private function updateName($peculiarity, $name)
    {
        $locales = Locale::all();

        foreach ($peculiarity->locale_fields as $key => $value) {
            if (!is_null($locales->where('code', $value->locale->code)->first())) {
                unset($locales[$locales->where('code', $value->locale->code)->first()->id - 1]);
            }

            $value->name = $name[$value->locale->code];
            $value->save();
        }

        // Не заполненные поля
        if (!empty($locales)) {
            foreach ($locales as $key => $locale) {
                PeculiarityLocale::create([
                    "peculiarity_id" => $peculiarity->id,
                    "locale_id" => $locale->id,
                    "name" => $name[$locale->code],
                ]);
            }
        }
    }
}
