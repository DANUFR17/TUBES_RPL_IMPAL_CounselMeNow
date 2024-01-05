<?php

namespace App\Http\Controllers;

use App\Models\Connect;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ConnectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $connect = Connect::where('pasien_id', Auth::user()->id)->where('dokter_id',$user->id)->first();
        if ($connect == null){
            $connect = Connect::create([
                'pasien_id'=> Auth::user()->id,
                'dokter_id'=> $user->id,
            ]);
        }
    
        Message::create([
            'connect_id' => $connect->id,
            'role_pengirim' => Auth::user()->role,
            'pesan' => 'Halo dok, '.Auth::user()->name.' kini terhubung dengan '.$user->name,
        ]);

        return redirect('/chat/'.$connect->id);
    }

    public function showChat(Connect $connect)
    {
        if (Auth::user()->role == 'User'){
            $connects = Connect::where('pasien_id', Auth::user()->id)->get();
        }else if (Auth::user()->role == 'Dokter'){
            $connects = Connect::where('dokter_id', Auth::user()->id)->get();
        }

        return view('chat', [
            'chatRoom' => Message::where('connect_id', $connect->id)->get(),
            'chats' => Message::all(),
            'connects' => $connects,
            'conn' => $connect,
            'user' => Auth::user()
        ]);
    }
}
