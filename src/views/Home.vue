<template>
  <section class="home">
    <div class="container">
      <h1>🌟 Thư Viện Hiệu Ứng Giao Diện Đỉnh Cao 🌟</h1>
      <p class="intro">
        Khám phá kho tàng hiệu ứng giao diện độc đáo, hiện đại và cực kỳ dễ áp dụng để biến website của bạn thành tác phẩm nghệ thuật sống động.
      </p>

      <ul>
        <li>✨ Hiệu ứng <strong>Hover & Transition</strong> mượt mà, tạo cảm giác tương tác cực kỳ tinh tế</li>
        <li>🎬 <strong>Animation chân thực & Parallax sống động</strong>, mang đến trải nghiệm đa chiều ấn tượng</li>
        <li>⚡️ Copy code chỉ với <strong>1 cú click</strong>, xem demo trực tiếp ngay lập tức, tiết kiệm thời gian vô giá</li>
        <li>🧠 Gợi ý áp dụng thực tiễn, giúp bạn nhanh chóng tích hợp vào dự án cá nhân hoặc doanh nghiệp</li>
      </ul>

      <p class="cta">
        Đừng chỉ làm website, hãy tạo nên trải nghiệm khiến khách hàng phải <em>“Wow”</em> mỗi lần ghé thăm. Bắt đầu khám phá những hiệu ứng đỉnh nhất ngay từ menu phía trên!
      </p>
    </div>
  </section>
</template>

<script setup>
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

section.home {
  padding: 80px 20px;
  background: linear-gradient(135deg, #0d324d, #7f5a83);
  color: #fafafa;
  text-align: center;
  border-radius: 14px;
  box-shadow: 0 12px 36px rgba(0, 0, 0, 0.3);
  transition: background 0.3s ease;
}

section.home:hover {
  background: linear-gradient(135deg, #1a4b73, #a17cbc);
}

.container {
  max-width: 920px;
  margin: 0 auto;
  padding: 0 15px;
}

h1 {
  font-size: 3rem;
  margin-bottom: 25px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-shadow: 0 3px 8px rgba(0, 0, 0, 0.45);
  user-select: none;
}

.intro {
  font-size: 1.3rem;
  max-width: 750px;
  margin: 0 auto 40px;
  line-height: 1.7;
  color: #e3e6ee;
}

ul {
  list-style: none;
  padding: 0;
  margin-bottom: 45px;
}

ul li {
  font-size: 1.2rem;
  margin: 14px 0;
  position: relative;
  padding-left: 45px;
  font-weight: 600;
  color: #d4d8e7;
  text-align: left;
  max-width: 720px;
  margin-left: auto;
  margin-right: auto;
  transition: color 0.3s ease;
  cursor: default;
}

ul li strong {
  color: #ffea7b;
  font-weight: 700;
}

ul li:hover {
  color: #ffe066;
}

ul li::before {
  content: '👉';
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 1.5rem;
  color: #ffd94e;
  transition: transform 0.3s ease;
}

ul li:hover::before {
  transform: translateY(-50%) translateX(5px);
}

.cta {
  font-size: 1.25rem;
  max-width: 700px;
  margin: 0 auto;
  color: #fff9f2;
  font-style: italic;
  text-shadow: 0 1px 3px rgba(0,0,0,0.4);
  user-select: none;
}

@media (max-width: 768px) {
  section.home {
    padding: 60px 15px;
  }
  h1 {
    font-size: 2.4rem;
  }
  .intro,
  .cta {
    font-size: 1.1rem;
  }
  ul li {
    font-size: 1.05rem;
    padding-left: 35px;
  }
  ul li::before {
    left: 10px;
    font-size: 1.3rem;
  }
}

@media (max-width: 400px) {
  h1 {
    font-size: 1.9rem;
  }
  ul li {
    font-size: 1rem;
  }
  .intro,
  .cta {
    font-size: 1rem;
  }
}
</style>
