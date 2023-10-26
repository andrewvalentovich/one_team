<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PolicyAndPrivice as pol;

class PolicyAndPrivice extends Controller
{

    public function police(){
        $get = pol::first();
    return view('admin.Pages.police', compact('get'));
    }

    public function police_create(Request $request){
        pol::updateOrCreate(['id'=>1],[
           'police_content' => json_encode($request->invest_editor),
           'police_content_en' => json_encode($request->invest_editor_en),
           'police_content_tr' => json_encode($request->invest_editor_tr),
        ]);
        return redirect()->back();
    }

    public function user_agreement_when_using_the_site(){
        $get = pol::first();
        if (app()->getLocale() == 'en'){
            $get->police_content = $get->police_content_en;
        }
        if (app()->getLocale() == 'tr'){
            $get->police_content = $get->police_content_tr;
        }

        $title = "Пользовательское соглашение при использовании сайта";
        return view('project.pages.police', compact('get', 'title'));
    }



    public function privice(){
        $get = pol::first();
        return view('admin.Pages.privice',compact('get'));
    }

    public function privice_create(Request $request){
        pol::updateOrCreate(['id'=>1],[
            'privice_content' => json_encode($request->invest_editor),
            'privice_content_en' => json_encode($request->invest_editor_en),
            'privice_content_tr' => json_encode($request->invest_editor_tr)
        ]);
        return redirect()->back();
    }

    public function personal_data_processing_policy(){
        $get = pol::first();
        if (app()->getLocale() == 'en'){
            $get->privice_content = $get->privice_content_en;
        }
        if (app()->getLocale() == 'tr'){
            $get->privice_content = $get->privice_content_tr;
        }
        $title = "Политика обработки персональных данных";
        return view('project.pages.privice', compact('get', 'title'));
    }
}
