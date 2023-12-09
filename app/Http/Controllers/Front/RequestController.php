<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\SendRequestRequest;
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

    public function send_request(SendRequestRequest $request){
        $data = $request->validated();

        // Обработка страны
        $data['country'] = strip_tags($data['country']);
        $position = strrpos($data['country'], ')');
        if ($position !== false) {
            $data['country'] = substr($data['country'], 0, $position + 1);
        }

//        Mail::to('one.team.dev.1@gmail.com')->send(new SendRequestFromAdmin($details));
//        try{
//        }catch (\Exception $e){
//            return response()->json([
//                'status' => false,
//                'message' => 'email error'
//            ],422);
//        }

        req::create($data);

        $message = __('Мы получили ваше сообщение наш сотрудник скоро свяжется с вами');

        return response()->json([
           'status' => true,
           'message' => $message
        ],200);
    }
}
