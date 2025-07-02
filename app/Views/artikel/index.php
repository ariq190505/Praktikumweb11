<?= $this->extend('layout/simple'); ?>

<?= $this->section('content'); ?>
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: 36px; font-weight: 600; color: #111827;"><?= esc($title); ?></h1>
        <p style="color: #6b7280;">Temukan artikel menarik dan informatif dari kami.</p>
    </div>

    <?php if (!empty($artikel)): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <?php foreach ($artikel as $row): ?>
                <div class="article-card" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='translateY(0)';">
                    <?php if (!empty($row['gambar'])): ?>
                        <img src="<?= base_url('/gambar/' . $row['gambar']); ?>" alt="<?= esc($row['judul']); ?>" style="width: 100%; height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div style="padding: 20px;">
                        <p style="color: #4f46e5; font-weight: 500; margin-bottom: 10px;"><?= esc($row['nama_kategori'] ?? 'N/A'); ?></p>
                        <h2 style="font-size: 20px; font-weight: 600; margin-bottom: 10px;">
                            <a href="<?= base_url('/artikel/' . ($row['slug'] ?: 'artikel-' . $row['id'])); ?>" style="text-decoration: none; color: #111827;">
                                <?= esc($row['judul']); ?>
                            </a>
                        </h2>
                        <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px;">
                            <?= date('d M Y', strtotime($row['created_at'] ?? date('Y-m-d'))); ?>
                        </p>
                        <p style="color: #374151;"><?= esc(substr(strip_tags($row['isi'] ?? ''), 0, 100)); ?>...</p>
                        <a href="<?= base_url('/artikel/' . ($row['slug'] ?: 'artikel-' . $row['id'])); ?>" style="color: #4f46e5; text-decoration: none; font-weight: 500;">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="text-align: center;">Belum ada artikel.</p>
    <?php endif; ?>

<?= $this->endSection(); ?>
