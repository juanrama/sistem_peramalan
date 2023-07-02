<?php

namespace App\Http\Controllers;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view ('login.index');
    }

    public function authenticate(Request $request){
        $credentials = $request -> validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return back() -> with('loginError', 'Login gagal'); 
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function login_face(Request $request){
        $client = new Client();
        $api_url = 'http://127.0.0.1:5000/name_final';
        $data = $client->get($api_url);
        $data_body = $data->getBody();
        $dataArray = json_decode($data_body, true);
        $nameFinal = $dataArray['name_final'];
        
        $user = User::where('username', $nameFinal)->first();
        
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/home')->with('success_wajah', 'Autentikasi Wajah Berhasil');
        }
        
        return redirect('/login')->with('loginErrorWajah', 'Login gagal');
    }
}
