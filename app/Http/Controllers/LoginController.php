<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Connect;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('Selamat datang kembali'.Auth::user()->id);
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    public function dashboard(){
        if (Auth::user()->role == 'User'){
            $connects = Connect::where('pasien_id', Auth::user()->id)->get();
        }else if (Auth::user()->role == 'Dokter'){
            $connects = Connect::where('dokter_id', Auth::user()->id)->get();
        }

        return view('welcome', [
            'user' => Auth::user(),
            'connects' => $connects,
            'dokters' => User::where('role', 'Dokter')->get(),
            'chats' => Message::all()
        ]);
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|unique:users|min:11',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        
        User::create($validatedData);
        Auth::attempt($validatedData);
        return redirect()->intended('dashboard')->with('Selamat datang di Konsul-U, '.Auth::user()->id);
    }
}
