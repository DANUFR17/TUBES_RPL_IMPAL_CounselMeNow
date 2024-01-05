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
            @foreach ($dokters as $dokter)
                <div class="card p-0" style="width: 280px;">
                    <img src="{{ $dokter->foto_profil }}" class="card-img-top" alt="Foto Profil" style="width: 280px;">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">{{ $dokter->name }}</h5>
                        <p class="card-text">Dokter Spesialis {{ $dokter->spesialis }}</p>
                        @if ($user->role == 'User')
                            <form action="/konsultasi/{{ $dokter->id }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-dark card-link">Konsultasi</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection