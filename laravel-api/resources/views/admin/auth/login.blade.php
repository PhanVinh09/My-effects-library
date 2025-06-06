<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: none;
        }

        .container {
            height: 100vh;
            background: linear-gradient(45deg, black, blue, violet, black);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login_form {
            min-width: 350px;
            max-width: 350px;
            margin-top: -110px;
            padding: 50px;
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            box-shadow: 0px 0px 1px 1px black;
            color: white;
            transition: 0.3s ease;
        }

        .login_form:hover {
            box-shadow: 0px 0px 50px 10px black;
        }

        .title {
            display: flex;
            justify-content: center;
            padding-bottom: 30px;
        }

        label {
            font-size: 20px;
            padding-top: 20px;
        }

        input:not([type='submit']) {
            border: 1px solid black;
            margin-top: 10px;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }

        input:not([type='submit']):focus {
            border: 2px solid gold;
            outline: none;
        }

        .link_register {
            display: flex;
            justify-content: right;
            color: white;
            text-decoration: none;
        }

        .link_register:hover {
            color: gold;
            text-decoration: underline;
        }

        input[type='submit'] {
            margin: 50px auto;
            padding: 12px 30px;
            font-size: 20px;
            color: white;
            background-color: black;
            border: 1px solid #fff;
            cursor: pointer;
            transition: 0.3s ease;
        }

        input[type='submit']:hover {
            transform: translateY(-10px);
            box-shadow: 0px 10px 10px 5px black;
        }
    </style>
</head>

<body>
    <div class="container">
        @if (session('message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session("message") }}',
                confirmButtonText: 'OK',
                timer: 2000,
                timerProgressBar: true
            });
        </script>
        @endif
        @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'OK'
            });
        </script>
        @endif
        <form class="login_form" id="loginForm" action="{{ route('auth.login') }}" method="POST">
            @csrf
            <h1 class="title">Đăng Nhập</h1>
            <label for="name">Tài Khoản</label>
            <input type="text" name="name" id="name" placeholder="Nhập tài khoản..." value="{{ old('name') }}" required maxlength="100">
            <label for="password">Mật Khẩu</label>
            <input type="password" name="password" id="password" placeholder="Mật khẩu..." required>
            <a class="link_register" href="{{ route('register') }}">Chưa Có Tài Khoản?</a>
            <input type="submit" value="Đăng nhập">
        </form>

    </div>
</body>

</html>