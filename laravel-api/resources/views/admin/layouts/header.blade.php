<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manager Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="{{ asset('css/admin_Home.css') }}">
</head>

<body>
  @if (session('message'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Thành công!',
      text: '{{ session("message") }}',
      confirmButtonText: 'OK',
      timer: 2000,
      timerProgressBar: true,
    });
  </script>
  @endif
  @if (session('error'))
  <script>
    Swal.fire({
      icon: 'error',
      title: 'Lỗi Rồi !',
      text: '{{ session("error") }}',
      confirmButtonText: 'OK'
    });
  </script>
  @endif
  <header>
    <nav>
      <div class="nav-logo"><a href="#">PTV</a></div>
      <!-- Nút menu hamburger -->
      <button class="menu-toggle" aria-label="Toggle menu"><i class="bi bi-list"></i></button>
      <ul class="nav-list">
        <li class="nav-item"><a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard</a></li>
      </ul>
      @auth
      <div class="nav-item" style="color: white;">
        Xin chào, {{ Auth::user()->name }}
      </div>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-login" style="background-color: crimson;">Logout</button>
      </form>
      @else
      <a class="btn-login" href="{{ route('formLogin') }}">Login</a>
      @endauth
    </nav>
  </header>
  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const navList = document.querySelector('.nav-list');

    menuToggle.addEventListener('click', () => {
      navList.classList.toggle('active');
    });

    // Nếu muốn đóng menu khi click vào 1 mục (tuỳ chọn)
    navList.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        navList.classList.remove('active');
      });
    });
  </script>