<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peculiarities as Peculiaritie;

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

    public function create_peculiarities(Request $request){
        Peculiaritie::create([
           'name' => $request->name,
           'type' => $request->type
        ]);
        return redirect()->back()->with('true', 'Добавления успешно завершено');
    }

    public function single_peculiarities($id){
        $get = Peculiaritie::where('id', $id)->first();


        if ($get == null){
            return redirect()->back();
        }

        $string = $get->type;

        return view('admin.Peculiarities.single', compact('get','string'));
    }

    public function update_peculiarities(Request $request){
        $get =  Peculiaritie::where('id', $request->id)->first();
        if ($get == null){
            return redirect()->back();
        }
        $get->update([
           'name' => $request->name
        ]);
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
}
