@include('admin.layouts.sidebar')
<style>
    .info {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 20px 0;
    }

    .box-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        padding: 20px;
    }

    .box-container .box {
        flex: 0 0 300px;
        height: 120px;
        background-color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        font-weight: bold;
        border-radius: 8px;
        box-shadow: 0px 0px 10px 0px gray;
        transition: 0.3s ease;
    }

    .box-container .box:hover {
        transform: scale(1.1);
        box-shadow: 0px 0px 10px 5px gray;
    }

    .box-content {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .detail a {
        text-decoration: none;
        color: blue;
        transition: all 0.5s ease;
        display: inline-block;
    }

    .detail a:hover {
        text-decoration: underline;
        color: gold;
        animation: detail 1s infinite;
    }

    @keyframes detail {

        0%,
        100% {
            transform: translateX(0px);
        }

        50% {
            transform: translateX(10px);
        }
    }

    .box-icon {
        font-size: 36px;
        color: rebeccapurple;
    }
</style>
<div class="content">
    <div class="info">
        <h1>Chào mừng đến trang Dashboard!</h1>
        <p>Đây là phần nội dung chính của bạn.</p>
    </div>
    <div class="box-container">
        <div class="box">
            <div class="box-content">
                <div class="title">Người Dùng</div>
                <div class="quantity">Số Lượng</div>
                <div class="detail"><a href="{{route('users.index')}}">Chi Tiết »</a></div>
            </div>
            <div class="box-icon">
                <i class="bi bi-people"></i>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <div class="title">Quản Trị Viên</div>
                <div class="quantity">Số Lượng</div>
                <div class="detail"><a href="">Chi Tiết »</a></div>
            </div>
            <div class="box-icon">
                <i class="bi bi-person-lock"></i>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <div class="title">Effect</div>
                <div class="quantity">Số Lượng</div>
                <div class="detail"><a href="{{route('effects.index')}}">Chi Tiết »</a></div>
            </div>
            <div class="box-icon">
                <i class="bi bi-brush"></i>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <div class="title">Layout</div>
                <div class="quantity">Số Lượng</div>
                <div class="detail"><a href="{{route('layouts.index')}}">Chi Tiết »</a></div>
            </div>
            <div class="box-icon">
                <i class="bi bi-layout-wtf"></i>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <div class="title">Use Interface</div>
                <div class="quantity">Số Lượng</div>
                <div class="detail"><a href="">Chi Tiết »</a></div>
            </div>
            <div class="box-icon">
                <i class="bi bi-window"></i>
            </div>
        </div>
        <div class="box">
            <div class="box-content">
                <div class="title">Form</div>
                <div class="quantity">Số Lượng</div>
                <div class="detail"><a href="">Chi Tiết »</a></div>
            </div>
            <div class="box-icon">
                <i class="bi bi-input-cursor"></i>
            </div>
        </div>

    </div>
</div>