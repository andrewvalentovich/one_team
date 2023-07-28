<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rasrochka;

class RasrochkaController extends Controller
{
    public function rasrochka_page(){
        $get = Rasrochka::first();
        return view('admin.Pages.rasrochka',compact('get'));
    }


    public function rasrochka_page_create(Request $request){
        Rasrochka::updateOrCreate(['id'=> 1],[
            'content' =>  json_encode($request->invest_editor),
            'content_en' =>  json_encode($request->invest_editor_en),
            'content_tr' =>  json_encode($request->invest_editor_tr),
        ]);


        return redirect()->back();
    }

    public function installment_plan(){
        $get = Rasrochka::first();
        if (app()->getLocale() == 'en'){
            $get->content = $get->content_en;
        }
        if (app()->getLocale() == 'tr'){
            $get->content = $get->content_tr;
        }


        return view('project.pages.rasrochka',compact('get'));
    }
}
