<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konsul-U</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    @yield('css')
    <style>
        #webkit-line{
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .scrollarea {
        overflow-y: auto;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Konsul-U</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="offcanvas" href="#offcanvasScrolling" role="button" aria-controls="offcanvasScrolling">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/list-dokter">List Dokter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tiket-onsite/list">Konsultasi Onsite</a>
                    </li>
                </ul>
                <form class="d-flex bg-dark" action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="p-0 bg-dark border border-0">
                        <i class="bi bi-box-arrow-right"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="list-group list-group-flush border-bottom scrollarea">
            @foreach ($connects as $connect)
                <a href="/chat/{{ $connect->id }}" class="list-group-item list-group-item-action py-3 lh-sm">
                    <div class="d-flex w-100 align-items-center justify-content-between">
                        <strong class="mb-1">{{ $user->role == 'User' ? $connect->dokter->name : $connect->user->name }}</strong>
                        <small class="text-body-secondary">{{ $chats->where('connect_id', $connect->id)->last()->created_at }}</small>
                    </div>
                    <div class="col-10 mb-1 small" id="webkit-line" style="-webkit-line-clamp:3;">{{ $chats->where('connect_id', $connect->id)->last()->pesan }}</div>
                </a>
            @endforeach
        </div>
    </div>

    <div id="main-container" style="margin: 0 auto;">
        @yield('container')
    </div>

    @yield('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
