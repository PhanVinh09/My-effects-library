<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Manager</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        /* Nút hamburger ẩn mặc định */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background-color: #2c3e50;
            color: white;
            border: none;
            font-size: 28px;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #2c3e50, #34495e);
            color: white;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease-in-out;
            position: relative;
            z-index: 1000;
        }

        .sidebar h2 {
            font-size: 24px;
            color: #f1c40f;
            margin-bottom: 30px;
            text-align: center;
        }

        .nav-link {
            display: block;
            padding: 12px 16px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: 0.3s ease;
        }

        .nav-link:hover {
            background-color: #f1c40f;
            color: #2c3e50;
            transform: translateX(5px);
        }

        .content {
            flex: 1;
            padding: 50px;
        }

        /* MEDIA QUERIES */

        @media screen and (max-width: 768px) {
            body {
                flex-direction: column;
            }

            /* Hiện nút hamburger */
            .menu-toggle {
                display: block;
            }

            /* Sidebar mặc định ẩn, trượt ngoài màn hình trái */
            .sidebar {
                position: fixed;
                top: 0;
                left: -260px;
                /* ẩn sang trái */
                height: 100vh;
                width: 250px;
                padding-top: 60px;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                gap: 20px;
                overflow-y: auto;
                box-shadow: 4px 0 12px rgba(0, 0, 0, 0.2);
                transition: left 0.3s ease-in-out;
                z-index: 1050;
                background: linear-gradient(180deg, #2c3e50, #34495e);
            }

            /* Khi active (mở menu) */
            .sidebar.active {
                left: 0;
            }

            .sidebar h2 {
                display: none;
            }

            /* Thêm lớp overlay */
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 100vw;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1040;
            }

            .overlay.active {
                display: block;
            }

            .content {
                padding: 20px;
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: '{{ session("success") }}',
            confirmButtonText: 'OK',
            timer: 2000,
            timerProgressBar: true
        });
    </script>
    @endif
    @if (session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Không tìm thấy!',
            text: `{!! session("warning") !!}`,
            confirmButtonText: 'OK'
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
    @if (session('errorCode'))
    <script>
        Swal.fire({
            icon: 'error',
            title: '-_-',
            text: '{{ session("errorCode") }}',
            confirmButtonText: 'OK'
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

    <!-- Nút menu hamburger -->
    <button class="menu-toggle" aria-label="Toggle menu"><i class="bi bi-list"></i></button>

    <div class="sidebar">
        <h2>Admin</h2>
        <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="bi bi-house-gear"></i> Dashboard</a>
        <a href="{{route('users.index')}}" class="nav-link"><i class="bi bi-people"></i> Users</a>
        <a href="{{route('admins.index')}}" class="nav-link"><i class="bi bi-person-lock"></i> Managers</a>
        <a href="{{route('effects.index')}}" class="nav-link"><i class="bi bi-brush"></i> Effects</a>
        <a href="{{route('layouts.index')}}" class="nav-link"><i class="bi bi-layout-wtf"></i> Layouts</a>
        <a href="#" class="nav-link"><i class="bi bi-window"></i> UI</a>
        <a href="{{route('forms.index')}}" class="nav-link"><i class="bi bi-input-cursor"></i> Forms</a>
        <a href="{{route('admin.index')}}" class="nav-link"><i class="bi bi-door-open"></i> Back «</a>
    </div>

    <!-- Overlay mờ khi sidebar mở -->
    <div class="overlay"></div>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.overlay');

        // Mở / đóng sidebar
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        // Click overlay đóng sidebar
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>
</body>

</html>