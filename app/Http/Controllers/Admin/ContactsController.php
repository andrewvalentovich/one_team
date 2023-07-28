<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contacts;

class ContactsController extends Controller
{
    public function contacts_page(){
        $get = Contacts::first();
        return view('admin.Pages.contacts', compact('get'));
    }


    public function contacts_page_create(Request $request){
        Contacts::updateOrCreate(['id'=> 1],[
           'content' =>  json_encode($request->invest_editor),
           'content_en' =>  json_encode($request->invest_editor_en),
           'content_tr' =>  json_encode($request->invest_editor_tr),
        ]);
        return redirect()->back();
    }

    public function contacts(){
        $get = Contacts::first();

        if (app()->getLocale() == 'en'){
            $get->content = $get->content_en;
        }
        if (app()->getLocale() == 'tr'){
            $get->content = $get->content_tr;
        }

        return view('project.pages.contacts', compact('get'));
    }
}
