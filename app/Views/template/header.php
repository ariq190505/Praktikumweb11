<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title; ?> </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
    <style>
      :root {
        --primary-color: #6366f1;
        --secondary-color: #8b5cf6;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --dark-color: #1f2937;
        --light-color: #f8fafc;
        --border-color: #e5e7eb;
      }

      body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
      }

      #container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        margin: 20px auto;
        max-width: 1400px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        overflow: hidden;
      }

      header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
      }

      header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
      }

      header h1 {
        margin: 0;
        font-size: 2.5rem;
        font-weight: 700;
        position: relative;
        z-index: 1;
      }

      nav {
        background: white;
        padding: 1rem 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;
        justify-content: center;
      }

      nav a {
        color: var(--dark-color);
        text-decoration: none;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      nav a:hover, nav a.active {
        background: var(--primary-color);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
      }

      #main {
        padding: 2rem;
        min-height: 60vh;
        max-width: 1200px;
        margin: 0 auto;
      }

      #wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .page-title {
        color: var(--dark-color);
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        text-align: center;
      }

      .page-title i {
        color: var(--primary-color);
      }

      .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        margin-bottom: 2rem;
        transition: transform 0.3s ease;
      }

      .card:hover {
        transform: translateY(-5px);
      }

      .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 1.5rem;
        font-weight: 600;
      }

      .table {
        margin: 0;
        border-radius: 15px;
        overflow: hidden;
      }

      .table thead th {
        background: var(--light-color);
        border: none;
        color: var(--dark-color);
        font-weight: 600;
        padding: 1.5rem 1rem;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
      }

      .table tbody td {
        border: none;
        padding: 1.5rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
      }

      .table tbody tr:hover {
        background: rgba(99, 102, 241, 0.05);
      }

      .table img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      }

      .badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 500;
        font-size: 0.8rem;
      }

      .btn {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
      }

      .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      }

      .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      }

      .btn-success {
        background: linear-gradient(135deg, var(--success-color), #059669);
      }

      .btn-warning {
        background: linear-gradient(135deg, var(--warning-color), #d97706);
      }

      .btn-danger {
        background: linear-gradient(135deg, var(--danger-color), #dc2626);
      }

      .btn-info {
        background: linear-gradient(135deg, #06b6d4, #0891b2);
      }

      .alert {
        border: none;
        border-radius: 15px;
        padding: 1.5rem;
        margin: 1.5rem 0;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      }

      .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid var(--border-color);
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
      }

      .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
      }

      #loading {
        padding: 3rem;
        text-align: center;
        color: var(--primary-color);
        font-size: 1.1rem;
      }

      .loading-spinner {
        display: inline-block;
        width: 40px;
        height: 40px;
        border: 4px solid var(--border-color);
        border-top: 4px solid var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 1rem;
      }

      @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
      }

      .stats-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        margin: 0 auto;
        max-width: 200px;
      }

      .stats-card:hover {
        transform: translateY(-5px);
      }

      .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
      }

      .stats-label {
        color: var(--dark-color);
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.5px;
      }

      .search-box {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
      }

      .pagination {
        justify-content: center;
        margin-top: 2rem;
      }

      .page-link {
        border: none;
        border-radius: 10px;
        margin: 0 0.25rem;
        color: var(--primary-color);
        font-weight: 500;
      }

      .page-link:hover {
        background: var(--primary-color);
        color: white;
      }

      .page-item.active .page-link {
        background: var(--primary-color);
        border-color: var(--primary-color);
      }

      footer {
        background: var(--dark-color);
        color: white;
        text-align: center;
        padding: 2rem;
        margin-top: 3rem;
      }

      /* Center alignment utilities */
      .center-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }

      .container-centered {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
      }

      /* Better spacing for cards */
      .stats-container {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
      }

      /* Improved table centering */
      .table-container {
        margin: 0 auto;
        max-width: 100%;
        overflow-x: auto;
      }

      @media (max-width: 768px) {
        #container {
          margin: 10px;
          border-radius: 15px;
        }

        header h1 {
          font-size: 1.8rem;
        }

        nav {
          padding: 1rem;
          justify-content: center;
          flex-direction: column;
          gap: 0.5rem;
        }

        nav a {
          padding: 0.5rem 1rem;
          font-size: 0.9rem;
        }

        #main {
          padding: 1rem;
        }

        .page-title {
          font-size: 1.5rem;
          flex-direction: column;
          gap: 0.5rem;
        }

        .table-responsive {
          border-radius: 15px;
        }

        .stats-card {
          max-width: 150px;
          padding: 1rem;
        }

        .stats-number {
          font-size: 2rem;
        }

        .search-box {
          padding: 1rem;
        }

        .search-box .row {
          text-align: center;
        }

        .search-box .col-md-2 {
          margin-top: 1rem;
        }
      }

      @media (max-width: 576px) {
        .stats-card {
          max-width: 120px;
          padding: 0.8rem;
        }

        .stats-number {
          font-size: 1.5rem;
        }

        .stats-label {
          font-size: 0.8rem;
        }

        .btn {
          padding: 0.4rem 1rem;
          font-size: 0.85rem;
        }

        .page-title {
          font-size: 1.3rem;
        }
      }
    </style>
  </head>
  <body>
    <div id="container">
      <header>
        <h1><i class="fas fa-newspaper"></i> Admin Dashboard</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9; font-size: 1.1rem;">Kelola artikel dan konten website</p>
      </header>
      <nav>
        <a href="<?= base_url('/');?>" class="<?= (current_url() == base_url('/')) ? 'active' : ''; ?>">
          <i class="fas fa-home"></i> Home
        </a>
        <a href="<?= base_url('/admin/artikel'); ?>" class="<?= (strpos(current_url(), '/admin/artikel') !== false) ? 'active' : ''; ?>">
          <i class="fas fa-tachometer-alt"></i> Dashboard Admin
        </a>
        <a href="<?= base_url('/artikel');?>" class="<?= (strpos(current_url(), '/artikel') !== false && strpos(current_url(), '/admin/artikel') === false) ? 'active' : ''; ?>">
          <i class="fas fa-newspaper"></i> Artikel
        </a>
        <a href="<?= base_url('/about');?>" class="<?= (strpos(current_url(), '/about') !== false) ? 'active' : ''; ?>">
          <i class="fas fa-info-circle"></i> About
        </a>
        <a href="<?= base_url('/contact');?>" class="<?= (strpos(current_url(), '/contact') !== false) ? 'active' : ''; ?>">
          <i class="fas fa-envelope"></i> Contact
        </a>

        <?php if (session()->get('logged_in')) : ?>
          <a href="<?= base_url('/user/logout'); ?>" style="background: rgba(239, 68, 68, 0.1); color: #ef4444;">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        <?php else: ?>
          <a href="<?= base_url('/user/login'); ?>" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
            <i class="fas fa-sign-in-alt"></i> Login
          </a>
        <?php endif; ?>
      </nav>
      <section id="wrapper">
        <section id="main">
