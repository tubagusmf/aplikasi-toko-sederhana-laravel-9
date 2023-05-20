<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_model; //Manggil model yg dibuat
use Illuminate\Support\Facades\DB; //Load bawaan fungsi DB

class User extends Controller
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

        $m_user = new User_model();
        $user = $m_user->listing();
        $data = [
            'title' => 'User Administrator',
            'user' => $user,
            'content' => 'admin/user/index'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //tambah
    public function tambah()
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $data = [
            'title' => 'Tambah Administrator',
            'content' => 'admin/user/tambah'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //edit
    public function edit($id_user)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_user = new User_model();
        $user = $m_user->detail($id_user);
        $data = [
            'title' => 'Edit Administrator',
            'user' => $user,
            'content' => 'admin/user/edit'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //proses_tambah
    public function proses_tambah(Request $request)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        request()->validate([
            'nama'  => 'required',
            'email' => 'required|unique:users', //users = table db users
            'username' => 'required|unique:users',
            'password' => 'required|min:6|max:32',
        ]);

        DB::table('users')->insert([
            'nama'  => $request->nama,
            'email'  => $request->email,
            'username'  => $request->username,
            'password'  => sha1($request->password),
            'akses_level'  => $request->akses_level
        ]);
        return redirect('admin/user')->with(['sukses' => "Data telah ditambah."]);
    }

    //proses_edit
    public function proses_edit(Request $request)
    {

        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        request()->validate([
            'nama'  => 'required'
        ]);

        $password = $request->password;
        //check panjang password
        if (strlen($password) >= 6 && strlen($password) <= 32) { //jika karakter password lebih dari 6 dan kurang dari 32 karakter
            //edit dan ganti password
            DB::table('users')->where('id_user', $request->id_user)->update([
                'nama'  => $request->nama,
                'password'  => sha1($request->password),
                'akses_level'  => $request->akses_level
            ]);
            return redirect('admin/user')->with(['sukses' => "Data dan password user telah diganti."]);
        } else {
            DB::table('users')->where('id_user', $request->id_user)->update([
                'nama'  => $request->nama,
                'akses_level'  => $request->akses_level
            ]);
            return redirect('admin/user')->with(['sukses' => "Data user telah diganti."]);
        }
    }

    //proses
    public function proses(Request $request)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $id_user = $request->id_user;
        //chek kalau belum milih data
        if (empty($id_user)) {
            return redirect('admin/user')->with(['warning' => "Anda belum memilih user"]);
        }

        //proses
        if (isset($_POST['hapus'])) {
            //proses hapus user
            for ($i = 0; $i < sizeof($id_user); $i++) {
                DB::table('users')->where('id_user', $id_user[$i])->delete();
            }
            return redirect('admin/user')->with(['sukses' => "Data telah dihapus"]);
        } elseif (isset($_POST['update'])) {
            //proses update akses level user
            for ($i = 0; $i < sizeof($id_user); $i++) {
                DB::table('users')->where('id_user', $id_user[$i])->update([
                    'akses_level' => $request->akses_level
                ]);
            }
            return redirect('admin/user')->with(['sukses' => "Data telah diupdate"]);
        }
    }


    //delete
    public function delete($id_user)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        DB::table('users')->where('id_user', $id_user)->delete();
        return redirect('admin/user')->with(['sukses' => "Data user telah dihapus."]);
    }
}
