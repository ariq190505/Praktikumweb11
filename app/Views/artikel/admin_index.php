<?= $this->include('template/admin_header'); ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Daftar Artikel</h2>
    <a href="<?= base_url('/admin/artikel/add'); ?>" class="btn btn-success">Tambah Artikel</a>
</div>

<form method="get" style="margin-bottom: 20px;">
    <input type="text" name="q" value="<?= esc($q); ?>" placeholder="Cari judul...">
    <select name="kategori_id">
        <option value="">Semua Kategori</option>
        <?php if (isset($kategori) && is_array($kategori)): ?>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= esc($k['id_kategori']); ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= esc($k['nama_kategori']); ?>
                </option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
    <button type="submit" class="btn btn-primary">Cari</button>
</form>

<?php if (isset($error)): ?>
    <div style="color: red; padding: 10px; border: 1px solid red; border-radius: 5px;">
        <h4><?= esc($error); ?></h4>
        <p><?= esc($message); ?></p>
    </div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($artikel)): ?>
                <?php foreach ($artikel as $item): ?>
                    <tr>
                        <td><?= esc($item['id']); ?></td>
                        <td><?= esc($item['judul']); ?></td>
                        <td><?= esc($item['nama_kategori'] ?? 'N/A'); ?></td>
                        <td><?= $item['status'] ? 'Published' : 'Draft'; ?></td>
                        <td>
                            <a href="/admin/artikel/edit/<?= $item['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="/admin/artikel/delete/<?= $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada artikel.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($pager): ?>
        <div class="pagination" style="margin-top: 20px;">
            <?= $pager->links(); ?>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?= $this->include('template/admin_footer'); ?>
