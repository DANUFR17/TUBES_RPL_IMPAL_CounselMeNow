@extends('template.sidebar')
@section('css')
    <style type="text/css">
        body{
            background-color: #f4f7f6;
            margin-top:20px;
        }
        .card {
            background: #fff;
            transition: .5s;
            border: 0;
            margin-bottom: 30px;
            border-radius: .55rem;
            position: relative;
            width: 100%;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
        }
        .chat-app .people-list {
            width: 280px;
            position: absolute;
            left: 0;
            top: 0;
            padding: 20px;
            z-index: 7
        }

        .chat-app .chat {
            margin-left: 280px;
            border-left: 1px solid #eaeaea
        }

        .people-list {
            -moz-transition: .5s;
            -o-transition: .5s;
            -webkit-transition: .5s;
            transition: .5s
        }

        .people-list .chat-list li {
            padding: 10px 15px;
            list-style: none;
            border-radius: 3px
        }

        .people-list .chat-list li:hover {
            background: #efefef;
            cursor: pointer
        }

        .people-list .chat-list li.active {
            background: #efefef
        }

        .people-list .chat-list li .name {
            font-size: 15px
        }

        .people-list .chat-list img {
            width: 45px;
            border-radius: 50%
        }

        .people-list img {
            float: left;
            border-radius: 50%
        }

        .people-list .about {
            float: left;
            padding-left: 8px
        }

        .people-list .status {
            color: #999;
            font-size: 13px
        }

        .chat .chat-header {
            padding: 15px 20px;
            border-bottom: 2px solid #f4f7f6
        }

        .chat .chat-header img {
            float: left;
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-header .chat-about {
            float: left;
            padding-left: 10px
        }

        .chat .chat-history {
            padding: 20px;
            border-bottom: 2px solid #fff
        }

        .chat .chat-history ul {
            padding: 0
        }

        .chat .chat-history ul li {
            list-style: none;
            margin-bottom: 30px
        }

        .chat .chat-history ul li:last-child {
            margin-bottom: 0px
        }

        .chat .chat-history .message-data {
            margin-bottom: 15px
        }

        .chat .chat-history .message-data img {
            border-radius: 40px;
            width: 40px
        }

        .chat .chat-history .message-data-time {
            color: #434651;
            padding-left: 6px
        }

        .chat .chat-history .message {
            color: #444;
            padding: 18px 20px;
            line-height: 26px;
            font-size: 16px;
            border-radius: 7px;
            display: inline-block;
            position: relative
        }

        .chat .chat-history .message:after {
            bottom: 100%;
            left: 7%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #fff;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .my-message {
            background: #efefef
        }

        .chat .chat-history .my-message:after {
            bottom: 100%;
            left: 30px;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
            border-bottom-color: #efefef;
            border-width: 10px;
            margin-left: -10px
        }

        .chat .chat-history .other-message {
            background: #e8f1f3;
            text-align: right
        }

        .chat .chat-history .other-message:after {
            border-bottom-color: #e8f1f3;
            left: 93%
        }

        .chat .chat-message {
            padding: 20px
        }

        .online,
        .offline,
        .me {
            margin-right: 2px;
            font-size: 8px;
            vertical-align: middle
        }

        .online {
            color: #86c541
        }

        .offline {
            color: #e47297
        }

        .me {
            color: #1d8ecd
        }

        .float-right {
            float: right
        }

        .clearfix:after {
            visibility: hidden;
            display: block;
            font-size: 0;
            content: " ";
            clear: both;
            height: 0
        }

        #main-container{
            width: 100%;
            height: calc(100vh - 56px);
            display: flex;
            align-items: center;
        }

        @media only screen and (max-width: 767px) {
            .chat-app .people-list {
                height: 465px;
                width: 100%;
                overflow-x: auto;
                background: #fff;
                left: -400px;
                display: none
            }
            .chat-app .people-list.open {
                left: 0
            }
            .chat-app .chat {
                margin: 0
            }
        } 
        .chat-app .chat-list {
            height: calc(60vh + 58px);
            overflow-x: auto
        }
        .chat-app .chat-history {
            height: 60vh;
            overflow-x: auto;
            display: flex;
            flex-direction: column-reverse;
        }

        @media screen and (min-height:800px){
            .chat-app .chat-list {
                height: calc(70vh + 58px);
                overflow-x: auto
            }
            .chat-app .chat-history {
                height: 70vh;
                overflow-x: auto
            }
        }
    </style>
