<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as req;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRequestFromAdmin;

class RequestController extends Controller
{
    public function index_unchecked()
    {
        $requests = req::where('status', 1)->orderby('created_at','desc')->paginate(10);
        return view('panel.requests.all', compact('requests'));
    }

    public function show($id)
    {
        $request = req::where('id', $id)->first();
        if ($request == null){
            return redirect()->back();
        }
        return view('panel.requests.single', compact('request'));
    }

    public function index_checked()
    {
        $requests = req::where('status', 2)->orderby('created_at','desc')->paginate(10);
        return view('panel.requests.all', compact('requests'));
    }

    public function set_status_checked($id)
    {
        $get = req::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }
        $get->update(['status' => 2]);
        return redirect()->back();
    }

    public function set_status_unchecked($id)
    {
        $get = req::where('id', $id)->first();
        if ($get == null){
            return redirect()->back();
        }
        $get->update(['status' => 1]);
        return redirect()->back();
    }

    public function send_request(Request $request)
    {
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
