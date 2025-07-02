<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Portal Berita'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            color: #1f2937;
        }
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .admin-header {
            background-color: #ffffff;
            padding: 15px 30px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .admin-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            color: #374151;
        }
        .admin-nav a {
            color: #4b5563;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .admin-nav a:hover {
            background-color: #eef2ff;
            color: #4f46e5;
        }
        .admin-nav a.active {
            background-color: #4f46e5;
            color: #ffffff;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            overflow: hidden; /* Ensures child elements conform to border radius */
        }
        .card-header {
            background-color: #f9fafb;
            padding: 15px 20px;
            border-bottom: 1px solid #e5e7eb;
            font-weight: 600;
        }
        .card-body {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background-color: #f9fafb;
        }
        .btn {
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-primary { background-color: #4f46e5; }
        .btn-danger { background-color: #ef4444; }
        .btn-success { background-color: #10b981; }
        .btn-secondary { background-color: #6b7280; }
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .form-control, .form-select {
            display: block;
            width: 100%;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .form-control:focus, .form-select:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
        }
        .d-grid {
            display: grid;
        }
        .gap-2 {
            gap: 0.5rem;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1><?= esc($title ?? 'Portal Berita'); ?></h1>
            <nav class="admin-nav">
                <a href="<?= base_url('/admin/artikel'); ?>">Artikel</a>
                <a href="<?= base_url('/user/logout'); ?>">Logout</a>
            </nav>
        </div>
        <div class="card">
            <?= $this->renderSection('content') ?>
        </div>
