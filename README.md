# Praktikum 7-11 - Pemrograman Website 2

## 👤 Profil Mahasiswa

| Atribut | Keterangan |
| --- | --- |
| **Nama** | Ariq ibtihal |
| **NIM** | 312310446 |
| **Kelas** | TI.23.A.5 |
| **Mata Kuliah** | Pemrograman Website 2 |
| **Praktikum** | 7 s/d 11 |

---

# 🧱 Modul 7: Relasi Tabel Artikel dan Kategori

## Membuat Tabel Kategori
Tabel `kategori` digunakan untuk mengelompokkan artikel.

| Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| id | INT (auto increment) | Primary Key |
| nama | VARCHAR(100) | Nama kategori |
| slug | VARCHAR(100) | Slug URL kategori, harus unik |
| created_at | DATETIME | Waktu dibuat otomatis |
| updated_at | DATETIME | Waktu diperbarui otomatis jika ada update |

**Query SQL:**
```sql
CREATE TABLE kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```
<!-- Sisipkan gambar hasil query SQL di sini -->

## 🛠️ MVC Implementation

### 1. Membuat Model: `KategoriModel`
Buat model untuk tabel `kategori`.
<!-- Sisipkan gambar KategoriModel.php di sini -->

### 2. Memodifikasi Model: `ArticleModel`
Tambahkan relasi ke `KategoriModel`.
<!-- Sisipkan gambar modifikasi ArticleModel.php di sini -->

### 3. Memodifikasi Controller: `Artikel.php`
Ubah controller untuk mengambil data artikel beserta kategori.
<!-- Sisipkan gambar modifikasi controller Artikel.php di sini -->

### 4. Memodifikasi Views
- **`view/artikel/index.php`**: Tampilkan nama kategori di halaman daftar artikel.
<!-- Sisipkan gambar view/artikel/index.php di sini -->
- **`view/artikel/admin_index.php`**: Tampilkan kategori di halaman admin.
<!-- Sisipkan gambar view/artikel/admin_index.php di sini -->
- **`view/artikel/form_add.php`**: Tambahkan dropdown untuk memilih kategori saat menambah artikel.
<!-- Sisipkan gambar view/artikel/form_add.php di sini -->
- **`view/artikel/form_edit.php`**: Tambahkan dropdown untuk memilih kategori saat mengedit artikel.
<!-- Sisipkan gambar view/artikel/form_edit.php di sini -->

## ✅ Testing Fitur
- **Menambah Artikel**: Pastikan kategori tersimpan dengan benar.
<!-- Sisipkan gambar testing tambah artikel di sini -->
- **Mengedit Artikel**: Pastikan kategori dapat diubah.
<!-- Sisipkan gambar testing edit artikel di sini -->
- **Menghapus Artikel**: Pastikan artikel terhapus.
<!-- Sisipkan gambar testing hapus artikel (sebelum dan sesudah) di sini -->

---

# ⚙️ Modul 8 & 9: AJAX, Pagination, dan Pencarian

## Membuat AJAX Controller
Controller ini menangani request data dinamis tanpa me-refresh halaman.
<!-- Sisipkan gambar AJAX Controller di sini -->

## Modifikasi Controller Artikel
Ubah method `admin_index()` untuk mengembalikan JSON jika request adalah AJAX. Tambahkan logika untuk pagination dan pencarian.

```php
public function admin_index()
{
    $model = new \App\Models\ArticleModel();
    $data['artikel'] = $model->getArtikelWithKategori()->findAll();

    if ($this->request->isAJAX()) {
        return $this->response->setJSON($data['artikel']);
    }

    return view('artikel/admin_index', $data);
}
```

## Modifikasi View `admin_index.php`
Gunakan jQuery untuk mengambil dan menampilkan data artikel dan pagination melalui AJAX.

```html
<div id="article-container"></div>
<div id="pagination-container"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
  // ... kode AJAX untuk fetch, render, search, dan filter ...
});
</script>
```
<!-- Sisipkan gambar hasil modifikasi view admin_index.php dengan AJAX di sini -->

## Tugas
- Implementasikan fitur sorting (berdasarkan ID, Judul, Kategori) dengan AJAX.
<!-- Sisipkan gambar hasil sorting berdasarkan ID, Judul, dan Kategori di sini -->

---

# 📡 Modul 10: REST API dengan CodeIgniter 4

## Persiapan
Gunakan REST Client seperti **Postman** untuk melakukan testing REST API.
<!-- Sisipkan gambar aplikasi Postman di sini -->

## Membuat REST Controller
Buat controller baru (`app/Controllers/Post.php`) yang berisi method untuk operasi CRUD melalui API.
<!-- Sisipkan gambar file PostController.php di sini -->

**Methods:**
- `index()`: Menampilkan semua data (GET).
- `create()`: Menambah data baru (POST).
- `show($id)`: Menampilkan data spesifik (GET).
- `update($id)`: Mengubah data (PUT/PATCH).
- `delete($id)`: Menghapus data (DELETE).

## Membuat Routing REST API
Definisikan route untuk API di `app/Config/Routes.php`.
<!-- Sisipkan gambar routing API di sini -->

## Testing REST API
Gunakan Postman untuk menguji setiap endpoint API yang telah dibuat.
- **GET** `http://localhost:8080/post`
<!-- Sisipkan gambar testing GET all di Postman di sini -->
- **GET** `http://localhost:8080/post/2`
<!-- Sisipkan gambar testing GET by ID di Postman di sini -->

---

# ⚛️ Modul 11: Pengenalan Vue.js dan Axios

## Persiapan
Gunakan Vue.js dan Axios melalui CDN untuk pengembangan yang lebih cepat tanpa build tools.

**Libraries:**
- **Vue.js**: Untuk membuat komponen UI yang reaktif.
<!-- Sisipkan gambar CDN Vue.js di sini -->
- **Axios**: Untuk komunikasi dengan REST API.
<!-- Sisipkan gambar CDN Axios di sini -->

## Implementasi
- **`index.html`**: Struktur dasar halaman untuk menampilkan data.
<!-- Sisipkan gambar kode index.html di sini -->
- **`apps.js`**: Logika Vue.js untuk mengambil data dari API menggunakan Axios dan menampilkannya di halaman.
<!-- Sisipkan gambar kode apps.js di sini -->
- **`style.css`**: Styling untuk tampilan.
<!-- Sisipkan gambar kode style.css di sini -->

## Hasil Output
Tampilan akhir akan menampilkan daftar artikel yang diambil dari REST API CodeIgniter dan dirender oleh Vue.js.
<!-- Sisipkan gambar hasil output akhir di sini -->
