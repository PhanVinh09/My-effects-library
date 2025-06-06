<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>register</title>
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

    .register_form {
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

    .register_form:hover {
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

    .link_login {
      display: flex;
      justify-content: left;
      color: white;
      text-decoration: none;
    }

    .link_login:hover {
      color: gold;
      text-decoration: underline;
      animation: back 1s ease infinite;
    }

    @keyframes back {

      0%,
      100% {
        transform: translateX(0px);
      }

      50% {
        transform: translateX(-10px);
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <form class="register_form" action="{{ route('auth.register') }}" method="POST">
      @csrf 
      <h1 class="title">Đăng Ký</h1>

      @if ($errors->any())
      <ul style="color: red; font-size: 14px; margin-bottom: 10px;">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
      @endif

      <label for="name">Tạo Tài Khoản</label>
      <input type="text" name="name" id="name" placeholder="Nhập tài khoản..." required maxlength="100">
      <label for="password">Tạo Mật Khẩu</label>
      <input type="password" name="password" id="password" placeholder="Mật khẩu..." required>
      <label for="rePassword">Nhập Lại Mật Khẩu</label>
      <input type="password" name="password_confirmation" id="rePassword" placeholder="Nhập lại mật khẩu..." required>
      <input type="submit" value="Đăng ký">
      <a class="link_login" href="{{ route('formLogin') }}">« Quay lại </a>
    </form>
  </div>

</body>

</html>