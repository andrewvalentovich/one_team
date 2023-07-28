<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VngAndGrj;

class VngAndGrjController extends Controller
{
    public function vng_page(){
        $get = VngAndGrj::first();
        return view('admin.Pages.vng', compact('get'));
    }

    public function vng_page_create(Request $request){

        VngAndGrj::updateOrCreate(['id' => 1],[
            'content' =>  json_encode($request->invest_editor),
            'content_en' =>  json_encode($request->invest_editor_en),
            'content_tr' =>  json_encode($request->invest_editor_tr),
        ]);
        return redirect()->back();
    }

    public function residence_and_citizenship(){
        $get = VngAndGrj::first();
        if (app()->getLocale() == 'en'){
            $get->content = $get->content_en;
        }
        if (app()->getLocale() == 'tr'){
            $get->content = $get->content_tr;
        }

        return view('project.pages.residence_and_citizenship', compact('get'));
    }



}
