<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class Dasbor extends Controller
{

    //index
    public function index()
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $data = [
            'title' => 'Dashboard Administrator',
            'content' => 'admin/dasbor/index'
        ];

        return view('admin/layout/wrapper', $data);
    }
}
