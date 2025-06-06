<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Modern Navigation</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f4f4f4;
    }

    header {
      position: relative;
      height: 100px;
    }

    nav {
      position: absolute;
      inset: 0;
      background: linear-gradient(to right, #2c3e50, #3498db);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 30px 60px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-bottom-left-radius: 12px;
      border-bottom-right-radius: 12px;
    }

    a {
      text-decoration: none;
    }

    li {
      list-style: none;
    }

    .nav-logo a {
      font-size: 32px;
      font-weight: bold;
      color: #f1c40f;
      transition: all 0.3s ease;
    }

    .nav-logo a:hover {
      transform: scale(1.1);
    }

    .nav-list {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 25px;
    }

    .nav-item {
      background-color: transparent;
      padding: 8px 14px;
      border-radius: 6px;
      transition: 0.3s ease;
    }

    .nav-link {
      font-size: 18px;
      color: white;
      transition: 0.3s ease;
    }

    .nav-item:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateY(-2px);
    }

    .nav-item:hover .nav-link {
      color: #f1c40f;
    }

    .dropdown {
      position: relative;
      padding: 8px 14px;
      border-radius: 6px;
      background-color: transparent;
    }

    .dropdown-title {
      font-size: 18px;
      color: white;
      cursor: pointer;
    }

    .dropdown-menu {
      position: absolute;
      margin-top: 10px;
      left: 0;
      background-color: #ecf0f1;
      border-radius: 8px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      visibility: hidden;
      opacity: 0;
      transition: 0.3s ease;
      overflow: hidden;
    }

    .dropdown:hover .dropdown-menu {
      visibility: visible;
      opacity: 1;
    }

    .dropdown-item {
      margin: 0;
      padding: 10px 20px;
      transition: 0.3s ease;
    }

    .dropdown-link {
      color: #2c3e50;
      font-size: 16px;
    }

    .dropdown-item:hover {
      background-color: #3498db;
    }

    .dropdown-item:hover .dropdown-link {
      color: white;
    }

    .btn-login {
      background-color: #f1c40f;
      padding: 8px 18px;
      font-size: 16px;
      font-weight: 600;
      color: #2c3e50;
      border-radius: 8px;
      transition: 0.3s ease;
    }

    .btn-login:hover {
      transform: scale(1.05);
      background-color: #f39c12;
      color: white;
    }

    @media screen and (max-width: 768px) {
      nav {
        flex-direction: column;
        gap: 20px;
        height: auto;
      }

      .nav-list {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="nav-logo"><a href="#">Logo</a></div>
      <ul class="nav-list">
        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
        <li class="dropdown">
          <span class="dropdown-title">Dropdown ▾</span>
          <ul class="dropdown-menu">
            <li class="dropdown-item"><a class="dropdown-link" href="#">Option 1</a></li>
            <li class="dropdown-item"><a class="dropdown-link" href="#">Option 2</a></li>
            <li class="dropdown-item"><a class="dropdown-link" href="#">Option 3</a></li>
          </ul>
        </li>
      </ul>
      <a class="btn-login" href="#">Login</a>
    </nav>
  </header>