@endsection
@section('container')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app m-0">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <input type="text" id="search-keyword" class="form-control" placeholder="Search..." onkeyup="searchName()">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            @foreach ($connects as $connect)
                            <a href="/chat/{{ $connect->id }}" id="list-connect">
                                <li class="clearfix">
                                    <img src="{{ $user->role == 'User' ? $connect->dokter->foto_profil : $connect->user->foto_profil }}" alt="avatar">
                                    <div class="about" style="width:65%">
                                        <div class="name name-connect" id="webkit-line" style="-webkit-line-clamp:1">{{ $user->role == 'User' ? $connect->dokter->name : $connect->user->name }}</div>
                                        <div class="status" id="webkit-line" style="-webkit-line-clamp:1">{{ $chats->where('connect_id', $connect->id)->last()->pesan }}</div>
                                    </div>
                                </li>
                            </a>
                            @endforeach
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6 d-flex align-items-center w-100">
                                    <div>
                                        <img src="{{$conn->dokter->foto_profil}}" alt="avatar">
                                    </div>
                                    <div class="chat-about">
                                        <h6 class="m-0">{{ $user->role == 'User' ? $conn->dokter->name : $conn->user->name }}</h6>
                                    </div>
                                    <button type="button" class="btn btn-dark ms-auto" data-bs-toggle="modal" data-bs-target="#staticBackdrop" {{ $user->role == 'Dokter' ? 'hidden' : ''}}>
                                        Konsul Onsite
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history">
                            <ul class="m-b-0">
                                @foreach ($chatRoom as $chat)
                                    <li class="clearfix">
                                        @php
                                            $tanggal = explode(" ", $chat->updated_at);    
                                            $hari = date('l', strtotime($tanggal[0]));
                                        @endphp
                                        <div class="message-data" style="text-align: {{ $chat->role_pengirim == $user->role ? 'right' : 'left'}}">
                                            <span class="message-data-time">{{ $tanggal[0] }}, {{ $hari }}</span>
                                        </div>
                                        <div class="message {{ $chat->role_pengirim == $user->role ? 'other-message float-right' : 'my-message'}}"> {{ $chat->pesan }} </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <form action='/chat/{{ $conn->id }}' method="POST" class="input-group mb-0">
                                @csrf
                                <div class="input-group-prepend">
                                    <button type="submit" class="input-group-text" style="height: 100%"><i class="fa fa-send"></i></button>
                                </div>
                                <input type="text" class="form-control" name="pesan" placeholder="Enter text here...">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade w-90" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" style="
            width: 90%;
            height: 100%;
            margin: 0 auto;
            display: flex;
            align-items: center;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Tambah Konsultasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/tiket-onsite" method="POST">
                        @csrf
                        <input type="number" class="form-control" name="connectID" value="{{ $conn->id }}" hidden>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Konsultasi</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="jam" class="form-label">Tanggal Konsultasi</label>
                            <input type="time" class="form-control" id="jam" name="jam" required>
                        </div>
                        <div class="mb-3">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <textarea class="form-control" id="keluhan" name="keluhan" rows="5" required></textarea>
                        </div>
                        <div class="mb-3" hidden>
                            <input type="checkbox" id="access" name="access" checked>
                        </div>
                        <button type="submit" class="btn btn-outline-dark">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const searchName = () => {
            const keyword = document.querySelector('#search-keyword').value.trim();
            const list = document.querySelectorAll('#list-connect');

            for (const item of list){
                const name = item.querySelector('.name-connect').innerText.toLowerCase();
                console.log(name.includes(keyword.toLowerCase()), keyword);
                if(name.includes(keyword.toLowerCase())){
                    item.hidden = false;
                }else{
                    item.hidden = true;
                }
            }
        };
    </script>
@endsection