<template>
  <section class="about">
    <div class="container">
      <h1>🌐 PhanTheVinh-Library ~ Nơi Học Tập & Chia Sẻ Cảm Hứng Thiết Kế Giao Diện</h1>

      <p>Chào mừng bạn đến với <strong>kho tàng hiệu ứng web hiện đại</strong> – nơi mọi hiệu ứng từ đơn giản đến nâng
        cao đều được phân loại, giải thích và minh họa rõ ràng để bạn học hỏi, thực hành và chia sẻ.</p>

      <h2>🎯 Mục tiêu của trang này:</h2>
      <ul>
        <li>Tập hợp toàn bộ các hiệu ứng phổ biến và sáng tạo nhất trong thiết kế web.</li>
        <li>Hướng dẫn cách sử dụng bằng <strong>HTML, CSS, JavaScript</strong> hoặc thư viện hiện đại.</li>
        <li>Khơi nguồn cảm hứng sáng tạo và giúp bạn làm chủ giao diện tương tác.</li>
      </ul>

      <h2>🧩 Các loại hiệu ứng bạn sẽ khám phá:</h2>
      <ul>
        <li>💫 <strong>Hover Effects:</strong> Đổi màu, scale, glow, lật thẻ, overlay... (dùng <code>transform</code>,
          <code>transition</code>, <code>filter</code>...)
        </li>
        <li>🖱️ <strong>Click & Active Effects:</strong> Nút nhấn nhá, ripple effect, loading animation...</li>
        <li>🌀 <strong>Scroll Effects:</strong> Parallax, sticky section, fade-in,... (kết hợp Locomotive,
          ScrollTrigger...)</li>
        <li>🎬 <strong>Page Load & Transition:</strong> Loader animation, hiệu ứng chuyển trang (SPA, Vue, React...)
        </li>
        <li>🔄 <strong>Animation nâng cao:</strong> Keyframes CSS, GSAP, Anime.js...</li>
        <li>🧠 <strong>3D & Perspective Effects:</strong> Xoay 3D, nghiêng theo chuột, chiều sâu khi cuộn...</li>
        <li>⚙️ <strong>Hiệu ứng thực tế nâng cao:</strong> Giao diện theo giờ, input-based animation, hiệu ứng toán
          học...</li>
      </ul>

      <h2>📘 Học thế nào?</h2>
      <ul>
        <li>📄 Chi tiết từng hiệu ứng: mã nguồn, hình ảnh minh họa, giải thích nguyên lý.</li>
        <li>🛠️ Công cụ thử trực tiếp: sửa code & xem kết quả như CodePen.</li>
        <li>📤 Chia sẻ của bạn: upload, viết lại hoặc sáng tạo hiệu ứng của riêng bạn.</li>
      </ul>

      <h2>🧑‍💻 Phù hợp cho:</h2>
      <ul>
        <li>Học sinh, sinh viên ngành lập trình & thiết kế web.</li>
        <li>Frontend Developer muốn nâng cao kỹ năng giao diện.</li>
        <li>Người yêu cái đẹp trong UI/UX và hiệu ứng hình ảnh.</li>
        <li>Bất kỳ ai đang làm dự án web cần hiệu ứng để "nâng cấp trải nghiệm người dùng".</li>
      </ul>

      <blockquote>
        🚀 Hãy bắt đầu hành trình làm chủ hiệu ứng ngay hôm nay!<br>
        <span class="highlight">“Giao diện là thứ đầu tiên người dùng nhìn thấy, và hiệu ứng là điều khiến họ ở
          lại.”</span>
      </blockquote>
    </div>
  </section>

</template>

<script setup>
</script>

<style scoped>
.about {
  padding: 80px 20px;
}

.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 40px 20px;
}

h1 {
  color: #ffffff;
  font-size: 32px;
  margin-bottom: 20px;
}

h2 {
  color: #2c3e50;
  font-size: 24px;
  margin-top: 30px;
  margin-bottom: 10px;
}

p,
li {
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 10px;
}

ul {
  padding-left: 20px;
}

blockquote {
  font-style: italic;
  background: #ecf0f1;
  padding: 15px 20px;
  border-left: 5px solid #1abc9c;
  margin: 30px 0;
}

.icon {
  margin-right: 5px;
}

.highlight {
  color: #e67e22;
  font-weight: bold;
}

@media (max-width: 768px) {
  .about {
    padding: 40px 10px;
  }

  .container {
    padding: 20px 10px;
  }

  h1 {
    font-size: 22px;
    text-align: center;
    line-height: 1.4;
  }

  h2 {
    font-size: 18px;
    margin-top: 20px;
    margin-bottom: 8px;
  }

  p,
  li {
    font-size: 14px;
    line-height: 1.5;
  }

  ul {
    padding-left: 15px;
  }

  blockquote {
    font-size: 14px;
    padding: 12px 15px;
  }

  .highlight {
    display: block;
    margin-top: 10px;
    font-size: 14px;
    text-align: center;
  }
}
</style>
