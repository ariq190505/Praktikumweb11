<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    use ResponseTrait;

    // GET /post
    public function index()
    {
        try {
            $model = new ArtikelModel();
            $data = $model->orderBy('id', 'DESC')->findAll();

            return $this->respond(['artikel' => $data], 200);
        } catch (\Exception $e) {
            // Handle database connection error
            if (strpos($e->getMessage(), 'No connection could be made') !== false) {
                return $this->respond([
                    'artikel' => [],
                    'error' => 'Database tidak terhubung',
                    'message' => 'MySQL tidak running. Silakan start MySQL di XAMPP Control Panel.',
                    'troubleshoot' => [
                        '1. Buka XAMPP Control Panel',
                        '2. Klik Start pada MySQL',
                        '3. Pastikan status MySQL menjadi hijau',
                        '4. Refresh halaman ini'
                    ]
                ], 200);
            }

            return $this->fail('Database error: ' . $e->getMessage());
        }
    }

    // POST /post
    // POST /post
    public function create()
    {
        $model = new ArtikelModel();

        // Debug: Log request details
        log_message('debug', 'POST request received');
        log_message('debug', 'Content-Type: ' . $this->request->getHeaderLine('Content-Type'));
        log_message('debug', 'POST data: ' . json_encode($this->request->getPost()));

        // Check if request has form data (either from multipart or regular POST)
        $hasFormData = $this->request->getPost('judul') !== null ||
                       $this->request->getFile('gambar') !== null ||
                       (strpos($this->request->getHeaderLine('Content-Type'), 'multipart/form-data') !== false);

        if ($hasFormData) {
            // Handle form data with file upload
            $judul = $this->request->getPost('judul') ?? '';
            $slug = url_title($judul, '-', true);

            // Check if slug already exists and make it unique
            $existingSlug = $model->where('slug', $slug)->first();
            if ($existingSlug) {
                $slug = $slug . '-' . time();
            }

            $data = [
                'judul'  => $judul,
                'isi'    => $this->request->getPost('isi') ?? '',
                'slug'   => $slug,
                'status' => $this->request->getPost('status') ?? 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            log_message('debug', 'Form data: ' . json_encode($data));

            // Handle file upload
            $file = $this->request->getFile('gambar');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Validate file type
                $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!in_array($file->getMimeType(), $allowedTypes)) {
                    return $this->fail('File harus berupa gambar (JPEG, PNG, GIF)');
                }

                // Validate file size (max 2MB)
                if ($file->getSize() > 2048000) {
                    return $this->fail('Ukuran file maksimal 2MB');
                }

                // Generate unique filename
                $fileName = $file->getRandomName();

                // Move file to public/gambar directory
                if ($file->move(FCPATH . 'gambar', $fileName)) {
                    $data['gambar'] = $fileName;
                } else {
                    return $this->fail('Gagal mengupload gambar');
                }
            }

        } else {
            // Handle JSON data (existing functionality)
            $json = $this->request->getJSON();

            if (!$json) {
                return $this->fail('Data tidak valid');
            }

            $judul = $json->judul ?? '';
            $slug = url_title($judul, '-', true);

            // Check if slug already exists and make it unique
            $existingSlug = $model->where('slug', $slug)->first();
            if ($existingSlug) {
                $slug = $slug . '-' . time();
            }

            $data = [
                'judul'  => $judul,
                'isi'    => $json->isi ?? '',
                'slug'   => $slug,
                'status' => $json->status ?? 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        try {
            if ($model->insert($data)) {
                return $this->respondCreated([
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data artikel berhasil ditambahkan.'
                    ],
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            // Handle database connection error
            if (strpos($e->getMessage(), 'No connection could be made') !== false) {
                return $this->respond([
                    'status' => 500,
                    'error' => 'Database tidak terhubung',
                    'message' => 'MySQL tidak running. Silakan start MySQL di XAMPP Control Panel.',
                    'troubleshoot' => [
                        '1. Buka XAMPP Control Panel',
                        '2. Klik Start pada MySQL',
                        '3. Pastikan status MySQL menjadi hijau',
                        '4. Coba simpan lagi'
                    ]
                ], 500);
            }

            return $this->fail('Database error: ' . $e->getMessage());
        }

        // Get validation errors if any
        $errors = $model->errors();
        if (!empty($errors)) {
            return $this->fail('Validation errors: ' . implode(', ', $errors));
        }

        return $this->fail('Gagal menambahkan artikel.');
    }


    // GET /post/{id}
    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->find($id);

        if ($data) {
            return $this->respond($data, 200);
        }

        return $this->failNotFound('Data tidak ditemukan.');
    }


    public function update($id = null)
    {
        $model = new ArtikelModel();

        // Check if article exists
        $existingArticle = $model->find($id);
        if (!$existingArticle) {
            return $this->failNotFound('Data tidak ditemukan untuk diubah.');
        }

        // Check if request has form data (either from multipart or regular POST)
        $hasFormData = $this->request->getPost('judul') !== null ||
                       $this->request->getFile('gambar') !== null ||
                       (strpos($this->request->getHeaderLine('Content-Type'), 'multipart/form-data') !== false);

        if ($hasFormData) {
            // Handle form data with file upload
            $data = [
                'judul'  => $this->request->getPost('judul') ?? '',
                'isi'    => $this->request->getPost('isi') ?? '',
                'status' => $this->request->getPost('status') ?? 0,
            ];

            // Handle file upload
            $file = $this->request->getFile('gambar');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Validate file type
                $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!in_array($file->getMimeType(), $allowedTypes)) {
                    return $this->fail('File harus berupa gambar (JPEG, PNG, GIF)');
                }

                // Validate file size (max 2MB)
                if ($file->getSize() > 2048000) {
                    return $this->fail('Ukuran file maksimal 2MB');
                }

                // Delete old image if exists
                if (!empty($existingArticle['gambar']) && file_exists(FCPATH . 'gambar/' . $existingArticle['gambar'])) {
                    unlink(FCPATH . 'gambar/' . $existingArticle['gambar']);
                }

                // Generate unique filename
                $fileName = $file->getRandomName();

                // Move file to public/gambar directory
                if ($file->move(FCPATH . 'gambar', $fileName)) {
                    $data['gambar'] = $fileName;
                } else {
                    return $this->fail('Gagal mengupload gambar');
                }
            }

        } else {
            // Handle JSON data (existing functionality)
            $json = $this->request->getJSON();

            if (!$json) {
                return $this->fail('Data tidak valid');
            }

            $data = [
                'judul'  => $json->judul ?? '',
                'isi'    => $json->isi ?? '',
                'status' => $json->status ?? 0,
            ];
        }

        if ($model->update($id, $data)) {
            return $this->respond([
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data artikel berhasil diubah.'
                ],
                'data' => $data
            ]);
        }

        return $this->fail('Gagal mengubah artikel.');
    }


    // DELETE /post/{id}
    public function delete($id = null)
    {
        $model = new ArtikelModel();

        $article = $model->find($id);
        if ($article) {
            // Delete associated image file if exists
            if (!empty($article['gambar']) && file_exists(FCPATH . 'gambar/' . $article['gambar'])) {
                unlink(FCPATH . 'gambar/' . $article['gambar']);
            }

            $model->delete($id);
            return $this->respondDeleted([
                'status'  => 200,
                'error'   => null,
                'messages' => [
                    'success' => 'Data artikel berhasil dihapus.'
                ]
            ]);
        }

        return $this->failNotFound('Data tidak ditemukan untuk dihapus.');
    }
}