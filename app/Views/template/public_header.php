<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'My Website'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            color: #1f2937;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }
        .main-header {
            background-color: #ffffff;
            padding: 15px 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .main-header:hover {
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        }
        .main-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            color: #374151;
        }
        .main-nav a {
            color: #4b5563;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .main-nav a:hover {
            background-color: #eef2ff;
            color: #4f46e5;
        }
        .main-nav a.active {
             background-color: #4f46e5;
             color: #ffffff;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
        }
    </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/artikel.css'); ?>">
</head>
<body>
    <div class="container">
        <header class="main-header">
            <h1>Portal Berita</h1>
            <nav class="main-nav">
                <a href="<?= base_url('/'); ?>">Home</a>
                <a href="<?= base_url('/artikel'); ?>">Artikel</a>
                <a href="<?= base_url('/about'); ?>">About</a>
                <a href="<?= base_url('/contact'); ?>">Contact</a>
                <a href="<?= base_url('/user/login'); ?>">Login</a>
            </nav>
        </header>
        <main class="content">
