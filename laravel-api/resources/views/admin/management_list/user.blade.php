@include('admin.layouts.sidebar')
<link rel="stylesheet" href="{{ asset('css/admin_manager.css') }}">

<div class="content">
    <div class="table-container">
        <div class="table-header">
            <a class="btn-add" href="#">Thêm Người Dùng</a>
            <div class="search-bar">
                <form action="" method="GET">
                    <input type="text" name="search" value="" placeholder="Tìm kiếm Effect Name..." />
                    <button type="submit"><i class="bi bi-search"></i> Tìm</button>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Membership_Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email? : 'Null'}}</td>
                    <td>{{$user->password}}</td>
                    <td>{{$user->role}}</td>
                    <td>{{$user->membership_level}}</td>
                    <td>
                        <!-- Nút Xóa -->
                        <form action="" method="POST" style="display:inline;" onsubmit="confirmDelete(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete"><i class="bi bi-trash3"></i></button>
                        </form>

                        <!-- Nút Sửa -->
                        <button class="action-btn btn-edit" data-target="#editModal-{{$user->id}}"><i class="bi bi-gear-fill"></i></button>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div id="editModal-{{$user->id}}" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" data-close="editModal-{{$user->id}}">&times;</span>
                        <h2>Sửa hiệu ứng</h2>
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')

                            <label>Name</label>
                            <input type="text" name="name" value="{{$user->name}}" maxlength="100" required />

                            <label>Email</label>
                            <input type="email" name="email" value="{{$user->email}}" maxlength="100" required />

                            <label>Password</label>
                            <input type="text" name="password" value="{{$user->password}}" maxlength="100" required />

                            <label>Role</label>
                            <input type="text" name="role" value="{{$user->role}}" maxlength="255" required />

                            <label>Membership_level</label>
                            <input type="text" name="membership_level" value="{{$user->membership_level}}" maxlength="60000" />

                            <button type="submit" class="action-btn">Lưu</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <!-- PHÂN TRANG -->
        <div>

        </div>
        <div class="status-summary">

        </div>
    </div>
    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" data-close="addModal">&times;</span>
            <h2>Thêm hiệu ứng mới</h2>
            <form action="" method="POST">
                @csrf
                @auth
                <label>Author</label>
                <input type="text" name="author" placeholder="Tên người làm..." value="" maxlength="100" required />
                @endauth

                <label>Effect Name</label>
                <input type="text" name="effect_name" value="" placeholder="Tên hiệu ứng..." maxlength="100" required />

                <label>Type</label>
                <input type="text" name="type" value="" placeholder="Hiệu ứng cho ..." maxlength="100" required />

                <label>Title</label>
                <input type="text" name="title" value="" placeholder="Mô tả hiệu ứng..." maxlength="255" required />

                <label>Link</label>
                <input type="text" name="link" value="" placeholder="Link CDN(nếu có)" maxlength="60000" />

                <button type="submit" class="action-btn">Lưu</button>
            </form>
        </div>
    </div>
</div>

<!-- JS mở / đóng modal -->
<script>
    // Mở modal Thêm
    const addModal = document.getElementById("addModal");
    document.querySelector(".btn-add").addEventListener("click", function(e) {
        e.preventDefault();
        addModal.style.display = "flex";
    });

    // Mở modal Edit
    document.querySelectorAll(".btn-edit").forEach((btn) => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const targetModalId = this.getAttribute('data-target');
            document.querySelector(targetModalId).style.display = "flex";
        });
    });

    // Đóng modal khi bấm nút X
    document.querySelectorAll(".close-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const targetId = btn.getAttribute("data-close");
            const modal = document.getElementById(targetId);
            const form = modal.querySelector("form");
            if (form) {
                form.reset();
            }
            modal.style.display = "none";
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Bạn có muốn xoá không ?',
            text: "Hành động này không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonText: 'Huỷ',
            confirmButtonText: 'Xoá!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>