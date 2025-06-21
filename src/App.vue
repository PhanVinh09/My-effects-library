<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { RouterLink, RouterView } from 'vue-router'

const backendUrl = import.meta.env.VITE_BACKEND_URL

const isLayoutOpen = ref(false)
const isUIOpen = ref(false)
const isFormOpen = ref(false)

const isMobile = ref(window.innerWidth <= 768)

const handleResize = () => {
  isMobile.value = window.innerWidth <= 768
}

onMounted(() => {
  window.addEventListener('resize', handleResize)
})

onBeforeUnmount(() => {
  window.removeEventListener('resize', handleResize)
})

const toggleMenu = (menu) => {
  if (menu === 'layout') isLayoutOpen.value = !isLayoutOpen.value
  if (menu === 'ui') isUIOpen.value = !isUIOpen.value
  if (menu === 'form') isFormOpen.value = !isFormOpen.value
}
</script>

<template>
  <div class="layout">
    <header>
      <nav>
        <div class="logo">MEL</div>
        <ul class="nav-links">
          <li>
            <RouterLink v-if="!isMobile" class="menu-default" to="/">Trang chủ</RouterLink>
            <RouterLink v-else class="menu-icon" to="/"><i class="bi bi-house"></i></RouterLink>
          </li>
          <li>
            <RouterLink v-if="!isMobile" class="menu-default" to="/about">Giới thiệu</RouterLink>
            <RouterLink v-else class="menu-icon" to="/about"><i class="bi bi-info-circle"></i></RouterLink>
          </li>
          <li>
            <a v-if="!isMobile" class="menu-default" :href="`${backendUrl}/admin`" target="_blank">Admin</a>
            <a v-else class="menu-icon" :href="`${backendUrl}/admin`" target="_blank"><i
                class="bi bi-person-circle"></i></a>
          </li>

          <li class="dropdown">
            <a href="#">Hiệu ứng ▾</a>
            <ul class="dropdown-menu">
              <li>
                <RouterLink to="/effect/hover">Hover</RouterLink>
              </li>
              <li>
                <RouterLink to="/effect/animate">Animation</RouterLink>
              </li>
              <li>
                <RouterLink to="/effect/scroll">Scroll</RouterLink>
              </li>
              <li>
                <RouterLink to="/effect/3d">3D</RouterLink>
              </li>
              <li>
                <RouterLink to="/effect/click">Click</RouterLink>
              </li>
              <li>
                <RouterLink to="/effect/load">Load</RouterLink>
              </li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#">Giao diện ▾</a>
            <ul class="dropdown-menu">
              <li class="dropdown-1">
                <a href="#" @click.prevent="toggleMenu('layout')">Layout ▾</a>
                <ul class="dropdown-menu-1" v-show="isLayoutOpen">
                  <li>
                    <RouterLink to="/layout/header">Header</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="/layout/footer">Footer</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="/layout/sidebar">Sidebar</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="/layout/heroBanner">HeroBanner</RouterLink>
                  </li>
                </ul>
              </li>
              <li class="dropdown-2">
                <a href="#" @click.prevent="toggleMenu('ui')">UI ▾</a>
                <ul class="dropdown-menu-2" v-show="isUIOpen">
                  <li>
                    <RouterLink to="">Card</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="">Button</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="">InputField</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="">DropDownMenu</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="">SearchBar</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="">Pagination</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="">Dashboard</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="">ErrorPage (404)</RouterLink>
                  </li>
                </ul>
              </li>
              <li class="dropdown-3">
                <a href="#" @click.prevent="toggleMenu('form')">Form ▾</a>
                <ul class="dropdown-menu-3" v-show="isFormOpen">
                  <li>
                    <RouterLink to="/form/login">Login</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="/form/register">Register</RouterLink>
                  </li>
                  <li>
                    <RouterLink to="/form/passwordReset">Reset Password</RouterLink>
                  </li>
                   <li>
                    <RouterLink to="/form/changePassword">Change Password</RouterLink>
                  </li>
                   <li>
                    <RouterLink to="/form/profileUpdate">Profile Update</RouterLink>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>

    <main>
      <RouterView />
    </main>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

