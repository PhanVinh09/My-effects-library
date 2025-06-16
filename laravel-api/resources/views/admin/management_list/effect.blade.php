@include('admin.layouts.sidebar')
<link rel="stylesheet" href="{{ asset('css/admin_manager.css') }}">

<div class="content">
    <div class="table-container">
        <div class="table-header">
            <a class="btn-add" href="#">Thêm hiệu ứng</a>
            <div class="search-bar">
                <form action="{{ route('effects.index') }}" method="GET">
                    <input type="text" list="effects_name" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm Effect Name..." maxlength="100" />
                    <datalist id="effects_name">
                        @foreach ($effects_name as $effect_name)
                        <option value="{{ $effect_name }}">
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
                @foreach ($effects as $effect)
                <tr>
                    <td>{{ $effect->id_effect }}</td>
                    <td>{{ $effect->author }}</td>
                    <td>{{ $effect->effect_name }}</td>
                    <td>{{ $effect->type }}</td>
                    <td>{{ $effect->title ?: 'Null' }}</td>
                    <td>{{ $effect->link ?: 'Null' }}</td>
                    <td>{{ $effect->html ?: 'Null' }}</td>
                    <td>{{ $effect->css ?: 'Null' }}</td>
                    <td>{{ $effect->js ?: 'Null' }}</td>
                    <td>
                        <!-- Nút Xóa -->
                        <form action="{{ route('effects.destroy', $effect->id_effect) }}" method="POST" style="display:inline;" onsubmit="confirmDelete(event, this)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete"><i class="bi bi-trash3"></i></button>
                        </form>

                        <!-- Nút Sửa -->
                        <button class="action-btn btn-edit" data-target="#editModal-{{ $effect->id_effect }}"><i class="bi bi-gear-fill"></i></button>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div id="editModal-{{ $effect->id_effect }}" class="modal">
                    <div class="modal-content">
                        <span class="close-btn" data-close="editModal-{{ $effect->id_effect }}">&times;</span>
                        <h2>Sửa hiệu ứng</h2>
                        <form action="{{ route('effects.update', $effect->id_effect) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="text" name="id" value="{{$effect->id_effect}}" maxlength="100" hidden />
                            <input type="hidden" name="updated_at" value="{{ $effect->updated_at}}">
                            <label>Author</label>
                            <input type="text" name="author" value="{{ $effect->author }}" maxlength="100" required />

                            <label>Effect Name</label>
                            <input type="text" list="effects_name" name="effect_name" value="{{ $effect->effect_name }}" maxlength="100" required />
                            <datalist id="effects_name">
                                @foreach ($effects_name as $effect_name)
                                <option value="{{ $effect_name }}">
                                    @endforeach
                            </datalist>

                            <label>Type</label>
                            <input type="text" list="effect-types" name="type" value="{{ $effect->type }}" maxlength="100" required />
                            <datalist id="effect-types">
                                @foreach ($types as $type)
                                <option value="{{ $type }}">
                                    @endforeach
                            </datalist>

                            <label>Title</label>
                            <input type="text" name="title" value="{{ $effect->title }}" maxlength="255" required />

                            <label>Link</label>
                            <input type="text" name="link" value="{{ $effect->link }}" maxlength="60000" />

                            <label>HTML</label>
                            <input type="text" name="html" value="{{ $effect->html }}" maxlength="60000" />

                            <label>CSS</label>
                            <input type="text" name="css" value="{{ $effect->css }}" maxlength="60000" />

                            <label>JS</label>
                            <input type="text" name="js" value="{{ $effect->js }}" maxlength="60000" />

                            <button type="submit" class="action-btn center-btn">Cập Nhật</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        <!-- PHÂN TRANG -->
        <div>
            {{ $effects->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        <div class="status-summary">
            <span>Đang hiển thị {{ $effects->count() }} dữ liệu, tổng cộng {{ $effects->total() }} dữ liệu</span>
        </div>

    </div>
    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" data-close="addModal">&times;</span>
            <h2>Thêm hiệu ứng mới</h2>
            <form action="{{ route('effects.store') }}" method="POST">
                @csrf
                @auth
                <label>Author</label>
                <input type="text" name="author" placeholder="Tên người làm..." value="{{ Auth::user()->name }}" maxlength="100" required />
                @endauth

                <label>Effect Name</label>
                <input type="text" name="effect_name" list="effects_name" value="{{ old('effect_name') }}" placeholder="Tên hiệu ứng..." maxlength="100" required />
                <datalist id="effects_name">
                    @foreach ($effects_name as $effect_name)
                    <option value="{{ $effect_name }}">
                        @endforeach
                </datalist>

                <label>Type</label>
                <input type="text" list="effect-types" name="type" value="{{ old('type') }}" placeholder="Hiệu ứng cho ..." maxlength="100" required />
                <datalist id="effect-types">
                    @foreach ($types as $type)
                    <option value="{{ $type }}">
                        @endforeach
                </datalist>

                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Mô tả hiệu ứng..." maxlength="255" required />

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