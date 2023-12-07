<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreRequest;
use App\Http\Requests\Admin\Products\UpdateRequest;
use App\Models\ExchangeRate;
use App\Models\Layout;
use App\Models\LayoutPhoto;
use App\Models\Locale;
use App\Models\Option;
use App\Models\ProductLocale;
use App\Services\CurrencyService;
use App\Services\ImageService;
use App\Services\PreviewImageService;
use App\Services\SlugService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\PhotoTable;
use Illuminate\Support\Facades\File;
use App\Models\CountryAndCity;
use App\Models\ProductDrawing;
use Illuminate\Support\Facades\Log;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ProductController extends Controller
{
    private $previewImageService;
    private $imageService;
    private $currencyService;
    private $slugService;

    public function __construct(
        PreviewImageService $previewImageService,
        CurrencyService $currencyService,
        ImageService $imageService,
        SlugService $slugService
    )
    {
        $this->previewImageService = $previewImageService;
        $this->imageService = $imageService;
        $this->currencyService = $currencyService;
        $this->slugService = $slugService;
    }

    public function all_product($id)
    {
        $category = Peculiarities::where('id', $id)->first();

        if ($category == null){
            return redirect()->back();
        }

        $get = ProductCategory::where('peculiarities_id', $id)->get()->pluck('product_id')->toarray();
        $product = Product::whereIn('id', $get)->where('sale_or_rent','sale')->orderBy('id', 'desc')->paginate(10);
        return view('admin.Product.all',compact('category','product'));
    }

    public function rent_product($id)
    {
        $category = Peculiarities::where('id', $id)->first();

        if ($category  == null){
            return redirect()->back();
        }

        $get = ProductCategory::where('peculiarities_id', $id)->get()->pluck('product_id')->toarray();
        $product = Product::wherein('id', $get)->where('sale_or_rent','rent')->orderBy('id', 'desc')->paginate(10);
        return view('admin.Product.all',compact('category','product'));
    }


    public function create_product_page($id)
    {
        $country = CountryAndCity::orderby('name', 'asc')->where('parent_id', null)->get();
        $category = Peculiarities::where('id', $id)->first();
        $categorys = Peculiarities::all();
        $options =  Option::all();
        $exchanges =  ExchangeRate::all();
        $photo_categories = \App\Models\PhotoCategory::all();
        return view('admin.Product.create', compact('category','categorys','country','options', 'photo_categories', 'exchanges'));
    }

    public function create_product(StoreRequest $request)
    {
        $data = $request->validated();

        // Получаем планировки
        $layouts = isset($data['layouts']) ? $data['layouts'] : null;
        unset($data['layouts']);

        // Получаем фото для Product
        $photos = isset($data['photo']) ? $data['photo'] : null;
        unset($data['photo']);

        // Конвертируем цену
        $data['base_price'] = $this->currencyService->convertPriceToEur($data['price'], $data['price_code']);
        // Настраиваем option_id (для лендингов)
        $data['option_id'] = (is_numeric($data['option_id']) && $data['option_id'] > 0) ? $data['option_id'] : null;
        $data['lat'] = preg_replace( '/[^0-9.]+$/',  '',  $data['lat']);
        $data['long'] = preg_replace( '/[^0-9.]+$/',  '',  $data['long']);

        // Создаём переменные
        $description = $data['description'];
        $disposition = $data['disposition'];
        $deadline = $data['deadline'];
        unset($data['description'], $data['disposition'], $data['deadline']);

        // Создание продукта
        $create = Product::create($data);

        // Создаём slug для объекта
        if (is_null($create->slug)) {
            $create->update([
                'slug' => $this->slugService->make($create->id)
            ]);
        }

        // Перевод и добавление полей описаний
        $this->translateForNew($create->id, $description, $disposition, $deadline);


        // Создаём планировки для созданного объекта
        if(!is_null($layouts)) {
            $this->createLayouts($layouts, $create->id);
        }

        // Закрепляем особенности за созданным объектом
        if (isset($request->osobenosti)){
            foreach ($request->osobenosti as $item) {
                $get_category = Peculiarities::where('id', $item)->first();
                ProductCategory::create([
                    'product_id' => $create->id,
                    'peculiarities_id' => $item,
                    'type' => $get_category->type,
                ]);
            }
        }

        // Добавление фотографий
        $time = time();
        if (isset($photos)){
            foreach ($photos as $key => $photo){
                $fileName = $this->imageService->saveWebp($photo);

                PhotoTable::create([
                    'parent_model'=> '\App\Models\Product',
                    'parent_id' => $create->id,
                    'photo' => $fileName,
                    'preview' => $this->previewImageService->update($fileName),
                    'category_id' => (isset($request->photo_categories) && $request->photo_categories["new_" . $key] > 0) ? $request->photo_categories["new_" . $key] : null
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Product Created',
            'url' => route('all_product', $request->category_id)
        ],200);
    }

    public function single_page_product($id)
    {
        // Получаем элемент
        $get = Product::with('layouts')
            ->with('locale_fields.locale')
            ->where('id', $id)
            ->first();

//        // Выводим корректную цену в соответствии с указанной валютой
//        $get->price = $this->currencyService->displayWithCurrency($get->price, $get->price_code);
//
//        // Выводим корректную цену в соответствии с указанной валютой в планировках
//        if (isset($get->layouts)) {
//            foreach ($get->layouts as $layout) {
//                $layout->price = $this->currencyService->displayWithCurrency($layout->price, $layout->price_code);
//            }
//        }

        if ($get == null) {
            return redirect()->back();
        }

        $country = CountryAndCity::orderbY('name','asc')->where('parent_id', null)->get();
        $city = CountryAndCity::orderBy('name','asc')->where('parent_id',$get->country_id)->get();
        $product_category = $get->ProductCategory->where('type', 'Типы');
        $get_new_category = Peculiarities::whereNotIn('id', $get->ProductCategory->pluck('peculiarities_id'))->where('type','Особенности')->get();
        $categorys =  Peculiarities::get();
        $options =  Option::all();

        $exchanges = [];
        foreach (ExchangeRate::all() as $exchange) {
            $exchanges[] = $exchange->relative;
        }
        $exchanges[] = "RUB";

        $photo_categories = \App\Models\PhotoCategory::all();
        $get_old_category = ProductCategory::where('product_id', $get->id)->where('type', 'Особенности')->get();

        return view('admin.Product.single', compact('city','country','get','get_new_category', 'categorys', 'product_category','get_old_category','options', 'photo_categories', 'exchanges'));
    }

    public function delete_osobenosti($id)
    {
        ProductCategory::where('id', $id)->delete();
        return redirect()->back()->with('false', 'Особенность успешно удалена');
    }

    public function delete_product_photo($id)
    {
        $get = PhotoTable::where('id', $id)->first();

        $image_path = public_path("uploads/{$get->photo}");
//        dd($image_path );
        if (File::exists($image_path)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        $get->delete();

        return redirect()->back()->with('true', 'Фотография удалена');
    }

    public function update_product(UpdateRequest $request)
    {
        $data = $request->validated();

        // Получаем планировки
        $layouts = isset($data['layouts']) ? $data['layouts'] : null;
        unset($data['layouts']);

        // Получаем фото для Product
        $photos = isset($data['photo']) ? $data['photo'] : null;
        unset($data['photo']);

        $product = Product::with('layouts')->find($request->product_id);

        // Конвертируем цену
        $data['base_price'] = $this->currencyService->convertPriceToEur($data['price'], $data['price_code']);
        // Настраиваем option_id (для лендингов)
        $data['option_id'] = (is_numeric($data['option_id']) && $data['option_id'] > 0) ? $data['option_id'] : null;
        $data['lat'] = preg_replace( '/[^0-9.]+$/',  '',  $data['lat']);
        $data['long'] = preg_replace( '/[^0-9.]+$/',  '',  $data['long']);

        // Обновление текстовых полей description и disposition
        $this->updateDescriptionAndDisposition($product, $data['description'], $data['disposition'], $data['deadline']);
        unset($data['description'], $data['disposition'], $data['deadline']);

        // Проверка поля slug на уникальность
        if (isset($data['slug'])) {
            $check = Product::where('slug', $data['slug'])->whereNot('id', $product->id)->first();
            if (!is_null($check)) {
                return Redirect::back()->withErrors(['slug' => ['Название продукта в url не уникально']]);
            }
            unset($check);
        }

        // Обновляем данные
        $product->update($data);

        // Обновляем или удаляем планировки для созданного объекта
        if(!is_null($layouts)) {
            $this->updateLayouts($layouts, $product);
        } else {
            foreach ($product->layouts as $layout) {
                $layout->delete();
            }
            $product->update(['complex_or_not' => "Нет"]);
        }

        // Закрепление особенностей за обновлённым объектом
        if (isset($request->osobenosti)){
            ProductCategory::where('product_id', $request->product_id)->delete();
            $uniqueArray = array_unique($request->osobenosti);

            foreach ($uniqueArray as $item) {
                $get_category = Peculiarities::where('id', $item)->first();
                if ($get_category != null){
                    ProductCategory::create([
                        'product_id' => $request->product_id,
                        'peculiarities_id' => $item,
                        'type' => $get_category->type,
                    ]);
                }
            }

           ProductCategory::create([
               'product_id' => $request->product_id,
               'peculiarities_id' => $request->category_id,
               'type' => 'Типы',
           ]);
        }

        // Создание фото для обновлённого объекта
        if (!is_null($photos)) {
            $time = time();
            foreach ($photos as $key => $photo){
                $fileName = $this->imageService->saveWebp($photo);

                PhotoTable::create([
                    'parent_model'=> '\App\Models\Product',
                    'parent_id' => $request->product_id,
                    'photo' => $fileName,
                    'preview' => $this->previewImageService->update($fileName),
                    'category_id' => $request->photo_categories["new_".$key] > 0 ? $request->photo_categories["new_".$key] : null
                ]);
            }
        }

        // Добавление категорий для фото обновлённого объекта
        if (isset($request->photo_categories)) {
            foreach ($request->photo_categories as $key => $category) {
                $data = [];

                if (gettype($key) != "string") {
                    $data['category_id'] = $category > 0 ? $category : null;
                    PhotoTable::whereId($key)->update($data);
                    unset($data);
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Product Updated',
            'url' => route('single_page_product', $request->product_id)
        ],200);
    }

    private function translateForNew($product_id, $description, $disposition, $deadline)
    {
        $locales = Locale::all();

        foreach ($locales as $locale) {
            $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

            $tmp_description = !empty($description) ? $tr->trans($description, $locale->code, "ru") : null;
            $tmp_disposition = !empty($disposition) ? $tr->trans($disposition, $locale->code, "ru") : null;
            $tmp_deadline = !empty($deadline) ? $tr->trans($deadline, $locale->code, "ru") : null;

            ProductLocale::create([
                "product_id" => $product_id,
                "locale_id" => $locale->id,
                "description" => $tmp_description,
                "disposition" => $tmp_disposition,
                "deadline" => $tmp_deadline,
            ]);

            unset($tmp_description, $tmp_disposition, $tmp_deadline);
        }
    }

    private function updateDescriptionAndDisposition($product, $description, $disposition, $deadline)
    {
        $locales = Locale::all();

        foreach ($product->locale_fields as $key => $value) {
            if (!is_null($locales->where('code', $value->locale->code)->first())) {
                unset($locales[$locales->where('code', $value->locale->code)->first()->id - 1]);
            }

            $value->description = $description[$value->locale->code];
            $value->disposition = $disposition[$value->locale->code];
            $value->deadline = $deadline[$value->locale->code];
            $value->save();
        }

        // Не заполненные поля
        if (!empty($locales)) {
            foreach ($locales as $key => $locale) {
                ProductLocale::create([
                    "product_id" => $product->id,
                    "locale_id" => $locale->id,
                    "description" => $description[$locale->code],
                    "disposition" => $disposition[$locale->code],
                    "deadline" => $deadline[$locale->code],
                ]);
            }
        }
    }

    public function delete_product($id){
        $get = Product::where('id', $id)->first();

        if ($get == null){
            return redirect()->back();
        }
        foreach ($get->photo as $photo){
            $image_path = public_path("uploads/{$photo->photo}");

            if (File::exists($image_path)) {
                unlink($image_path);
            }
        }

        $cat = ProductCategory::where('product_id', $id)->where('type', 'Типы')->first();
        $get->delete();

        $category = !is_null($cat) ? $cat->peculiarities_id : 2;

        return redirect()->route('all_product', $category)->with('true', "Удаления адреса $get->address завершено");

    }

    public function delete_drawing($id){
        $get = ProductDrawing::where('id', $id)->first();
        if ($get == null) {
            return redirect()->back();
        }

        $image_path = public_path("uploads/{$get->photo}");
        if (File::exists($image_path)) {
            unlink($image_path);
        }

        $get->delete();
        return redirect()->back();
    }

    private function createLayouts($layouts, $product_id)
    {
        foreach ($layouts as $key => $layout) {
            $this->createLayout($layout, $product_id);
        }
    }

    private function updateLayouts($layouts, $product)
    {
        // Выбираем колонку id всех планировок, которые пришли
        $columns = array_column($layouts, 'id');

        // Проверим, если в layouts отсутствуют те планировки, которые есть в $products, то удалим их
        foreach ($product->layouts as $layout) {
            if (!in_array($layout->id, $columns)) {
                $tmp = Layout::find($layout->id);
                $tmp->photos()->delete();
                $tmp->delete();
                unset($tmp);

                Log::info('Destroyed layout - ' . $layout->id);
            }
        }

        // Создадим или обновим колонки
        foreach ($layouts as $key => $layout) {
            if (stripos($layout['id'], "new_") !== false) {
                $this->createLayout($layout, $product->id);
            } else {
                $this->updateLayout($layout, $product->id);
            }
        }
    }

    private function createLayout($data, $product_id)
    {
        // Добавим поле для связи
        $data['complex_id'] = $product_id;
        $photos = isset($data['photos']) ? $data['photos'] : null;
        unset($data['id']);
        unset($data['photos']);

        // Обрабатываем цену
        if (isset($data['price']) && isset($data['price_code'])) {
            $data['base_price'] = $this->currencyService->convertPriceToEur($data['price'], $data['price_code']);
        }

        $created_layout = Layout::create($data);
        $this->handleLayoutPhotos($photos, $created_layout);
//        if (!is_null($photos)) {
//            // Создание фотографий планировок
//            foreach ($photos as $key => $photo) {
//                LayoutPhoto::create([
//                    'url' => $this->imageService->saveWebp($photo['file'], 'layout_'),
//
//                    'layout_id' => $created_layout->id
//                ]);
//            }
//        }

        return $created_layout;
    }

    private function updateLayout($data, $product_id)
    {
        $layout = Layout::find($data['id']);

        // Обрабатываем цену
        if (isset($data['price']) && isset($data['price_code'])) {
            $data['base_price'] = $this->currencyService->convertPriceToEur($data['price'], $data['price_code']);
        }

        $photos = isset($data['photos']) ? $data['photos'] : null;
        unset($data['photos']);

        if (!is_null($layout)) {
            // Добавим поле для связи
            $data['complex_id'] = $product_id;
            unset($data['id']);

            // Обновление планировки
            $layout->update($data);

            // Обработка фотографий
            $this->handleLayoutPhotos($photos, $layout);
//            if (!is_null($photos)) {
//                // Удаление фото планировок
//                $layout->photos()->delete();
//
//                // Создание фото планировок
//                foreach ($photos as $key => $photo) {
//                    LayoutPhoto::create([
//                        'url' => $this->imageService->saveWebp($photo, 'layout_'),
//                        'layout_id' => $layout->id
//                    ]);
//                }
//            }

        }

        return $layout;
    }

    private function handleLayoutPhotos($photos, $layout)
    {
        // Выбираем колонку id всех планировок, которые пришли
        $columns = array_column($photos, 'id');

        // Если фотографии находящиеся в layout не пришли - удалим их
        foreach ($layout->photos as $photo) {
            if (!in_array($photo->id, $columns)) {
                $tmp = LayoutPhoto::find($photo->id);
                $tmp->delete();
                unset($tmp);

                Log::info('Destroyed layout photo - ' . $photo->id);
            }
        }

        // Создадим или обновим фотографии
        foreach ($photos as $key => $photo) {
            if (stripos($photo['id'], "new_") !== false) {
                if (isset($photo['file'])) {
                    Log::info($photo);
                    Log::info(isset($photo['name']) ? $photo['name'] : null);
                    LayoutPhoto::create([
                        'url'       => 'uploads/' . $this->imageService->saveWebp($photo['file'], 'layout_'),
                        'layout_id' => $layout->id,
                        'name'      => isset($photo['name']) ? $photo['name'] : null,
                    ]);
                }
            } else {
                $layoutPhoto = LayoutPhoto::find($photo['id']);

                // Обновляем только если существуют: $layoutPhoto и layout->id
                if (!is_null($layoutPhoto) && isset($layout->id)) {
                    $tmp = [];

                    // Валидация массива
                    if (isset($photo['file'])) {
                        $tmp['url'] = 'uploads/' . $this->imageService->saveWebp($photo['file'], 'layout_');
                    }
                    $tmp['name'] = isset($photo['name']) ? $photo['name'] : null;
                    $tmp['layout_id'] = isset($layout->id) ? $layout->id : null;

                    // Обновление
                    $layoutPhoto->update($tmp);
                    unset($tmp);
                }
            }
        }
    }
}
