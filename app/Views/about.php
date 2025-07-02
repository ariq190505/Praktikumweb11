<?= $this->extend('layout/simple'); ?>

<?= $this->section('content'); ?>
    <h1><?= esc($title); ?></h1>
    <hr>
    <p><?= esc($content); ?></p>
<?= $this->endSection(); ?>
