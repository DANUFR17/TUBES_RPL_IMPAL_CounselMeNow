<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Connect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request, Connect $connect)
    {
        $messageBaru = Message::create([
            'connect_id' => $connect->id,
            'role_pengirim' => Auth::user()->role,
            'pesan' => $request->pesan,
        ]);
        
        return redirect('/chat/'.$connect->id);
    }
}
