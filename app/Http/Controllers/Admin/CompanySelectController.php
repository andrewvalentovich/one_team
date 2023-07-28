<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanySelect;
class CompanySelectController extends Controller
{


    public function company_page($id){
        $get =  CompanySelect::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }


        if (app()->getLocale() == 'en'){
            $get->content = $get->content_en;
        }

        if (app()->getLocale() == 'tr'){
            $get->content = $get->content_tr;
        }


        return view('project.pages.company_page', compact('get'));
     }

    public function all_company_select(){
        $get =  CompanySelect::orderby('status', 'asc')->orderby('updated_at', 'desc')->get();
        return view('admin.Pages.company.all', compact('get'));
    }

    public function all_company_select_page(){
        return view('admin.Pages.company.create');
    }

    
    public function all_company_select_page_create(Request $request){
        CompanySelect::create([
            'status' => $request->status,
            'name' => $request->name,
            'content' => json_encode($request->contents),
            'content_en' => json_encode($request->contents_en),
            'content_tr' => json_encode($request->contents_tr),
        ]);

        return redirect()-> back();
    }


    public function company_select_single($id){
        $get = CompanySelect::where('id', $id)->first();

        if ($get == null){
            return redirect()->back();
        }

        return view('admin.Pages.company.single', compact('get'));
    }


    public function update_select_page(Request $request){
        CompanySelect::where('id', $request->select_id)->update([
            'status' => $request->status,
            'name' => $request->name,
            'content' => json_encode($request->contents),
            'content_en' => json_encode($request->contents_en),
            'content_tr' => json_encode($request->contents_tr),
        ]);
        return redirect()->back();
    }

    public function delete_select_page($id){
        CompanySelect::where('id', $id)->delete();
        return redirect()->route('all_company_select');
    }

}