html,
body {
  margin: 0;
  padding: 0;
  font-family: 'Poppins', sans-serif;
}

.layout {
  width: 100vw;
  min-height: 100vh;
  background: linear-gradient(45deg, black, blue, violet, black);
}

header {
  width: 100%;
}

nav {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 60px;
  padding: 0 40px;
  background-color: rgba(6, 27, 27, 0.9);
  display: flex;
  align-items: center;
  justify-content: space-between;
  z-index: 1000;
}

.logo {
  font-weight: bold;
  color: white;
  font-size: 24px;
}

.nav-links {
  display: flex;
  gap: 20px;
  list-style: none;
  margin: 0;
  padding: 0;
  position: relative;
}

.nav-links li {
  position: relative;
}

.nav-links li>a,
.nav-links li>.router-link-active {
  color: white;
  text-decoration: none;
  font-size: 16px;
  padding: 8px 12px;
  border-radius: 6px;
  transition: all 0.3s ease;
  display: inline-block;
}

.nav-links li a:hover {
  background-color: goldenrod;
  border: 1px green solid;
}

.router-link-active {
  border: 1px green solid;
  background-color: #797bea98;
}

/* Dropdown base */
.dropdown-menu,
.dropdown-menu-1,
.dropdown-menu-2,
.dropdown-menu-3 {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background-color: #fff;
  list-style: none;
  padding: 8px 0;
  margin: 0;
  min-width: 200px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  z-index: 999;
  opacity: 0;
  transform: translateY(10px);
  pointer-events: none;
  transition: all 0.3s ease;
}

.dropdown:hover>.dropdown-menu {
  display: block;
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}

.dropdown-menu li a {
  display: block;
  padding: 12px 18px;
  font-size: 15px;
  font-weight: 500;
  color: #222;
  text-decoration: none;
  border-bottom: 1px solid #f0f0f0;
  border-radius: 6px;
  transition: all 0.3s ease;
}

.dropdown-menu li a:hover {
  background-color: #f5f5f5;
  color: #007bff;
  transform: translateX(4px);
}

.dropdown-menu li>a::after {
  content: '▸';
  float: right;
  color: #aaa;
  transition: transform 0.3s ease;
}

.dropdown-menu li a:hover::after {
  transform: translateX(4px);
  color: #007bff;
}

.dropdown-1 ul,
.dropdown-2 ul,
.dropdown-3 ul {
  margin-left: 10px;
  margin-top: 4px;
  border-left: 2px solid #eee;
  padding-left: 10px;
}

.dropdown-menu-1,
.dropdown-menu-2,
.dropdown-menu-3 {
  display: block;
  opacity: 1;
  transform: none;
  pointer-events: auto;
  background-color: #fdfdfd;
  box-shadow: none;
  margin-top: 5px;
  border-radius: 8px;
}

.dropdown-menu-1 li a,
.dropdown-menu-2 li a,
.dropdown-menu-3 li a {
  padding: 10px 16px;
  font-size: 14px;
}

main {
  padding-top: 60px;
  background-color: #6c4de782;
  color: black;
  height: 100%;
}

@media (max-width: 768px) {
  nav {
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 10px 20px;
    height: auto;
  }

  .logo {
    font-size: 14px;
    margin-bottom: 8px;
  }

  .nav-links {
    flex-direction: row;
    justify-content: center;
    flex-wrap: wrap;
    width: 100%;
    gap: 10px;
  }

  .nav-links li {
    width: auto;
    text-align: center;
  }

  .nav-links li>a,
  .nav-links li>.router-link-active {
    display: flex;
    justify-content: center;
    font-size: 12px;
    padding: 6px 8px;
  }

  .dropdown-menu,
  .dropdown-menu-1,
  .dropdown-menu-2,
  .dropdown-menu-3 {
    min-width: 100px;
  }

  .dropdown-menu li a,
  .dropdown-menu-1 li a,
  .dropdown-menu-2 li a,
  .dropdown-menu-3 li a {
    font-size: 12px;
    padding: 10px;
    border-bottom: 1px solid #eee;
    color: #333;
    display: block;
    text-align: start;
  }

  main {
    padding: 80px 10px 20px;
  }
}
</style>
