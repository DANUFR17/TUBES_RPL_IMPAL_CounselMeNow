<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body{
            height: 100vh;
            width: 100vw;
            background-color: aqua;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: url('bg-root.jpg') center/cover no-repeat;
        }
        .tag-login{
            margin-bottom: 30px;
            color: white;
        }
        .form-login{
            width: 60%;
            max-width: 500px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            opacity: .8;
        }
        .login{
            display: flex;
            flex-direction: column;
            gap: 30px;  
        }
        .inputan{
            display: flex;
            flex-direction: column;
        }
        #email,
        #password{
            height: 35px;
        }
        button{
            border-style: none;
            height: 35px;
            background-color:rgb(106, 214, 214);
            color: white;
        }
        @media screen and (max-width: 600px) {
            .form-login{
                width: 90%;
                padding: 20px;
                background-color: white;
                border-radius: 10px;
            }
        }
    </style>
</head>
<body>
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="tag-login">Kosul-U</h2>
    <div class="form-login">
        <form action="/login" class="login" method="post">
            @csrf
            <h3 style="text-align: center">FORM LOG IN</h3>
            <div class="inputan">
                <label for="email" class="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan email" autofocus required value="{{ old('email') }}">
            </div>
            <div class="inputan">
                <label for="password" class="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                <div class="d-flex flex-row-reverse">
                    <label>Baru di Konsol-U? <a href="/register">Daftar</a></label>
                </div>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>