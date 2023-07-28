<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kurs;
class KursController extends Controller
{
    public function value_page(){
        $get = Kurs::first();
        return view('admin.Kurs.index', compact('get'));
    }

    public function update_value(Request $request){
        Kurs::where('id', $request->id)->update([
            'rub' => $request->rub,
            'lira' => $request->lira
        ]);

        return redirect()->back()->with('true', 'Редактирование успешно завершено');
    }
}
