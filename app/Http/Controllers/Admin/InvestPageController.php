<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestPage;
class InvestPageController extends Controller
{
    public function invest_page(){
        $get = InvestPage::where('id', 1)->first();
        return view('admin.Pages.invest', compact('get'));
    }

    public function invest_page_create(Request $request){
//        dd($request);
        InvestPage::updateOrCreate(['id' => 1],[
            'content' =>  json_encode($request->invest_editor),
            'content_en' =>  json_encode($request->invest_editor_en),
            'content_tr' =>  json_encode($request->invest_editor_tr),
        ]);
        return redirect()->back();
    }


    public function investments(){
        $get = InvestPage::first();

        if (app()->getLocale() == 'en'){
            $get->content = $get->content_en;
        }
        if (app()->getLocale() == 'tr'){
            $get->content = $get->content_tr;
        }

        return view('project.pages.invest', compact('get'));

    }
}
