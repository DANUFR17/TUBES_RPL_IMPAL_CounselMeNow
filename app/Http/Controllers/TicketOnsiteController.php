<?php

namespace App\Http\Controllers;

use App\Models\TicketOnsite;
use Illuminate\Support\Facades\Auth;
use App\Models\Connect;
use App\Models\Message;
use Illuminate\Http\Request;
 
class TicketOnsiteController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'User'){
            $ticketOnsites = TicketOnsite::join('connects', 'ticket_onsites.connect_id', '=', 'connects.id')
                ->where('connects.pasien_id', Auth::user()->id)
                ->get(['ticket_onsites.*']);
            $connects = Connect::where('pasien_id', Auth::user()->id)->get();
        }else if (Auth::user()->role == 'Dokter'){
            $ticketOnsites = TicketOnsite::join('connects', 'ticket_onsites.connect_id', '=', 'connects.id')
                ->where('connects.dokter_id', Auth::user()->id)
                ->get(['ticket_onsites.*']);
            $connects = Connect::where('dokter_id', Auth::user()->id)->get();
        }

        return view('tiket', [
            'user' => Auth::user(),
            'connects' => $connects,    
            'chats' => Message::all(),
            'tickets' => $ticketOnsites
        ]);
    }
    public function store(Request $request)
    {
        $tiketBaru  =TicketOnsite::create([
            'connect_id' => $request->connectID,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'keluhan' => $request->keluhan,
            'access' => false
        ]);

        Message::create([
            'connect_id' => $tiketBaru->connect_id,
            'role_pengirim' => Auth::user()->role,
            'pesan' => $tiketBaru->connect->user->name
                .' mengajukan konsultasi onsite pada tanggal '
                .$tiketBaru->tanggal.' untuk '
                .$tiketBaru->connect->dokter->name.'. Dengan nomor antrian '.$tiketBaru->id,
        ]);

        return redirect('/chat/'.$request->connectID);
    }

    public function update(TicketOnsite $ticketOnsite)
    {
        Message::create([
            'connect_id' => $ticketOnsite->connect_id,
            'role_pengirim' => Auth::user()->role,
            'pesan' => $ticketOnsite->connect->dokter->name
                .' telah menyetujui ajuan konsultasi onsite dari '
                .$ticketOnsite->connect->user->name,
        ]);

        $ticketOnsite->update(['access' => true]);

        return redirect('/tiket-onsite/list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketOnsite $ticketOnsite)
    {
        if (Auth::user()->role == 'Dokter'){
            if (!$ticketOnsite->access ){
                $pesan = Message::create([
                    'connect_id' => $ticketOnsite->connect_id,
                    'role_pengirim' => Auth::user()->role,
                    'pesan' => $ticketOnsite->connect->dokter->name
                        .' telah menolak ajuan konsultasi onsite dari '
                        .$ticketOnsite->connect->user->name
                        .', dengan nomor antrian '.$ticketOnsite->id.'.',
                ]);
            }
        }else if (Auth::user()->role == 'User'){
            if (!$ticketOnsite->access ){
                $pesan = Message::create([
                    'connect_id' => $ticketOnsite->connect_id,
                    'role_pengirim' => Auth::user()->role,
                    'pesan' => $ticketOnsite->connect->user->name
                        .' telah membatalkan ajuan konsultasi onsite untuk '
                        .$ticketOnsite->connect->dokter->name
                        .', dengan nomor antrian '.$ticketOnsite->id.'.',
                ]);
            }
        }

        $ticketOnsite->delete();

        return redirect('/tiket-onsite/list');
    }
}
