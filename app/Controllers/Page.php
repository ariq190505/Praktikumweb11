<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Page extends BaseController
{
    public function home()
    {
        $artikelModel = new ArtikelModel();
        $kategoriModel = new KategoriModel();

        $kategori_id = $this->request->getVar('kategori_id');
        $q = $this->request->getVar('q');

        $artikel = $artikelModel->orderBy('created_at', 'DESC');

        if ($kategori_id) {
            $artikel->where('id_kategori', $kategori_id);
        }
        if ($q) {
            $artikel->like('judul', $q);
        }

        $data = [
            'title'       => 'Selamat Datang di Portal Berita',
            'content'     => 'Berita terkini dan terupdate.',
            'artikel'     => $artikel->limit(10)->findAll(),
            'kategori'    => $kategoriModel->findAll(),
            'kategori_id' => $kategori_id,
            'q'           => $q,
        ];
        return view('home', $data);
    }

    public function about()
    {
        return view('about', [
            'title'   => 'About Us',
            'content' => 'Learn more about our mission, values, and the people behind our work.'
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'title'   => 'Contact Us',
            'content' => 'Have any questions? Feel free to reach out, and we\'ll be happy to assist you.'
        ]);
    }

    public function faqs()
    {
        return view('faqs', [
            'title'   => 'FAQs',
            'content' => 'Find answers to common questions and get the support you need.'
        ]);
    }

    public function tos()
    {
        return view('tos', [
            'title'   => 'Terms of Service',
            'content' => 'Please read our terms and conditions carefully to understand how we operate.'
        ]);
    }
}
