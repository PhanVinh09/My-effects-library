<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <div class="layout">
    <header>
      <nav>
        <div class="logo">
          LOGO
        </div>
        <ul class="nav-links">
          <li><RouterLink to="/">Trang chủ</RouterLink></li>
          <li><RouterLink to="/about">Giới thiệu</RouterLink></li>

          <li class="dropdown">
            <a href="#">Hiệu ứng ▾</a>
            <ul class="dropdown-menu">
              <li><RouterLink to="/effect/hover">Hover</RouterLink></li>
              <li><RouterLink to="/effect/animate">Animation</RouterLink></li>
              <li><RouterLink to="/effect/scroll">Scroll</RouterLink></li>
              <li><RouterLink to="/effect/3d">3D</RouterLink></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#">Giao diện ▾</a>
            <ul class="dropdown-menu">
              <li class="dropdown-1">
                <a href="#">Layout ▾</a>
                <ul class="dropdown-menu-1">
                  <li><RouterLink to="">Header</RouterLink></li>
                  <li><RouterLink to="">Footer</RouterLink></li>
                  <li><RouterLink to="">Sidebar</RouterLink></li>
                  <li><RouterLink to="">HeroBanner</RouterLink></li>
                </ul>
              </li>
              <li class="dropdown-2">
                <a href="#">UI ▾</a>
                <ul class="dropdown-menu-2">
                  <li><RouterLink to="">Card</RouterLink></li>
                  <li><RouterLink to="">Button</RouterLink></li>
                  <li><RouterLink to="">InputField</RouterLink></li>
                  <li><RouterLink to="">DropDownMenu</RouterLink></li>
                  <li><RouterLink to="">SearchBar</RouterLink></li>
                  <li><RouterLink to="">Pagination</RouterLink></li>
                  <li><RouterLink to="">Dashboard</RouterLink></li>
                  <li><RouterLink to="">ErrorPage (404)</RouterLink></li>
                </ul>
              </li>
              <li class="dropdown-3">
                <a href="#">From ▾</a>
                <ul class="dropdown-menu-3">
                  <li><RouterLink to="">LoginForm</RouterLink></li>
                  <li><RouterLink to="">RegisterForm</RouterLink></li>
                  <li><RouterLink to="">PasswordResetForm</RouterLink></li>
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
html,
body {
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', sans-serif;
}

.layout {
  width: 100vw;
  min-height: 200vh;
  margin: 0;
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

nav .logo {
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

.nav-links li a {
  color: white;
  text-decoration: none;
  font-size: 16px;
  padding: 8px 12px;
  border-radius: 4px;
  transition: background-color 0.3s;
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

.dropdown-menu {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  background-color: white;
  list-style: none;
  padding: 4px 0;
  margin: 0;
  min-width: 180px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  border-radius: 4px;
  z-index: 999;
}

.dropdown-menu li {
  width: 100%;
}

.dropdown-menu li a {
  display: block;
  color: #333;
  text-decoration: none;
  padding: 10px 16px;
  font-size: 15px;
  border-bottom: 1px solid #eee;
  transition: background-color 0.3s;
}

.dropdown-menu li a:hover {
  background-color: blue;
  color: black;
}

.dropdown:hover .dropdown-menu {
  display: block;
}
.dropdown-1 .dropdown-menu-1{
  display: none;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.dropdown-1:hover .dropdown-menu-1{
  display: block;
  opacity: 1;
}
.dropdown-2 .dropdown-menu-2{
  display: none;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.dropdown-2:hover .dropdown-menu-2{
  display: block;
  opacity: 1;
}
.dropdown-3 .dropdown-menu-3{
  display: none;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.dropdown-3:hover .dropdown-menu-3{
  display: block;
  opacity: 1;
}
main {
  padding-top: 80px;
  background-color: #6c4de782;
  color: black;
  height: 100%;
}
</style>
