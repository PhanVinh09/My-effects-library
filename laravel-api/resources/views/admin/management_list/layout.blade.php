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
                    <th>Layout Name</th>
                    <th>Type</th>
                    <th>Link</th>
                    <th>HTML</th>
                    <th>CSS</th>
                    <th>JSS</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layouts as $layout)
                <tr>
                    <td>{{ $layout->id }}</td>
                    <td>{{ $layout->author }}</td>
                    <td>{{ $layout->layout_name }}</td>
                    <td>{{ $layout->type }}</td>
                    <td>{{ $effect->link ? : 'Null' }}</td>
                    <td>{{ $effect->html ? : 'Null'}}</td>
                    <td>{{ $effect->css ? : 'Null'}}</td>
                    <td>{{ $effect->js ? : 'Null'}}</td>
                    <td>
                        <button class="action-btn btn-delete" data-id="{{ $layout->id }}">Delete</button>
                        <button class="action-btn btn-edit" data-id="{{ $layout->id }}">Edit</button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" data-close="addModal">&times;</span>
            <h2>Thêm hiệu ứng mới</h2>
            <form>
                <label>Author</label>
                <input type="text" placeholder="Tên người làm..." />
                <label>Effect Name</label>
                <input type="text" placeholder="Tên hiệu ứng..." />
                <label>Type</label>
                <input type="text" placeholder="Loại hiệu ứng..." />
                <label>Link</label>
                <input type="text" placeholder="Link CDN(nếu có)" />
                <label>HTML</label>
                <input type="text" placeholder="HTML..." />
                <label>CSS</label>
                <input type="text" placeholder="CSS..." />
                <label>JS</label>
                <input type="text" placeholder="JS..." />
                <button type="submit" class="action-btn">Lưu</button>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" data-close="editModal">&times;</span>
            <h2>Sửa hiệu ứng</h2>
            <form id="editForm">
                <label>Author</label>
                <input type="text" name="author" />
                <label>Effect Name</label>
                <input type="text" name="effect" />
                <label>Type</label>
                <input type="text" name="type" />
                <label>Link</label>
                <input type="text" name="link" />
                <label>HTML</label>
                <input type="text" name="html" />
                <label>CSS</label>
                <input type="text" name="css" />
                <label>JS</label>
                <input type="text" name="js" />
                <button type="submit" class="action-btn">Lưu</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Mở modal Thêm
    const addModal = document.getElementById("addModal");
    document.querySelector(".btn-add").addEventListener("click", function(e) {
        e.preventDefault();
        addModal.style.display = "flex";
    });

    // Mở modal Sửa
    const editModal = document.getElementById("editModal");
    const editForm = document.getElementById("editForm");

    document.querySelectorAll(".btn-edit").forEach((btn) => {
        btn.addEventListener("click", function() {
            const row = this.closest("tr");
            const cells = row.querySelectorAll("td");

            // Lấy dữ liệu từ dòng được chọn
            editForm.author.value = cells[1].innerText;
            editForm.effect.value = cells[2].innerText;
            editForm.type.value = cells[3].innerText;
            editForm.link.value = cells[4].innerText;
            editForm.html.value = cells[5].innerText;
            editForm.css.value = cells[6].innerText;
            editForm.js.value = cells[7].innerText;

            // Hiển thị modal sửa
            editModal.style.display = "flex";
        });
    });

    // Đóng modal khi bấm nút X
    document.querySelectorAll(".close-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const targetId = btn.getAttribute("data-close");
            document.getElementById(targetId).style.display = "none";
        });
    });

    // Đóng khi bấm ra ngoài
    window.addEventListener("click", function(e) {
        if (e.target.classList.contains("modal")) {
            e.target.style.display = "none";
        }
    });
</script>