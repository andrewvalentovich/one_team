<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreRequest;
use App\Http\Requests\Admin\Products\UpdateRequest;
use App\Models\ExchangeRate;
use App\Models\Layout;
use App\Models\LayoutPhoto;
use App\Models\Option;
use App\Services\CurrencyService;
use App\Services\ImageService;
use App\Services\PreviewImageService;
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

class ProductController extends Controller
{
    private $previewImageService;
    private $imageService;
    private $currencyService;

    public function __construct(PreviewImageService $previewImageService, CurrencyService $currencyService, ImageService $imageService)
    {
        $this->previewImageService = $previewImageService;
        $this->imageService = $imageService;
        $this->currencyService = $currencyService;
    }

    public function all_product($id)
    {
        $category = Peculiarities::where('id', $id)->first();

        if ($category  == null){
            return redirect()->back();
        }

        $get = ProductCategory::where('peculiarities_id', $id)->get()->pluck('product_id')->toarray();
        $product = Product::wherein('id', $get)->where('sale_or_rent','sale')->orderBy('id', 'desc')->paginate(10);
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
        // Планировки
        $layouts = $request->layouts;

//        for($i = 0; $i < count($layouts); $i++) {
//            // Добавление фотографий
//            if (isset($layouts[$i]['photos'])) {
//                if (is_array($layouts[$i]['photos'])) {
//                    foreach ($layouts[$i]['photos'] as $image) {
//                        // Перебор массива с картинками планировки
//                    }
//                } else {
//                    // работа с 1 картинкой планировки
//                }
//            }
//        }

        // Конвертируем цену
        $data['price'] = $this->currencyService->convertPriceToEur($data['price'], $data['price_code']);
        // Настраиваем option_id (для лендингов)
        $data['option_id'] = (is_numeric($data['option_id']) && $data['option_id'] > 0) ? $data['option_id'] : null;
        $data['lat'] = preg_replace( '/[^0-9.]+$/',  '',  $data['lat']);
        $data['long'] = preg_replace( '/[^0-9.]+$/',  '',  $data['long']);

        $create =  Product::create($data);

        // Создаём планировки для созданного объекта
        $this->createLayouts($layouts, $create->id);

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
        if (isset($request->photo)){
            foreach ($request->photo as $key => $photo){
                $file =  $photo;
                $fileName = $time++.'.'.$file->getClientOriginalExtension();
                $filePath = $file->move('uploads', $fileName);

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
        $get = Product::with('layouts')->where('id', $id)->first();

        // Выводим корректную цену в соответствии с указанной валютой
        $get->price = $this->currencyService->displayWithCurrency($get->price, $get->price_code);

        // Выводим корректную цену в соответствии с указанной валютой в планировках
        $objects = json_decode($get->objects);
        if(!is_null($objects)) {
            foreach ($objects as $key => $object) {
                $objects[$key]->price = $this->currencyService->displayWithCurrency($object->price, $object->price_code);
            }
            $get->objects = json_encode($objects);
            unset($objects);
        }

        if ($get == null){
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
        $layouts = $request->layouts;

        $product = Product::with('layouts')->find($request->product_id);

        // Конвертируем цену
        $data['price'] = $this->currencyService->convertPriceToEur($data['price'], $data['price_code']);
        // Настраиваем option_id (для лендингов)
        $data['option_id'] = (is_numeric($data['option_id']) && $data['option_id'] > 0) ? $data['option_id'] : null;
        $data['lat'] = preg_replace( '/[^0-9.]+$/',  '',  $data['lat']);
        $data['long'] = preg_replace( '/[^0-9.]+$/',  '',  $data['long']);

        // Обновляем данные
        $product->update($data);

        // Обновляем или удаляем планировки для созданного объекта
        $this->updateLayouts($layouts, $product);

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
        if (isset($request->photo)) {
            $time = time();
            foreach ($request->photo as $key => $photo){
                $file = $photo;
                $fileName = $time++.'.'.$file->getClientOriginalExtension();
                $filePath = $file->move('uploads', $fileName);

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
                    Log::info("PhotoCategory $key is not string");
                    $data['category_id'] = $category > 0 ? $category : null;
                    PhotoTable::whereId($key)->create($data);
                    unset($data);
                } else {
                    if (strripos($key, "new_") !== false) {
                        Log::info($category);
                        Log::info(strripos($key, "new_"));
                        $data['category_id'] = $category > 0 ? $category : null;
                        PhotoTable::whereId($key)->update($data);
                        unset($data);
                    }
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Product Updated',
            'url' => route('single_page_product', $request->product_id)
        ],200);
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

        return redirect()->route('all_product',$cat->peculiarities_id)->with('true', "Удаления адреса $get->address завершено");

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

        $created_layout = Layout::create($data);

        if (!is_null($photos)) {
            // Создание фото планировок
            foreach ($photos as $key => $photo) {
                LayoutPhoto::create([
                    'url' => $this->imageService->saveWebp($photo, 'layout_'),
                    'layout_id' => $created_layout->id
                ]);
            }
        }

        return $created_layout;
    }

    private function updateLayout($data, $product_id)
    {
        $layout = Layout::find($data['id']);
        $photos = isset($data['photos']) ? $data['photos'] : null;
        unset($data['photos']);

        if (!is_null($layout)) {
            // Добавим поле для связи
            $data['complex_id'] = $product_id;
            unset($data['id']);

            $layout->update($data);

            if (!is_null($photos)) {
                // Удаление фото планировок
                $layout->photos()->delete();

                // Создание фото планировок
                foreach ($photos as $key => $photo) {
                    LayoutPhoto::create([
                        'url' => $this->imageService->saveWebp($photo, 'layout_'),
                        'layout_id' => $layout->id
                    ]);
                }
            }

        }

        return $layout;
    }
}
