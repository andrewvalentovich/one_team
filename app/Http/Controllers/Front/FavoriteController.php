<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\favorite;
class FavoriteController extends Controller
{


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
        $get_product = $gets->paginate(9);
        $count =  favorite::where('user_id',  $_COOKIE["user_id"])->count();
        return view('project.favorite', compact('get_product', 'count'));
    }


    public function add_or_delete_in_favorite(Request $request){

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
