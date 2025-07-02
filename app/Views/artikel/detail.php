<?= $this->include("template/public_header") ?>

<div class="article-detail-container">
    <!-- Article Header -->
    <div class="article-header">
        <div class="breadcrumb">
            <a href="<?= base_url('/'); ?>">
                <i class="fas fa-home"></i> Beranda
            </a>
            <span class="separator">/</span>
            <a href="<?= base_url('/artikel'); ?>">
                <i class="fas fa-newspaper"></i> Artikel
            </a>
            <span class="separator">/</span>
            <span class="current"><?= esc($artikel["judul"] ?? $artikel["title"] ?? 'Untitled'); ?></span>
        </div>

        <h1 class="article-title"><?= esc($artikel["judul"] ?? $artikel["title"] ?? 'Untitled'); ?></h1>

        <div class="article-meta">
            <div class="meta-item">
                <i class="fas fa-calendar-alt"></i>
                <span><?= date('d F Y', strtotime($artikel['created_at'] ?? date('Y-m-d'))); ?></span>
            </div>
            <div class="meta-item">
                <i class="fas fa-clock"></i>
                <span><?= ceil(str_word_count($artikel["isi"] ?? '') / 200); ?> menit baca</span>
            </div>
            <div class="meta-item">
                <i class="fas fa-tag"></i>
                <span><?= esc($artikel['nama_kategori'] ?? 'Uncategorized'); ?></span>
            </div>
        </div>
    </div>

    <!-- Article Image -->
    <?php if (!empty($artikel['gambar'])): ?>
        <div class="article-image-container">
            <img src="<?= base_url("/gambar/" . $artikel["gambar"]) ?>"
                 alt="<?= esc($artikel["judul"] ?? $artikel["title"]); ?>"
                 class="article-image">
            <div class="image-caption">
                <?= esc($artikel["judul"] ?? $artikel["title"]); ?>
            </div>
        </div>
    <?php elseif (!empty($artikel['image'])): ?>
        <div class="article-image-container">
            <img src="<?= base_url("/image/" . $artikel["image"]) ?>"
                 alt="<?= esc($artikel["slug"]); ?>"
                 class="article-image">
        </div>
    <?php endif; ?>

    <!-- Article Content -->
    <article class="article-content">
        <div class="content-body">
            <?= $artikel["isi"] ?? $artikel["content"] ?? 'Konten tidak tersedia.'; ?>
        </div>

        <!-- Article Actions -->
        <div class="article-actions">
            <div class="action-buttons">
                <button class="action-btn like-btn" title="Like artikel ini">
                    <i class="fas fa-heart"></i>
                    <span>Like</span>
                </button>
                <button class="action-btn share-btn" title="Bagikan artikel">
                    <i class="fas fa-share-alt"></i>
                    <span>Share</span>
                </button>
                <button class="action-btn bookmark-btn" title="Simpan artikel">
                    <i class="fas fa-bookmark"></i>
                    <span>Save</span>
                </button>
            </div>

            <div class="social-share">
                <span class="share-label">Bagikan:</span>
                <a href="#" class="social-btn facebook" onclick="shareToFacebook()">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-btn twitter" onclick="shareToTwitter()">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-btn whatsapp" onclick="shareToWhatsApp()">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="#" class="social-btn telegram" onclick="shareToTelegram()">
                    <i class="fab fa-telegram-plane"></i>
                </a>
            </div>
        </div>

        <!-- Navigation -->
        <div class="article-navigation">
            <a href="<?= base_url('/artikel'); ?>" class="nav-btn back-btn">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali ke Artikel</span>
            </a>

            <div class="nav-actions">
                <button class="nav-btn print-btn" onclick="window.print()">
                    <i class="fas fa-print"></i>
                    <span>Print</span>
                </button>
                <button class="nav-btn top-btn" onclick="scrollToTop()">
                    <i class="fas fa-arrow-up"></i>
                    <span>Ke Atas</span>
                </button>
            </div>
        </div>
    </article>

    <!-- Related Articles Section -->
    <div class="related-articles">
        <h3 class="section-title">
            <i class="fas fa-newspaper"></i>
            Artikel Terkait
        </h3>
        <div class="related-grid">
            <!-- Placeholder for related articles -->
            <div class="related-item">
                <div class="related-image">
                    <i class="fas fa-image"></i>
                </div>
                <div class="related-content">
                    <h4>Artikel Terkait 1</h4>
                    <p>Deskripsi singkat artikel terkait...</p>
                    <a href="#" class="related-link">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="related-item">
                <div class="related-image">
                    <i class="fas fa-image"></i>
                </div>
                <div class="related-content">
                    <h4>Artikel Terkait 2</h4>
                    <p>Deskripsi singkat artikel terkait...</p>
                    <a href="#" class="related-link">Baca Selengkapnya</a>
                </div>
            </div>
            <div class="related-item">
                <div class="related-image">
                    <i class="fas fa-image"></i>
                </div>
                <div class="related-content">
                    <h4>Artikel Terkait 3</h4>
                    <p>Deskripsi singkat artikel terkait...</p>
                    <a href="#" class="related-link">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include("template/public_footer") ?>
