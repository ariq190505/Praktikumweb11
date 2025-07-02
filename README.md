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

## 🛠️ MVC Implementation

### 1. Membuat Model: `KategoriModel`
Buat model untuk tabel `kategori`.

![Screenshot 2025-07-02 205844](https://github.com/user-attachments/assets/dbb21495-0de0-495b-b867-5e624441a246)

### 2. Memodifikasi Model: `ArticleModel`
Tambahkan relasi ke `KategoriModel`.

![Screenshot 2025-07-02 205910](https://github.com/user-attachments/assets/08a98118-3401-4781-bab6-ae1fef06c6d4)


### 3. Memodifikasi Controller: `Artikel.php`
Ubah controller untuk mengambil data artikel beserta kategori.
<img width="695" alt="image" src="https://github.com/user-attachments/assets/46a4c449-d133-4917-9cab-d42f9d6cdd1b" />

![Screenshot 2025-07-02 212755](https://github.com/user-attachments/assets/a150fef5-aeb4-44b1-bbae-6929c176bb38)

![Screenshot 2025-07-02 212841](https://github.com/user-attachments/assets/eed97aa3-26b0-490d-bf18-5201c60dd3d2)


### 4. Memodifikasi Views
- **`view/artikel/index.php`**: Tampilkan nama kategori di halaman daftar artikel.
![Screenshot 2025-07-02 213115](https://github.com/user-attachments/assets/b32b2709-c0f1-4f72-8a7f-e95102147151)
- **`view/artikel/admin_index.php`**: Tampilkan kategori di halaman admin.
![Screenshot 2025-07-02 213230](https://github.com/user-attachments/assets/cec6801c-9eb2-4af7-a31a-0ddf556d474d)
![Screenshot 2025-07-02 213243](https://github.com/user-attachments/assets/611fba1e-3221-4c9f-89ec-fea0dd64e9d5)
- **`view/artikel/form_add.php`**: Tambahkan dropdown untuk memilih kategori saat menambah artikel.
![Screenshot 2025-07-02 213347](https://github.com/user-attachments/assets/e7f8ae84-1101-4937-8525-ff25bdd6d393)
- **`view/artikel/form_edit.php`**: Tambahkan dropdown untuk memilih kategori saat mengedit artikel.
![Screenshot 2025-07-02 213417](https://github.com/user-attachments/assets/2715dc2a-1751-4238-9e37-44d58785e13b)

## ✅ Testing Fitur
- **Menambah Artikel**: Pastikan kategori tersimpan dengan benar.
![Screenshot 2025-07-02 215156](https://github.com/user-attachments/assets/b44bd007-464f-480e-b224-9c5671046cf4)

![Screenshot 2025-07-02 215216](https://github.com/user-attachments/assets/e0c0bed4-2670-4a4e-941b-48e6a52377f5)
- **Mengedit Artikel**: Pastikan kategori dapat diubah.
- *** Sebelum Di Edit 
![Screenshot 2025-07-02 215357](https://github.com/user-attachments/assets/7f1b22fa-8d4a-4a0e-a35c-c8c988e81d4b)
- *** Sesudah Di Edit
![Screenshot 2025-07-02 215542](https://github.com/user-attachments/assets/b247e8e6-7cdd-4743-a0c8-f7a0aec92397)
- **Menghapus Artikel**: Pastikan artikel terhapus.
- *** Sebelum
![Screenshot 2025-07-02 215727](https://github.com/user-attachments/assets/f237eeeb-9cb3-4c88-9bb1-b458281a524b)
- *** Sesudah
![Screenshot 2025-07-02 215746](https://github.com/user-attachments/assets/a71d882a-0957-4738-8c07-eb26576766d5)
---

# ⚙️ Modul 8 & 9: AJAX, Pagination, dan Pencarian

## Membuat AJAX Controller
Controller ini menangani request data dinamis tanpa me-refresh halaman.

![Screenshot 2025-07-02 220030](https://github.com/user-attachments/assets/2db9034e-dc79-4ea4-bce2-777087ff5b12)

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

![Screenshot 2025-07-02 220538](https://github.com/user-attachments/assets/c09ca422-b9e5-444e-8a8d-ef24c1cab2af)

## Membuat REST Controller
Buat controller baru (`app/Controllers/Post.php`) yang berisi method untuk operasi CRUD melalui API.

![Screenshot 2025-07-02 220825](https://github.com/user-attachments/assets/6724c18f-5311-4ef2-ba20-2b7ea750f9a0)


**Methods:**
- `index()`: Menampilkan semua data (GET).
- `create()`: Menambah data baru (POST).
- `show($id)`: Menampilkan data spesifik (GET).
- `update($id)`: Mengubah data (PUT/PATCH).
- `delete($id)`: Menghapus data (DELETE).

## Membuat Routing REST API
Definisikan route untuk API di `app/Config/Routes.php`.
![image](https://github.com/user-attachments/assets/b347f10c-d8b7-4ac3-bd1e-28bf6e82da89)

## Testing REST API
Gunakan Postman untuk menguji setiap endpoint API yang telah dibuat.
- **GET** `http://localhost:8080/post`
- 
![Screenshot 2025-07-02 220426](https://github.com/user-attachments/assets/942288e8-ed29-48db-a6b1-fb125e7c7d74)

- **GET** `http://localhost:8080/post/2`
- 
![image](https://github.com/user-attachments/assets/4d57fd10-2393-4b7d-ad4c-b5387dfa2b32)

---

# ⚛️ Modul 11: Pengenalan Vue.js dan Axios

## Persiapan
Gunakan Vue.js dan Axios melalui CDN untuk pengembangan yang lebih cepat tanpa build tools.

**Libraries:**
- **Vue.js**: Untuk membuat komponen UI yang reaktif.
![image](https://github.com/user-attachments/assets/d89afcf5-38df-4f40-8b04-49a58f2c8fea)

- **Axios**: Untuk komunikasi dengan REST API.
![image](https://github.com/user-attachments/assets/dd5e4a69-d467-464c-abf9-f928df6fa213)


## Implementasi
- **`index.html`**: Struktur dasar halaman untuk menampilkan data.
![Screenshot 2025-07-02 221413](https://github.com/user-attachments/assets/112350a3-fffa-45f2-98de-7a140c402d92)
- **`apps.js`**: Logika Vue.js untuk mengambil data dari API menggunakan Axios dan menampilkannya di halaman.
![Screenshot 2025-07-02 221527](https://github.com/user-attachments/assets/20de0264-dacf-43bc-aba4-94b103b7abd8)
- **`style.css`**: Styling untuk tampilan.
![Screenshot 2025-07-02 221602](https://github.com/user-attachments/assets/f7aabd61-40d3-4620-9170-7b6b05298708)

## Hasil Output
Tampilan akhir akan menampilkan daftar artikel yang diambil dari REST API CodeIgniter dan dirender oleh Vue.js.
![Screenshot 2025-07-02 215727](https://github.com/user-attachments/assets/7eb26748-2f64-4705-8095-bd65bc881f23)

