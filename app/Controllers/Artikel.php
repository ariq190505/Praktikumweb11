<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';

        try {
            $model = new ArtikelModel();

            // Get articles with category information
            $builder = $model->table('artikel')
                ->select('artikel.*, kategori.nama_kategori')
                ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'LEFT')
                ->where('artikel.status', 1) // Only published articles
                ->orderBy('artikel.created_at', 'DESC');

            $artikel = $builder->findAll();

        } catch (\Exception $e) {
            // Handle database error gracefully
            $artikel = [];
            log_message('error', 'Error loading articles: ' . $e->getMessage());
        }

        return view('artikel/index', compact('artikel', 'title'));
    }

    public function admin_index()
    {
        $title = 'Daftar Artikel (Admin)';
        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $page = $this->request->getVar('page') ?? 1;

        try {
            $model = new ArtikelModel();

            // Build query dengan error handling
            $builder = $model->table('artikel')
                ->select('artikel.*, kategori.nama_kategori')
                ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'LEFT');

            if ($q != '') {
                $builder->like('artikel.judul', $q);
            }
            if ($kategori_id != '') {
                $builder->where('artikel.id_kategori', $kategori_id);
            }

            $artikel = $builder->orderBy('artikel.id', 'DESC')->paginate(10, 'default', $page);
            $pager = $model->pager;

            $data = [
                'title' => $title,
                'q' => $q,
                'kategori_id' => $kategori_id,
                'artikel' => $artikel,
                'pager' => $pager,
                'error' => null
            ];

            try {
                $kategoriModel = new KategoriModel();
                $data['kategori'] = $kategoriModel->findAll();
            } catch (\Exception $e) {
                // Jika kategori gagal dimuat, buat array kosong
                $data['kategori'] = [];
            }
            return view('artikel/admin_index', $data);

        } catch (\Exception $e) {
            // Handle database connection error
            $data = [
                'title' => $title,
                'q' => $q,
                'kategori_id' => $kategori_id,
                'artikel' => [],
                'pager' => null,
                'kategori' => [],
                'error' => 'Database tidak terhubung',
                'message' => 'MySQL tidak running. Silakan start MySQL di XAMPP Control Panel.',
            ];
            return view('artikel/admin_index', $data);
        }
    }

    public function add()
    {
        $validationRules = [
            'judul' => 'required',
            'id_kategori' => 'required|integer',
            'gambar' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,2048]',
        ];

        if ($this->request->getMethod() == 'post' && $this->validate($validationRules)) {
            $model = new ArtikelModel();

            // Generate unique slug
            $judul = $this->request->getPost('judul');
            $slug = url_title($judul, '-', true);

            // Check if slug already exists and make it unique
            $existingSlug = $model->where('slug', $slug)->first();
            if ($existingSlug) {
                $slug = $slug . '-' . time();
            }

            $data = [
                'judul' => $judul,
                'isi' => $this->request->getPost('isi'),
                'slug' => $slug,
                'id_kategori' => $this->request->getPost('id_kategori'),
                'status' => $this->request->getPost('status') ?? 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Handle file upload
            $gambar = $this->request->getFile('gambar');
            if ($gambar->isValid() && !$gambar->hasMoved()) {
                $newName = $gambar->getRandomName();
                $gambar->move('gambar', $newName);
                $data['gambar'] = $newName;
            }

            if ($model->insert($data)) {
                session()->setFlashdata('success', 'Artikel berhasil ditambahkan.');
            } else {
                session()->setFlashdata('error', 'Gagal menambahkan artikel.');
            }
            return redirect()->to('/admin/artikel');
        } else {
            $kategoriModel = new KategoriModel();
            $data['kategori'] = $kategoriModel->findAll();
            $data['title'] = "Tambah Artikel";
            return view('artikel/admin_form_add', $data);
        }
    }

    public function edit($id)
    {
        $model = new ArtikelModel();

        if ($this->request->getMethod() == 'post' && $this->validate([
            'judul' => 'required',
            'id_kategori' => 'required|integer'
        ])) {
            $model->update($id, [
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'id_kategori' => $this->request->getPost('id_kategori')
            ]);
            return redirect()->to('/admin/artikel');
        } else {
            $data['artikel'] = $model->find($id);
            $kategoriModel = new KategoriModel();
            $data['kategori'] = $kategoriModel->findAll();
            $data['title'] = "Edit Artikel";
            return view('artikel/form_edit', $data);
        }
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        return redirect()->to('/admin/artikel');
    }

    public function view($slug)
    {
        try {
            $model = new ArtikelModel();

            // Get article with category information
            $builder = $model->table('artikel')
                ->select('artikel.*, kategori.nama_kategori')
                ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'LEFT')
                ->where('artikel.status', 1); // Only published articles

            // Try to find by slug first
            $data['artikel'] = $builder->where('artikel.slug', $slug)->first();

            // If not found by slug, try to find by ID (fallback for artikel-{id} format)
            if (empty($data['artikel']) && strpos($slug, 'artikel-') === 0) {
                $id = str_replace('artikel-', '', $slug);
                if (is_numeric($id)) {
                    $data['artikel'] = $builder->where('artikel.id', $id)->first();
                }
            }

            if (empty($data['artikel'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan.');
            }

            $data['title'] = $data['artikel']['judul'];

        } catch (\CodeIgniter\Exceptions\PageNotFoundException $e) {
            throw $e; // Re-throw page not found
        } catch (\Exception $e) {
            log_message('error', 'Error loading article: ' . $e->getMessage());
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak dapat dimuat.');
        }

        return view('artikel/detail', $data);
    }
}
