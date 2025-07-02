<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= esc($title ?? 'Judul') ?></title>
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
  <div id="container">
    
    <?= $this->include('template/header') ?>

    <div id="content-wrapper">
      <section id="main">
        <?= $this->renderSection('content') ?>
      </section>

      <aside id="sidebar">
        <?= view_cell('App\\Cells\\ArtikelLatest::render', [
            'category' => $_GET['category'] ?? null,
        ]) ?>

        <div class="widget-box">
          <h3 class="title">Widget Header:</h3>
          <ul>
            <li><a href="#">href Link</a></li>
            <li><a href="#">href Link</a></li>
          </ul>
        </div>

        <div class="widget-box">
          <h3 class="title">Bio:</h3>
          <p>Ignorance brings peace, but wisdom bears weight.</p>
        </div>
      </aside>
    </div>

    <footer>
      <p>&copy; Universitas Pelita Bangsa - 2025.</p>
    </footer>

  </div>
</body>
</html>
