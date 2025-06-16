@include('admin.layouts.sidebar')
<link rel="stylesheet" href="{{ asset('css/admin_manager.css') }}">

<div class="content">
    <div class="table-container">
        <div class="table-header">
            <a class="btn-add" href="#">Thêm form</a>
            <div class="search-bar">
                <form action="{{ route('forms.index') }}" method="GET">
                    <input type="text" list="forms_name" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm form Name..." maxlength="100" />
                    <datalist id="forms_name">
                        @foreach ($forms_name as $form_name)
                        <option value="{{ $form_name }}">
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
                    <th>Form Name</th>
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
                @foreach ($forms as $form)
                <tr>
                    <td>{{ $form->id_form }}</td>
                    <td>{{ $form->author }}</td>
                    <td>{{ $form->form_name }}</td>
                    <td>{{ $form->type }}</td>
                    <td>{{ $form->title ?: 'Null' }}</td>
                    <td>{{ $form->link ?: 'Null' }}</td>
                    <td>{{ $form->html ?: 'Null' }}</td>
                    <td>{{ $form->css ?: 'Null' }}</td>
                    <td>{{ $form->js ?: 'Null' }}</td>
                    <td>
                        <!-- Nút Xóa -->
                        <form action="{{ route('forms.destroy', $form->id_form) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete"><i class="bi bi-trash3"></i></button>
                        </form>

                        <!-- Nút Sửa -->
                        <button class="action-btn btn-edit" data-target="#editModal-{{ $form->id_form }}"><i class="bi bi-gear-fill"></i></button>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div id="editModal-{{ $form->id_form }}" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" data-close="editModal-{{ $form->id_form }}">&times;</span>
                        <h2>Sửa form</h2>
                        <form action="{{ route('forms.update', $form->id_form) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="id" value="{{$form->id_form}}" maxlength="100" hidden />
                            <input type="hidden" name="updated_at" value="{{ $form->updated_at}}">

                            <label>Author</label>
                            <input type="text" name="author" value="{{ $form->author }}" maxlength="100" required />

                            <label>Form Name</label>
                            <input type="text" list="forms_name" name="form_name" value="{{ $form->form_name }}" maxlength="100" required />
                            <datalist id="forms_name">
                                @foreach ($forms_name as $form_name)
                                <option value="{{ $form_name }}">
                                    @endforeach
                            </datalist>

                            <label>Type</label>
                            <input type="text" list="form-types" name="type" value="{{ $form->type }}" maxlength="100" required />
                            <datalist id="form-types">
                                @foreach ($types as $type)
                                <option value="{{ $type }}">
                                    @endforeach
                            </datalist>

                            <label>Title</label>
                            <input type="text" name="title" value="{{ $form->title }}" maxlength="255" required />

                            <label>Link</label>
                            <input type="text" name="link" value="{{ $form->link }}" maxlength="60000" />

                            <label>HTML</label>
                            <input type="text" name="html" value="{{ $form->html }}" maxlength="60000" />

                            <label>CSS</label>
                            <input type="text" name="css" value="{{ $form->css }}" maxlength="60000" />

                            <label>JS</label>
                            <input type="text" name="js" value="{{ $form->js }}" maxlength="60000" />

                            <button type="submit" class="action-btn center-btn">Cập Nhật</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <!-- PHÂN TRANG -->
        <div>
            {{ $forms->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        <div class="status-summary">
            <span>Đang hiển thị {{ $forms->count() }} dữ liệu, tổng cộng {{ $forms->total() }} dữ liệu</span>
        </div>

    </div>
    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" data-close="addModal">&times;</span>
            <h2>Thêm form mới</h2>
            <form action="{{ route('forms.store') }}" method="POST">
                @csrf
                @auth
                <label>Author</label>
                <input type="text" name="author" placeholder="Tên người làm..." value="{{ Auth::user()->name }}" maxlength="100" required />
                @endauth

                <label>Form Name</label>
                <input type="text" name="form_name" list="forms_name" value="{{ old('form_name') }}" placeholder="Tên form..." maxlength="100" required />
                <datalist id="forms_name">
                    @foreach ($forms_name as $form_name)
                    <option value="{{ $form_name }}">
                        @endforeach
                </datalist>

                <label>Type</label>
                <input type="text" list="form-types" name="type" value="{{ old('type') }}" placeholder="Form cho ..." maxlength="100" required />
                <datalist id="form-types">
                    @foreach ($types as $type)
                    <option value="{{ $type }}">
                        @endforeach
                </datalist>

                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Mô tả form..." maxlength="255" required />

                <label>Link</label>
                <input type="text" name="link" value="{{ old('link') }}" placeholder="Link CDN(nếu có)" maxlength="60000" />

                <label>HTML</label>
                <input type="text" name="html" value="{{ old('html') }}" placeholder="HTML..." maxlength="60000" />

                <label>CSS</label>
                <input type="text" name="css" value="{{ old('css') }}" placeholder="CSS..." maxlength="60000" />

                <label>JS</label>
                <input type="text" name="js" value="{{ old('js') }}" placeholder="JS..." maxlength="60000" />

                <button type="submit" class="action-btn center-btn">Thêm</button>
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