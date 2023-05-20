<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client_model; //Manggil model yg dibuat

class Signin extends Controller
{
    // index
    public function index()
    {
        $data = [
            'title' => 'Halaman Login Client',
            'content' => 'signin/index',
            'keywords' => 'Halaman Login Client',
            'description' => 'Halaman Login Client'
        ];
        return view('layout/wrapper', $data);
    }

    //proses_login
    public function proses_login(Request $request)
    {
        $m_client = new Client_model();
        $username = $request->email;
        $password = $request->password;
        $check_login = $m_client->login($username, $password);
        //proses_login
        if ($check_login) {
            //jika ada usernya
            //set session
            $request->session()->put('id_client', $check_login->id_client);
            $request->session()->put('nama_client', $check_login->nama_client);
            $request->session()->put('username_client', $check_login->email);
            //end set session
            return redirect('dasbor')->with(['sukses' => 'Sukses Login.']);
        } else {
            //jika tidak ada usernya
            return redirect('signin?pesan=error')->with(['warning' => 'username atau password salah']);
        }
        //end proses login
    }


    //logout
    public function logout()
    {
        Session()->forget('id_client');
        Session()->forget('nama_client');
        Session()->forget('username_client');
        return redirect('signin?pesan=sukses')->with(['sukses' => 'Anda berhasil logout.']);
    }
}
