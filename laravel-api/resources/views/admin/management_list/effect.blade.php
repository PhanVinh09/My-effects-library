@include('admin.layouts.sidebar')
<link rel="stylesheet" href="{{ asset('css/admin_manager.css') }}">

<div class="content">
    <div class="table-container">
        <div class="table-header">
            <a class="btn-add" href="#">Thêm hiệu ứng</a>
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
                        <form action="" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
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

                            <label>Author</label>
                            <input type="text" name="author" value="{{ $effect->author }}" />

                            <label>Effect Name</label>
                            <input type="text" list="effects_name" name="effect_name" value="{{ $effect->effect_name }}" />
                            <datalist id="effects_name">
                                @foreach ($effects_name as $effect_name)
                                <option value="{{ $effect_name }}">
                                @endforeach
                            </datalist>

                            <label>Type</label>
                            <input type="text" list="effect-types" name="type" value="{{ $effect->type }}" />
                            <datalist id="effect-types">
                                @foreach ($types as $type)
                                <option value="{{ $type }}">
                                @endforeach
                            </datalist>

                            <label>Title</label>
                            <input type="text" name="title" value="{{ $effect->title }}" />

                            <label>Link</label>
                            <input type="text" name="link" value="{{ $effect->link }}" />

                            <label>HTML</label>
                            <input type="text" name="html" value="{{ $effect->html }}" />

                            <label>CSS</label>
                            <input type="text" name="css" value="{{ $effect->css }}" />

                            <label>JS</label>
                            <input type="text" name="js" value="{{ $effect->js }}" />

                            <button type="submit" class="action-btn">Lưu</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
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
                <input type="text" name="author" placeholder="Tên người làm..." value="{{ Auth::user()->name }}" />
                @endauth

                <label>Effect Name</label>
                <input type="text" name="effect_name" list="effects_name" value="{{ old('effect_name') }}" placeholder="Tên hiệu ứng..." />
                <datalist id="effects_name">
                    @foreach ($effects_name as $effect_name)
                    <option value="{{ $effect_name }}">
                    @endforeach
                </datalist>

                <label>Type</label>
                <input type="text" list="effect-types" name="type" value="{{ old('type') }}" placeholder="Hiệu ứng cho ..." />
                <datalist id="effect-types">
                    @foreach ($types as $type)
                    <option value="{{ $type }}">
                    @endforeach
                </datalist>

                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Mô tả hiệu ứng..." />

                <label>Link</label>
                <input type="text" name="link" value="{{ old('link') }}" placeholder="Link CDN(nếu có)" />

                <label>HTML</label>
                <input type="text" name="html" value="{{ old('html') }}" placeholder="HTML..." />

                <label>CSS</label>
                <input type="text" name="css" value="{{ old('css') }}" placeholder="CSS..." />

                <label>JS</label>
                <input type="text" name="js" value="{{ old('js') }}" placeholder="JS..." />

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
