<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_model; //Manggil model yg dibuat

class Login extends Controller
{
    // index
    public function index()
    {
        $data = ['title' => 'Halaman Login'];
        return view('login/index', $data);
    }

    //proses_login
    public function proses_login(Request $request)
    {
        $m_user = new User_model();
        $username = $request->username;
        $password = $request->password;
        $check_login = $m_user->login($username, $password);
        //proses_login
        if ($check_login) {
            //jika ada usernya
            //set session
            $request->session()->put('id_user', $check_login->id_user);
            $request->session()->put('nama', $check_login->nama);
            $request->session()->put('username', $check_login->username);
            $request->session()->put('akses_level', $check_login->akses_level);
            //end set session
            return redirect('admin/dasbor')->with(['sukses' => 'Sukses Login.']);
        } else {
            //jika tidak ada usernya
            return redirect('login?pesan=error')->with(['warning' => 'username atau password salah']);
        }
        //end proses login
    }

    //lupa
    public function lupa()
    {
        $data = ['title' => 'Lupa Password'];
        return view('login/lupa', $data);
    }

    //logout
    public function logout()
    {
        Session()->forget('id_user');
        Session()->forget('nama');
        Session()->forget('username');
        Session()->forget('akses_level');
        return redirect('login?pesan=sukses')->with(['sukses' => 'Anda berhasil logout.']);
    }
}
