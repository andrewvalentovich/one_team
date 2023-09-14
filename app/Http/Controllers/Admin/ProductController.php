<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Peculiarities;
use App\Models\Product;
use App\Models\PhotoTable;
use Illuminate\Support\Facades\File;
use App\Models\CountryAndCity;
use App\Models\ProductDrawing;
class ProductController extends Controller
{
    public function all_product($id){
        $category = Peculiarities::where('id', $id)->first();

        if ($category  == null){
            return redirect()->back();
        }

        $get = ProductCategory::where('peculiarities_id', $id)->get()->pluck('product_id')->toarray();

        $product = Product::wherein('id', $get)->where('sale_or_rent','sale')->orderBy('id', 'desc')->paginate(10);

        return view('admin.Product.all',compact('category','product'));
    }

    public function rent_product($id){
        $category = Peculiarities::where('id', $id)->first();

        if ($category  == null){
            return redirect()->back();
        }

        $get = ProductCategory::where('peculiarities_id', $id)->get()->pluck('product_id')->toarray();

        $product = Product::wherein('id', $get)->where('sale_or_rent','rent')->orderBy('id', 'desc')->paginate(10);

        return view('admin.Product.all',compact('category','product'));
    }


    public function create_product_page($id){
        $country = CountryAndCity::orderby('name', 'asc')->where('parent_id', null)->get();
        $category = Peculiarities::where('id', $id)->first();
        $categorys = Peculiarities::all();
        $options =  Option::all();
        return view('admin.Product.create', compact('category','categorys','country','options'));
    }

