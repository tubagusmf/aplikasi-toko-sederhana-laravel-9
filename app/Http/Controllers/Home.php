<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konfigurasi_model;

class Home extends Controller
{
    //index
    public function index()
    {
        $m_site = new Konfigurasi_model();
        $site = $m_site->listing();

        $data = [
            'title' => $site->namaweb . ' | ' . $site->tagline,
            'keywords' => $site->keywords,
            'description' => $site->deskripsi,
            'content' => 'home/index'
        ];

        return view('layout/wrapper', $data);
    }

    //kontak
    public function kontak()
    {
        $m_site = new Konfigurasi_model();
        $site = $m_site->listing();

        $data = [
            'title' => 'Kontak Kami',
            'keywords' => $site->keywords,
            'description' => $site->deskripsi,
            'content' => 'home/kontak'
        ];

        return view('layout/wrapper', $data);
    }

    //about
    public function about()
    {
        $m_site = new Konfigurasi_model();
        $site = $m_site->listing();

        $data = [
            'title' => 'About Us',
            'keywords' => $site->keywords,
            'description' => $site->deskripsi,
            'content' => 'home/about'
        ];

        return view('layout/wrapper', $data);
    }

    //features
    public function features()
    {
        $m_site = new Konfigurasi_model();
        $site = $m_site->listing();

        $data = [
            'title' => 'Our Features',
            'keywords' => $site->keywords,
            'description' => $site->deskripsi,
            'content' => 'home/features'
        ];

        return view('layout/wrapper', $data);
    }

    //gallery
    public function gallery()
    {
        $data = [
            'title' => 'Our Gallery',
            'content' => 'home/gallery'
        ];

        return view('layout/wrapper', $data);
    }

    //team
    public function team()
    {
        $data = [
            'title' => 'Our Team',
            'content' => 'home/team'
        ];

        return view('layout/wrapper', $data);
    }

    //pricing page updated
    public function pricing()
    {
        $data = [
            'title' => 'Our Pricing',
            'content' => 'home/pricing'
        ];

        return view('layout/wrapper', $data);
    }

    // oops for 4.4 patch
    public function oops()
    {
        $m_site = new Konfigurasi_model();
        $site   = $m_site->listing();

        $data = [
            'title'     => 'Our Pricing',
            'keywords'      => $site->keywords,
            'description'   => $site->deskripsi,
            'content'   => 'home/pricing'
        ];
        return view('layout/wrapper', $data);
    }
}
