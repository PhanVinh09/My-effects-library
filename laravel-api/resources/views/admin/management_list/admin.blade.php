@include('admin.layouts.sidebar')
<link rel="stylesheet" href="{{ asset('css/admin_manager.css') }}">

<div class="content">
    <div class="table-container">
        <div class="table-header">
            <a class="btn-add" href="#">Thêm Người Quản Lý</a>
            <div class="search-bar">
                <form action="{{ route('admins.index') }}" method="GET">
                    <input type="text" name="search" value="{{request('search')}}" placeholder="Tìm kiếm Name..." />
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
                @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email? : 'Null'}}</td>
                    <td>{{$admin->password}}</td>
                    <td>{{$admin->role}}</td>
                    <td>{{$admin->membership_level}}</td>
                    <td>
                        <!-- Nút Xóa -->
                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" class="form-delete" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="code" class="auth-code-input"> 
                            <button type="submit" class="action-btn btn-delete">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>

                        <!-- Nút Sửa -->
                        <button class="action-btn btn-edit" data-target="#editModal-{{$admin->id}}"><i class="bi bi-gear-fill"></i></button>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div id="editModal-{{$admin->id}}" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" data-close="editModal-{{$admin->id}}">&times;</span>
                        <h2>Sửa hiệu ứng</h2>
                        <form action="{{route('admins.update', $admin->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="id" value="{{$admin->id}}" maxlength="100" hidden />
                            <label>Name</label>
                            <input type="text" name="name" value="{{$admin->name}}" maxlength="100" />

                            <label>Email</label>
                            <input type="email" name="email" value="{{$admin->email}}" disabled />

                            <label>Password</label>
                            <input type="text" name="password" value="{{$admin->password}}" minlength="6" maxlength="30" />

                            <label>Role</label>
                            <select name="role" id="role">
                                <option value="admin" {{$admin->role === 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="user" {{$admin->role === 'user' ? 'selected' : ''}}>User</option>
                            </select>

                            <label>Membership_level</label>
                            <select name="membership_level" id="membership_level">
                                <option value="VIP" {{$admin->membership_level === 'VIP' ? 'selected' : ''}}>VIP</option>
                                <option value="Normal" {{$admin->membership_level === 'Normal' ? 'selected' : ''}}>Normal</option>
                            </select>

                            <label>Mã xác thực:</label>
                            <input type="password" name="code" required placeholder="Nhập mã ...">
                            <button type="submit" class="action-btn">Lưu</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <!-- PHÂN TRANG -->
        <div>
            {{ $admins->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        <div class="status-summary">
            <span>Đang hiển thị {{ $admins->count() }} admin, tổng cộng {{ $admins->total() }} admin</span>
        </div>
    </div>
    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" data-close="addModal">&times;</span>
            <h2>Thêm hiệu ứng mới</h2>
            <form action="{{route('admins.store')}}" method="POST">
                @csrf
                <label>Name</label>
                <input type="text" name="name" placeholder="Nhập tên..." value="{{ old('name')}}" maxlength="100" required />

                <label>Email</label>
                <input type="email" name="email" placeholder="Nhập email..." value="{{ old('email')}}" />

                <label>Password</label>
                <input type="text" name="password" placeholder="Nhập Mật khẩu" value="{{ old('password')}}" minlength="6" maxlength="30" required />

                <label>Role</label>
                <select name="role" id="role" disabled style="cursor: not-allowed;">
                    <option value="admin">Admin</option>
                </select>
                <input type="hidden" name="role" value="admin">

                <label>Membership_level</label>
                <select name="membership_level" id="membership_level">
                    <option value="Normal">Normal</option>
                    <option value="VIP">VIP</option>
                </select>

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
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Xác nhận xoá',
                html: `
                    <p>Vui lòng nhập mã xác thực:</p>
                    <input style="width: 200px" type="password" id="auth-code" class="swal2-input" placeholder="Nhập mã xác thực">
                `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xoá',
                cancelButtonText: 'Huỷ',
                focusConfirm: false,
                preConfirm: () => {
                    const code = Swal.getPopup().querySelector('#auth-code').value;
                    if (!code) {
                        Swal.showValidationMessage('Bạn phải nhập mã');
                    }
                    return code;
                }
            }).then(result => {
                if (result.isConfirmed) {
                    const codeInput = form.querySelector('.auth-code-input');
                    codeInput.value = result.value; 
                    form.submit();
                }
            });
        });
    });
});
</script>