    public function create_product(Request $request) {

        $objects = [];

        for($i = 0; $i < $request->objects_count; $i++) {
            $objects[$i]['id'] = $request['add_id'.$i];
            $objects[$i]['building'] = $request['add_building'.$i];
            $objects[$i]['price'] = $request['add_price'.$i];
            $objects[$i]['size'] = $request['add_size'.$i];
            $objects[$i]['apartment_layout'] = $request['add_apartment_layout'.$i];
            $objects[$i]['floor'] = $request['add_floor'.$i];

            // Добавление фотографий
            if (isset($request['add_apartment_layout_image'.$i])){
                $fileName = md5(Carbon::now() . '_' . $request['add_apartment_layout_image'.$i]->getClientOriginalName()) . '.' .$request['add_apartment_layout_image'.$i]->getClientOriginalExtension();
                $filePath = $request['add_apartment_layout_image'.$i]->move('uploads', $fileName);
                $objects[$i]['apartment_layout_image'] = $fileName;
            }
        }

        $create =  Product::create([
            'complex_or_not' => $request->complex_or_not,
            'city_id' => $request->city_id,
            'sale_or_rent' => $request->sale_or_rent,
            'country_id' => $request->country_id,
            'name' => $request->name,
            'price'=> $request->price,
            'size' => $request->size,
            'size_home' => $request->size_home,
            'address' => $request->address,
            'disposition' => $request->disposition,
            'disposition_en' => $request->disposition_en,
            'disposition_tr' => $request->disposition_tr,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'description_tr' => $request->description_tr,
            'parking' => $request->parking,
            'cryptocurrency' => $request->cryptocurrency,
            'owner' => $request->owner,
            'vnj' => $request->vnj,
            'grajandstvo' => $request->grajandstvo,
            'commissions' => $request->commissions,
            'long' => preg_replace( '/[^0-9.]+$/',  '',  $request->long) ,
            'lat' => preg_replace( '/[^0-9.]+$/',  '',  $request->lat),
            'objects' => json_encode($objects),
            'option_id' => $request->option_id,
        ]);

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
        if (isset($request->other_photo_two)){
            $other_photo = $request->other_photo_two;
            foreach ($other_photo as $item) {
                $fileName = $time++.'.'.$item->getClientOriginalExtension();
                $filePath = $item->move('uploads', $fileName);
                ProductDrawing::create([
                    'product_id' => $create->id,
                    'photo' => $fileName
                ]);
            }
        }

        if (isset($request->photo)){

            foreach ($request->photo as $photo){
                $file =  $photo;
                $fileName = $time++.'.'.$file->getClientOriginalExtension();
                $filePath = $file->move('uploads', $fileName);
                PhotoTable::create([
                        'parent_model'=>    '\App\Models\Product',
                        'parent_id' => $create->id,
                        'photo' => $fileName
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Product Created',
            'url' => route('all_product',$request->category_id)
        ],200);
    }



    public function single_page_product($id){

        $get = Product::where('id', $id)->first();

        if ($get == null){
            return redirect()->back();
        }
        $country = CountryAndCity::orderbY('name','asc')->where('parent_id', null)->get();
        $city = CountryAndCity::orderBy('name','asc')->where('parent_id',$get->country_id)->get();
        $product_category = $get->ProductCategory->where('type', 'Типы');
        $get_new_category = Peculiarities::whereNotIn('id', $get->ProductCategory->pluck('peculiarities_id'))->where('type','Особенности')->get();
        $categorys =  Peculiarities::get();
        $options =  Option::all();

        $get_old_category = ProductCategory::where('product_id', $get->id)->where('type', 'Особенности')->get();

        return view('admin.Product.single', compact('city','country','get','get_new_category', 'categorys', 'product_category','get_old_category','options'));
    }



    public function delete_osobenosti($id){
        ProductCategory::where('id', $id)->delete();
        return redirect()->back()->with('false', 'Особенность успешно удалена');
    }

    public function delete_product_photo($id){
        $get =  PhotoTable::where('id', $id)->first();

        $image_path = public_path("uploads/{$get->photo}");
//        dd($image_path );
        if (File::exists($image_path)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        $get->delete();

        return redirect()->back()->with('true', 'Фотография удалена');
    }


    public function update_product(Request $request){

        $objects = [];

        $product = Product::find($request->product_id);
        $json_objects = json_decode($product->objects);

        for($i = 0; $i < $request->objects_count; $i++) {
            $objects[$i]['id'] = $request['add_id'.$i];
            $objects[$i]['building'] = $request['add_building'.$i];
            $objects[$i]['price'] = $request['add_price'.$i];
            $objects[$i]['size'] = $request['add_size'.$i];
            $objects[$i]['apartment_layout'] = $request['add_apartment_layout'.$i];
            $objects[$i]['floor'] = $request['add_floor'.$i];

            // Добавление фотографий
            if (isset($request['add_apartment_layout_image'.$i])){
                $fileName = md5(Carbon::now() . '_' . $request['add_apartment_layout_image'.$i]->getClientOriginalName()) . '.' .$request['add_apartment_layout_image'.$i]->getClientOriginalExtension();
                $filePath = $request['add_apartment_layout_image'.$i]->move('uploads', $fileName);
                $objects[$i]['apartment_layout_image'] = $fileName;
            } else {
                $objects[$i]['apartment_layout_image'] = $json_objects[$i]->apartment_layout_image;
            }
        }

        $create =  $product->update([
            'complex_or_not' => $request->complex_or_not,
            'city_id' => $request->city_id,
            'sale_or_rent' => $request->sale_or_rent,
            'country_id' => $request->country_id,
            'name' => $request->name,
            'price'=> $request->price,
            'size' => $request->size,
            'size_home' => $request->size_home,
            'address' => $request->address,
            'disposition' => $request->disposition,
            'disposition_en' => $request->disposition_en,
            'disposition_tr' => $request->disposition_tr,
            'description' => $request->description,
            'description_en' => $request->description_en,
            'description_tr' => $request->description_tr,
            'parking' => $request->parking,
            'cryptocurrency' => $request->cryptocurrency,
            'owner' => $request->owner,
            'vnj' => $request->vnj,
            'grajandstvo' => $request->grajandstvo,
            'commissions' => $request->commissions,
            'long' => preg_replace( '/[^0-9.]+$/',  '',  $request->long) ,
            'lat' => preg_replace( '/[^0-9.]+$/',  '',  $request->lat) ,
            'objects' => json_encode($objects),
            'option_id' => $request->option_id
        ]);


        if (isset($request->osobenosti)){
            ProductCategory::where('product_id',$request->product_id)->delete();
                   $uniqueArray = array_unique($request->osobenosti);
                   foreach ($uniqueArray as $item) {
                $get_category =    Peculiarities::where('id', $item)->first();
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


        if (isset($request->photo)){
            $time = time();
            foreach ($request->photo as $photo){
                $file =  $photo;
                $fileName = $time++.'.'.$file->getClientOriginalExtension();
                $filePath = $file->move('uploads', $fileName);
                PhotoTable::create([
                    'parent_model'=>    '\App\Models\Product',
                    'parent_id' => $request->product_id,
                    'photo' => $fileName
                ]);
            }
        }
        if (isset($request->other_photo_two)){
            $time = time();
            $other_photo = $request->other_photo_two;
            foreach ($other_photo as $item) {
                $fileName = $time++.'.'.$item->getClientOriginalExtension();
                $filePath = $item->move('uploads', $fileName);
                ProductDrawing::create([
                    'product_id' => $request->product_id,
                    'photo' => $fileName
                ]);
            }
        }
        return response()->json([
            'status' => true,
            'message' => 'Product Created',
            'url' => route('single_page_product',$request->product_id)
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
        if ($get == null){
            return redirect()->back();
        }
            $image_path = public_path("uploads/{$get->photo}");
            if (File::exists($image_path)) {
                unlink($image_path);
        }
            $get->delete();
            return redirect()->back();
    }
}
