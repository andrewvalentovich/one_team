<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use App\Services\SortService;
use Illuminate\Http\Request;
use App\Models\favorite;
class FavoriteController extends Controller
{
    private $currencyService;
    private $sortService;

    public function __construct(CurrencyService $currencyService, SortService $sortService)
    {
        $this->currencyService = $currencyService;
        $this->sortService = $sortService;
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
        $gets = favorite::query();

        $gets->where('user_id',  $_COOKIE["user_id"])->with('product');

        if (isset($request->order_by)){
            if ($request->order_by == 'price_asc'){
                $gets->join('products', 'favorites.product_id', '=', 'products.id')
                    ->orderBy('products.price', 'asc');
            }

            if ($request->order_by == 'price_desc'){
                $gets->join('products', 'favorites.product_id', '=', 'products.id')
                    ->orderBy('products.price', 'desc');
            }
            if ($request->order_by == 'id_desc'){
                $gets->orderby('product_id', 'desc');
            }
        }
        $get_product = $gets->with('product')->paginate(9)
            ->through(function ($row) {
                $objects = [];
                $layouts_result = null;
                $min_price = 0;

                if (is_countable(json_decode($row->product->objects))) {

                    // Создаём индекс
                    $i = 0;
                    foreach (json_decode($row->product->objects) as $object) {
                        // Формируем новое поле price_size
                        $object->price_size = $this->currencyService->getPriceSizeFromDB((int)$object->price, (int)$object->size);

                        // Ищем минимальную цену
                        if ($i === 0) {
                            $min_price = $object->price;
                        } else {
                            $min_price = $object->price < $min_price ? $object->price : $min_price;
                        }

                        // Меняем цену
                        $price = $object->price;
                        $object->price = $this->currencyService->getPriceFromDB($price);
                        unset($price);

                        // Присваиваем объект временной переменой
                        $objects[] = $object;

                        // Увеличиваем индекс
                        $i++;
                    }
                    // Очищаем индекс
                    unset($i);

                    // Возвращаем минимальную цену с валютами
                    $min_price = $this->currencyService->getPriceFromDB($min_price);

                    // Оставляем только уникальные планировки (1+2, 2+2 и т.д.)
                    $layouts = array_unique(array_column(json_decode($row->product->objects), 'apartment_layout'), SORT_STRING);

                    // массив для сортировки
                    $layouts_sort_arr = [];
                    foreach ($layouts as $layout) {
                        if($layout === "" || $layout === " ") {
                            continue;
                        } else {
                            $layouts_sort_arr[] = explode("+", $layout);
                        }
                    }

                    // Сортировка
                    $sort = $this->sortService->quicksort($layouts_sort_arr);

                    // Вывод планировок (1+2, 2+2 и пр.)
                    foreach ($sort as $layout) {
                        $layouts_result .= !next($sort) ? implode("+", $layout) : implode("+", $layout) . ", ";
                    }
                    unset($layouts);


                    $row->product->objects = json_encode($objects, JSON_UNESCAPED_UNICODE);
                    unset($objects);

                    $row->product->min_price = !is_null($row->product->objects) ? $min_price : 0;
                    $row->product->layouts = $layouts_result;
                }

                $row->product->price_size = $this->currencyService->getPriceSizeFromDB((int)$row->product->price, (int)$row->product->size);
                $row->product->price = $this->currencyService->getPriceFromDB($row->product->price);
                return $row;
            });


        $count =  favorite::where('user_id',  $_COOKIE["user_id"])->count();
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
