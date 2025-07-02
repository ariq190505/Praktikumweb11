<?= $this->extend('layout/simple'); ?>

<?= $this->section('content'); ?>
    <div class="welcome-banner" style="background: linear-gradient(135deg, #3b82f6, #6366f1); color: white; padding: 80px 20px; text-align: center; border-radius: 12px; margin-bottom: 40px;">
        <h1 style="font-size: 48px; font-weight: 700; margin: 0;"><?= esc($title); ?></h1>
        <p style="font-size: 18px; opacity: 0.9; margin-top: 10px; max-width: 600px; margin-left: auto; margin-right: auto;">
            Temukan berita dan artikel terbaru dari berbagai kategori. Kami menyajikan informasi yang akurat dan terpercaya untuk Anda.
        </p>
        <div style="margin-top: 30px;">
            <a href="<?= base_url('/artikel'); ?>" style="background-color: white; color: #3b82f6; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 0 10px; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)';" onmouseout="this.style.transform='translateY(0)';">Jelajahi Artikel</a>
            <a href="<?= base_url('/about'); ?>" style="background-color: transparent; color: white; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 0 10px; border: 2px solid white; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.1)';" onmouseout="this.style.backgroundColor='transparent';">Tentang Kami</a>
        </div>
    </div>

    <div style="text-align: center; margin-bottom: 40px;">
        <form method="get" style="display: flex; justify-content: center; align-items: center; gap: 10px;">
            <input type="text" name="q" value="<?= esc($q ?? ''); ?>" placeholder="Cari artikel..." style="padding: 10px; border-radius: 8px; border: 1px solid #d1d5db; width: 300px;">
            <select name="kategori_id" style="padding: 10px; border-radius: 8px; border: 1px solid #d1d5db;">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= esc($k['id_kategori']); ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                        <?= esc($k['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" style="padding: 10px 20px; border-radius: 8px; border: none; background-color: #3b82f6; color: white; cursor: pointer;">Cari</button>
        </form>
    </div>

    <h2 style="font-size: 32px; font-weight: 600; color: #111827; text-align: center; margin-bottom: 40px;">Artikel Terbaru</h2>

    <?php if (!empty($artikel)): ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <?php foreach ($artikel as $row): ?>
                <div class="article-card" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s;" onmouseover="this.style.transform='translateY(-5px)';" onmouseout="this.style.transform='translateY(0)';">
                    <?php if (!empty($row['gambar'])): ?>
                        <img src="<?= base_url('/gambar/' . $row['gambar']); ?>" alt="<?= esc($row['judul']); ?>" style="width: 100%; height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div style="padding: 20px;">
                        <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 10px;">
                            <a href="<?= base_url('/artikel/' . ($row['slug'] ?: 'artikel-' . $row['id'])); ?>" style="text-decoration: none; color: #111827;">
                                <?= esc($row['judul']); ?>
                            </a>
                        </h3>
                        <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px;">
                            <?= date('d M Y', strtotime($row['created_at'] ?? date('Y-m-d'))); ?>
                        </p>
                        <a href="<?= base_url('/artikel/' . ($row['slug'] ?: 'artikel-' . $row['id'])); ?>" style="color: #4f46e5; text-decoration: none; font-weight: 500;">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p style="text-align: center;">Tidak ada artikel yang cocok dengan pencarian Anda.</p>
    <?php endif; ?>

<?= $this->endSection(); ?>
