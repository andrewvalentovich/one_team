<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as req;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRequestFromAdmin;
class RequestController extends Controller
{

    public function all_requests_new(){
        $get = req::where('status', 1)->orderby('created_at','desc')->paginate(10);
        return view('admin.requests.all', compact('get'));
    }


    public function single_page_request($id){
        $get = req::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }
        return view('admin.requests.single', compact('get'));
    }


    public function requests_old(){
        $get = req::where('status', 2)->orderby('created_at','desc')->paginate(10);
        return view('admin.requests.all', compact('get'));
    }


    public function update_status_one($id){
        $get = req::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }
        $get->update(['status' => 2]);
        return redirect()->back();
    }

    public function update_status_two($id){
        $get = req::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }
        $get->update(['status' => 1]);
        return redirect()->back();
    }






    public function send_request(Request $request){
        $string = $request->country;

        $cleanString = strip_tags($string);

        $position = strrpos($cleanString, ')');
        if ($position !== false) {
            $cleanString = substr($cleanString, 0, $position + 1);
        }

        $app_lang = app()->getLocale();
        if ($app_lang == 'ru'){
            $message = 'Мы получили ваше сообщение наш сотрудник скоро свяжется с вами';
        }elseif ($app_lang == 'en'){
                $message = 'We have received your message, our staff will contact you shortly';
        }elseif ($app_lang == 'tr'){
            $message = 'Mesajınızı aldık, personelimiz kısa süre içinde sizinle iletişime geçecektir.';
        }


        $data = array();
        if (isset($request->phone)){
            $data['phone'] = $request->phone;
        }
        if (isset($cleanString)){
            $data['country'] = $cleanString;
        }

        if (isset($request->fio)){
            $data['fio'] = $request->fio;
        }
        if (isset($request->product_id)){
            $data['product_id'] = $request->product_id;
        }





        $details = [
           'phone' => $request->phone,
           'product_id' => $request->product_id,
           'fio' => $request->name,
           'country' => $request->country,
           'messanger' => $request->messanger,
        ];

        Mail::to('one.team.dev.1@gmail.com')->send(new SendRequestFromAdmin($details));
//        try{
//        }catch (\Exception $e){
//            return response()->json([
//                'status' => false,
//                'message' => 'email error'
//            ],422);
//        }


        req::create([
           'phone' => $request->phone,
           'messenger' => $request->messanger,
            'country' => $cleanString,
            'fio' => $request->name,
            'product_id' => $request->product_id
        ]);


        return response()->json([
           'status' => true,
           'message' => $message
        ],200);
    }
}
