<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanySelect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CompanySelectController extends Controller
{
    public function about($slug)
    {
        $get =  CompanySelect::where('slug', $slug)->first();
        if ($get == null){
            return redirect()->back();
        }

        $title = "Oneteam / О проекте";
        if (app()->getLocale() == 'en'){
            $title = "Oneteam / About project";
            $get->content = $get->content_en;
        }

        if (app()->getLocale() == 'tr'){
            $title = "Oneteam / Proje hakkında";
            $get->content = $get->content_tr;
        }

        if (app()->getLocale() == 'de'){
            $title = "Oneteam / Über das projekt";
            $get->content = $get->content_tr;
        }


        return view('project.pages.company_page', compact('get', 'title'));
     }

    public function all_company_select(){
        $get =  CompanySelect::orderby('status', 'asc')->orderby('updated_at', 'desc')->get();
        return view('admin.Pages.company.all', compact('get'));
    }

    public function all_company_select_page(){
        return view('admin.Pages.company.create');
    }

    public function all_company_select_page_create(Request $request){
        $slug = null;

        if (!isset($request->slug)) {
            $slug = Str::slug($request->title);
        } else {
            $slug = $request->slug;
        }

        CompanySelect::create([
            'status' => $request->status,
            'name' => $request->name,
            'slug' => $slug,
            'content' => json_encode($request->contents),
            'content_en' => json_encode($request->contents_en),
            'content_tr' => json_encode($request->contents_tr),
        ]);

        return redirect()->route('all_company_select');
    }


    public function company_select_single($id){
        $get = CompanySelect::where('id', $id)->first();

        if ($get == null){
            return redirect()->back();
        }

        return view('admin.Pages.company.single', compact('get'));
    }


    public function update_select_page(Request $request)
    {
        $slug = null;

        if (!isset($request->slug)) {
            $slug = Str::slug($request->title);
        } else {
            $slug = $request->slug;
        }

        CompanySelect::where('id', $request->select_id)->update([
            'status' => $request->status,
            'name' => $request->name,
            'slug' => $slug,
            'content' => json_encode($request->contents),
            'content_en' => json_encode($request->contents_en),
            'content_tr' => json_encode($request->contents_tr),
        ]);
        return redirect()->route('all_company_select');
    }

    public function delete_select_page($id){
        CompanySelect::where('id', $id)->delete();
        return redirect()->route('all_company_select');
    }

}
