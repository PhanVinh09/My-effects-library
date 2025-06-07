<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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

        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #2c3e50, #34495e);
            color: white;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 25px;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
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

        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
                padding: 20px 10px;
            }

            .sidebar h2 {
                display: none;
            }

            .nav-link {
                padding: 10px;
                font-size: 14px;
            }

            .content {
                padding: 20px;
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
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="bi bi-house-gear"></i> Dashboard</a>
        <a href="" class="nav-link"><i class="bi bi-people"></i> Users</a>
        <a href="" class="nav-link"><i class="bi bi-person-lock"></i> Managers</a>
        <a href="{{route('effects.index')}}" class="nav-link"><i class="bi bi-brush"></i> Effects</a>
        <a href="{{route('layouts.index')}}" class="nav-link"><i class="bi bi-layout-wtf"></i> Layouts</a>
        <a href="#" class="nav-link"><i class="bi bi-window"></i> UI</a>
        <a href="#" class="nav-link"><i class="bi bi-input-cursor"></i> Forms</a>
        <a href="{{route('admin.index')}}" class="nav-link"><i class="bi bi-door-open"></i> Back «</a>
    </div>
</body>

</html>