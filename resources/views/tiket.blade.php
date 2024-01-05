@extends('template.sidebar')
@section('css')
    <style>
        #main-container{
            width: 90%; 
            margin-top:30px;
            margin-bottom:10px
        }
        #card-wadah{
            justify-content: space-between;
        }
        .webkit-element{
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        @media screen and (max-width:600px){
            #card-wadah{
                justify-content: center;
            }
        }
    </style>
@endsection

@section('container')
    <div class="container mt-4 mb-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3" id="card-wadah" style="gap: 20px">
            @foreach ($ticket as $ticket)
                <div class="card p-0" style="width: 280px;">
                    <div class="card-body">
                        <h5 class="card-title">Nomor Antrian {{ $ticket->id }}</h5>
                        <p class="card-text webkit-element" style="-webkit-line-clamp:3;">{{ $ticket->keluhan }}</p>
                    </div>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th scope="row">Dokter</th>
                                <td>: {{ $ticket->connect->dokter->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Pasien</th>
                                <td>: {{ $ticket->connect->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal</th>
                                <td>: {{ $ticket->tanggal }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jam</th>
                                <td>: {{ $ticket->jam }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>: {{ $ticket->access ? "Acc" : "Menunggu Acc" }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-body d-flex gap-4">
                        @if ($user->role == 'Dokter')
                            @if (!($ticket->access))
                                <form action="/tiket-onsite/{{ $ticket->id }}" method="POST" enctype="multipart/form-data">
                                    @csrf   
                                    @method('PUT')
                                    <button type="submit" class="btn btn-outline-dark">Terima</button>
                                </form> 
                            @endif
                        @endif

                        <form action="/tiket-onsite/{{ $ticket->id }}" method="POST" onsubmit="return confirm('Yakin hapus/cancel?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">{{ $user->role == 'Dokter' && !$ticket->access ? 'Tolak' : ($user->role == 'User' && !$ticket->access ? 'Cancel' : 'Delete') }}</button>
                        </form>      
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection