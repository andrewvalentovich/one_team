<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CurrencyService;
use App\Services\LayoutService;
use App\Services\SortService;
use Illuminate\Http\Request;
use App\Models\favorite;
class FavoriteController extends Controller
{
    private $currencyService;
    private $sortService;
    private $layoutService;

    public function __construct(CurrencyService $currencyService, SortService $sortService, LayoutService $layoutService)
    {
        $this->currencyService = $currencyService;
        $this->sortService = $sortService;
        $this->layoutService = $layoutService;
    }

    public function deleteFavorite(Request $request){
        favorite::where('user_id',  $_COOKIE["user_id"])->where('product_id', $request->product_id)->delete();
        $count =favorite::where('user_id',  $_COOKIE["user_id"])->count();
        return response()->json([
            'status' => true,
            'message' => 'deleted',
            'counts' => $count
        ],200);
    }

    public function delete_my_all_favorite(){
        favorite::where('user_id',  $_COOKIE["user_id"])->delete();
        return redirect()->back();
    }


    public function my_favorites(Request $request){
//        $gets = favorite::query();
//
//        $gets->where('user_id',  $_COOKIE["user_id"])->with('product');
//
//        if (isset($request->order_by)){
//            if ($request->order_by == 'price_asc') {
//                $gets->join('products', 'favorites.product_id', '=', 'products.id')
//                    ->orderBy('products.price', 'asc');
//            }
//
//            if ($request->order_by == 'price_desc') {
//                $gets->join('products', 'favorites.product_id', '=', 'products.id')
//                    ->orderBy('products.price', 'desc');
//            }
//            if ($request->order_by == 'id_desc') {
//                $gets->orderby('product_id', 'desc');
//            }
//        }
//        $get_product = $gets->with('product')->paginate(9);

        $user_id = $_COOKIE["user_id"];

        $get_product = Product::whereHas('favorite', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->with('photo')
            ->with('ProductCategory')
            ->with('peculiarities')
            ->with(['layouts' => function($query) {
                $query->with('photos');
                $query->orderBy('price', 'asc');
            }])
            ->paginate(9);

        // Для каждого объекта у которого есть планировки, выставляем цену минимальной планировки
        for ($i = 0; $i < count($get_product); $i++) {
            if (isset($get_product[$i]->layouts) && count($get_product[$i]->layouts) > 0) {
                $get_product[$i]->price = $get_product[$i]->layouts[0]->price;
            }
        }

        // Меняем параметры (для фронта)
        foreach ($get_product as $key => $object) {
            // Тэги
            $object->getTags(app()->getLocale());

            $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->price, (int)$object->size);
            $object->price = $this->currencyService->getPriceFromDB((int)$object->price);
            if(isset($object->country)) {
                $object->price_credit = $this->currencyService->getPriceSize((int)$object->base_price, $object->country->inverse_credit_ratio);
            }

            // Получаем уникальные планировки
            $object->number_rooms_unique = $this->layoutService->getUniqueNumberRooms($object->layouts);

            // Цена за квартиру и за метр для планировок
            if (isset($object->layouts)) {
                foreach ($object->layouts as $index => $layout) {
                    if(isset($object->country)) {
                        $layout->price_credit = $this->currencyService->getPriceSize((int)$layout->base_price, $object->country->inverse_credit_ratio);
                    }
                    $layout->price_size = $this->currencyService->getPriceSizeFromDB((int)$layout->price, (int)$layout->total_size);
                    $layout->price = $this->currencyService->getPriceFromDB((int)$layout->price);
                }
            }

            // Особенности
            // Можно использовать Scopes!!!
            $object->gostinnie = !empty($object->peculiarities->whereIn('type', "Гостиные")->first()) ? $object->peculiarities->whereIn('type', "Гостиные")->first()->name : null;
            $object->vanie = !empty($object->peculiarities->whereIn('type', "Ванные")->first()) ? $object->peculiarities->whereIn('type', "Ванные")->first()->name : null;
            $object->spalni = !empty($object->peculiarities->whereIn('type', "Спальни")->first()) ? $object->peculiarities->whereIn('type', "Спальни")->first()->name : null;
            $object->do_more = !empty($object->peculiarities->whereIn('type', "До моря")->first()) ? $object->peculiarities->whereIn('type', "До моря")->first()->name : null;
            $object->type_vid = !empty($object->peculiarities->whereIn('type', "Вид")->first()) ? $object->peculiarities->whereIn('type', "Вид")->first()->name : null;
            $object->peculiarities = !empty($object->peculiarities->whereIn('type', "Особенности")->all()) ? $object->peculiarities->whereIn('type', "Особенности")->all() : null;
        }

        $count = count($get_product);
        return view('project.favorite', compact('get_product', 'count'));
    }


    public function add_or_delete_in_favorite(Request $request)
    {
        $get = favorite::where('user_id', $request->user_id)->where('product_id', $request->product_id)->first();

        if ($get == null ){
            favorite::create([
               'user_id' => $request->user_id,
               'product_id' => $request->product_id
            ]);

            $get_count = favorite::where('user_id', $request->user_id)->count();
            return response()->json([
               'status' => true,
               'message' => 'created',
                'counts' => $get_count
            ]);
        }else{
            $get->delete();
            $get_count = favorite::where('user_id', $request->user_id)->count();
            return response()->json([
                'status' => true,
                'message' => 'deleted',
                'counts' => $get_count
            ]);

        }
    }
}
