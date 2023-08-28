<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\CountryAndCity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminUpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PanelLoginController extends Controller
{

    public function login()
    {
        return view('panel.login');
    }

    public function logined(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('panel.index')
                ->withSuccess('Signed in');
        }

        return redirect('panel.login')->withSuccess('Login details are not valid');
    }

    public function index()
    {
        return view('panel.index');
    }

    public function logoutAdmin()
    {
        auth()->logout();
        return redirect()->route('panel.login');
    }

    public function settings()
    {
        return view('panel.settings');
    }

    public function updatePassword(AdminUpdatePasswordRequest $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $hash_check =  Hash::check($request->oldpassword, $user->password);


        if($hash_check == true){
            $updated_password =  User::where('id', auth()->user()->id)->update([
                'password' =>  Hash::make($request->newpassword)
            ]);
            return redirect()->back()->with('succses','succses');
        }else{
            return redirect()->back()->with('nopassword','nopassword');
        }


    }
}
