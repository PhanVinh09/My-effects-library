@include('admin.layouts.sidebar')
<link rel="stylesheet" href="{{ asset('css/admin_manager.css') }}">

<div class="content">
    <div class="table-container">
        <div class="table-header">
            <a class="btn-add" href="#">Thêm hiệu ứng</a>
            <div class="search-bar">
                <form action="{{ route('layouts.index') }}" method="GET">
                    <input type="text" list="layouts_name" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm layout Name..." />
                    <datalist id="layouts_name">
                        @foreach ($layouts_name as $layout_name)
                        <option value="{{ $layout_name }}">
                            @endforeach
                    </datalist>
                    <button type="submit"><i class="bi bi-search"></i> Tìm</button>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Author</th>
                    <th>Effect Name</th>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Link</th>
                    <th>HTML</th>
                    <th>CSS</th>
                    <th>JS</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layouts as $layout)
                <tr>
                    <td>{{ $layout->id_layout }}</td>
                    <td>{{ $layout->author }}</td>
                    <td>{{ $layout->layout_name }}</td>
                    <td>{{ $layout->type }}</td>
                    <td>{{ $layout->title ?: 'Null' }}</td>
                    <td>{{ $layout->link ?: 'Null' }}</td>
                    <td>{{ $layout->html ?: 'Null' }}</td>
                    <td>{{ $layout->css ?: 'Null' }}</td>
                    <td>{{ $layout->js ?: 'Null' }}</td>
                    <td>
                        <!-- Nút Xóa -->
                        <form action="{{ route('layouts.destroy', $layout->id_layout) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete"><i class="bi bi-trash3"></i></button>
                        </form>

                        <!-- Nút Sửa -->
                        <button class="action-btn btn-edit" data-target="#editModal-{{ $layout->id_layout }}"><i class="bi bi-gear-fill"></i></button>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div id="editModal-{{ $layout->id_layout }}" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" data-close="editModal-{{ $layout->id_layout }}">&times;</span>
                        <h2>Sửa hiệu ứng</h2>
                        <form action="{{ route('layouts.update', $layout->id_layout) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label>Author</label>
                            <input type="text" name="author" value="{{ $layout->author }}" maxlength="100" required />

                            <label>layout Name</label>
                            <input type="text" list="layouts_name" name="layout_name" value="{{ $layout->layout_name }}" maxlength="100" required  />
                            <datalist id="layouts_name">
                                @foreach ($layouts_name as $layout_name)
                                <option value="{{ $layout_name }}">
                                    @endforeach
                            </datalist>

                            <label>Type</label>
                            <input type="text" list="layout-types" name="type" value="{{ $layout->type }}" maxlength="100" required  />
                            <datalist id="layout-types">
                                @foreach ($types as $type)
                                <option value="{{ $type }}">
                                    @endforeach
                            </datalist>

                            <label>Title</label>
                            <input type="text" name="title" value="{{ $layout->title }}" maxlength="255" required/>

                            <label>Link</label>
                            <input type="text" name="link" value="{{ $layout->link }}" maxlength="60000"/>

                            <label>HTML</label>
                            <input type="text" name="html" value="{{ $layout->html }}" maxlength="60000"/>

                            <label>CSS</label>
                            <input type="text" name="css" value="{{ $layout->css }}" maxlength="60000"/>

                            <label>JS</label>
                            <input type="text" name="js" value="{{ $layout->js }}" maxlength="60000"/>

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
            <form action="{{ route('layouts.store') }}" method="POST">
                @csrf
                @auth
                <label>Author</label>
                <input type="text" name="author" placeholder="Tên người làm..." value="{{ Auth::user()->name }}" maxlength="100" required/>
                @endauth

                <label>layout Name</label>
                <input type="text" name="layout_name" list="layouts_name" value="{{ old('layout_name') }}" placeholder="Tên hiệu ứng..." maxlength="100" required/>
                <datalist id="layouts_name">
                    @foreach ($layouts_name as $layout_name)
                    <option value="{{ $layout_name }}">
                        @endforeach
                </datalist>

                <label>Type</label>
                <input type="text" list="layout-types" name="type" value="{{ old('type') }}" placeholder="Hiệu ứng cho ..." maxlength="100" required/>
                <datalist id="layout-types">
                    @foreach ($types as $type)
                    <option value="{{ $type }}">
                        @endforeach
                </datalist>

                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Mô tả hiệu ứng..." maxlength="255" required/>

                <label>Link</label>
                <input type="text" name="link" value="{{ old('link') }}" placeholder="Link CDN(nếu có)" maxlength="60000"/>

                <label>HTML</label>
                <input type="text" name="html" value="{{ old('html') }}" placeholder="HTML..." maxlength="60000"/>

                <label>CSS</label>
                <input type="text" name="css" value="{{ old('css') }}" placeholder="CSS..." maxlength="60000"/>

                <label>JS</label>
                <input type="text" name="js" value="{{ old('js') }}" placeholder="JS..." maxlength="60000"/>

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