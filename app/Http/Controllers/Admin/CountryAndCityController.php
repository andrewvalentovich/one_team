<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use Illuminate\Support\Facades\File;
use App\Models\Metric;
class CountryAndCityController extends Controller
{


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


    public function create_country(Request $request){

        if (isset($request->photo)){
            $file = $request->photo;
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();
            $filePath = $file->move('uploads', $fileName);
        }


        CountryAndCity::create([
            'metric_id' => $request->metric_id,
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'name_en' => $request->name_en,
            'name_tr' => $request->name_tr,
            'name_de' => $request->name_de,
            'photo' => $fileName,
            'div' => $request->citizenship,
            'div_en' => $request->citizenship_en,
            'div_tr' => $request->citizenship_tr,
            'div_de' => $request->citizenship_de,
            'lat' => preg_replace( '/[^0-9.]+$/',  '',  $request->lat) ,
            'long' =>  preg_replace( '/[^0-9.]+$/',  '',  $request->long)
        ]);
        return redirect()->back()->with('true', 'Вы успешно завершили добавления');
    }


    public function single_country($id){
        $metric = Metric::orderBy('name', 'asc')->get();
        $get = CountryAndCity::where('id', $id)->first();

        if ($get == null){
            return redirect()->back();
        }
        return view('admin.Country.single', compact('get','metric'));
    }

    public function update_country(Request $request){
        $get = CountryAndCity::where('id', $request->country_id)->first();
        if ($get == null){
            return redirect()->back();
        }

        if (isset($request->photo)){
            $file = $request->photo;
            $fileName = time().'.'.$request->photo->getClientOriginalExtension();
            $filePath = $file->move('uploads', $fileName);
        }
        $get->update([
            'metric_id' => $request->metric_id,
            'name' => $request->name,
            'photo' => $fileName??$get->photo,
            'name_en' => $request->name_en,
            'name_tr' => $request->name_tr,
            'name_de' => $request->name_de,
            'div' => $request->citizenship,
            'div_en' => $request->citizenship_en,
            'div_tr' => $request->citizenship_tr,
            'div_de' => $request->citizenship_de,
            'lat' => preg_replace( '/[^0-9.]+$/',  '',  $request->lat) ,
            'long' =>  preg_replace( '/[^0-9.]+$/',  '',  $request->long)
        ]);
        return redirect()->back()->with('true','Вы успешно завершили редактирования');

    }

    public function delete_country($id){
        $get = CountryAndCity::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }
        $image_path = public_path("uploads/{$get->photo}");
//        dd($image_path );
        if (File::exists($image_path)) {
            //File::delete($image_path);
            unlink($image_path);
        }
        $get->delete();
            if ($get->parent_id == null){
                return redirect()->route('all_country')->with('true', "Вы успешно удалили страну из списка $get->name");
            }else{
                return redirect()->route('single_country',$get->parent_id)->with('true', "Вы успешно удалили город из списка $get->name");
            }



            }
}
