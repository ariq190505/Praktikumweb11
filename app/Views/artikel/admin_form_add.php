<?= $this->extend('template/admin_header'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mb-4"><?= esc($title); ?></h2>
    <div class="card">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="judul" class="form-label">Judul Artikel</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul artikel..." required>
                </div>

                <div class="mb-4">
                    <label for="isi" class="form-label">Isi Artikel</label>
                    <textarea name="isi" id="isi" class="form-control" placeholder="Tulis konten artikel di sini..."></textarea>
                </div>

                <div class="mb-4">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select name="id_kategori" id="id_kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= esc($k['id_kategori']); ?>"><?= esc($k['nama_kategori']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" onchange="previewImage()">
                    <small class="form-text text-muted">Pilih file gambar untuk artikel (opsional)</small>
                    <img id="image-preview" src="" alt="Image Preview" class="img-fluid mt-2" style="display: none; max-height: 200px;">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('/admin/artikel'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<script>
    tinymce.init({
        selector: '#isi',
        height: 300,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });

    function previewImage() {
        const input = document.getElementById('gambar');
        const preview = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
