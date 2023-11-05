<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryAndCity\StoreRequest;
use App\Http\Requests\Admin\CountryAndCity\UpdateRequest;
use App\Services\ImageService;
use Illuminate\Http\Request;
use App\Models\CountryAndCity;
use Illuminate\Support\Facades\File;
use App\Models\Metric;
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

        if (isset($data['photo'])){
            $data['photo'] = $this->imageService->saveWebp($data['photo']);
        }

        if (isset($data['flag'])){
            $data['flag'] = $this->imageService->saveWebp($data['flag']);
        }

        CountryAndCity::create($data);
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

    public function update_country(UpdateRequest $request){
        $data = $request->validated();

        $get = CountryAndCity::find($data['id']);
        if ($get == null){
            return redirect()->back();
        }
        unset($data['id']);

        $photo = null;
        $flag = null;

        if (isset($data['photo'])){
            $data['photo'] = $this->imageService->saveWebp($data['photo']);
        }

        if (isset($data['flag'])){
            $data['flag'] = $this->imageService->saveWebp($data['flag']);
        }

        $get->update($data);
        return redirect()->back()->with('true','Вы успешно завершили редактирование');

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
