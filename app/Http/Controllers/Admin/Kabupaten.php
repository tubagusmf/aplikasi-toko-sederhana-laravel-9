<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kabupaten_model; //Manggil model yg dibuat
use App\Models\Provinsi_model; //Manggil model yg dibuat
use Illuminate\Support\Facades\DB; //Load bawaan fungsi DB

class Kabupaten extends Controller
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

        $m_kabupaten = new Kabupaten_model();
        $kabupaten = $m_kabupaten->listing();
        $m_provinsi = new Provinsi_model();
        $provinsi = $m_provinsi->listing();
        $data = [
            'title' => 'Data Kabupaten',
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
            'content' => 'admin/kabupaten/index'
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

        $m_provinsi = new Provinsi_model();
        $data = [
            'title' => 'Tambah Kabupaten',
            'provinsi' => $m_provinsi->listing(),
            'content' => 'admin/kabupaten/tambah'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //edit
    public function edit($id_kabupaten)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_kabupaten = new Kabupaten_model();
        $m_provinsi = new Provinsi_model();
        $kabupaten = $m_kabupaten->detail($id_kabupaten);
        $provinsi = $m_provinsi->listing();
        $data = [
            'title' => 'Edit Kabupaten',
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
            'content' => 'admin/kabupaten/edit'
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
            'id_kabupaten'  => 'required|unique:kabupaten',
            'nama_kabupaten'  => 'required|unique:kabupaten'
        ]);

        DB::table('kabupaten')->insert([
            'id_kabupaten'  => $request->id_kabupaten,
            'id_provinsi'  => $request->id_provinsi,
            'nama_kabupaten'  => $request->nama_kabupaten,
            'aktif'  => $request->aktif,
            'latitude'  => $request->latitude,
            'longitude'  => $request->longitude,
            'keterangan'  => $request->keterangan,
            'json_data'  => $request->json_data,
            'coordinates'  => $request->coordinates
        ]);
        return redirect('admin/kabupaten')->with(['sukses' => "Data telah ditambah."]);
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
            'nama_kabupaten'  => 'required'
        ]);


        DB::table('kabupaten')->where('id_kabupaten', $request->id_kabupaten)->update([
            'id_kabupaten'  => $request->id_kabupaten,
            'id_provinsi'  => $request->id_provinsi,
            'nama_kabupaten'  => $request->nama_kabupaten,
            'aktif'  => $request->aktif,
            'latitude'  => $request->latitude,
            'longitude'  => $request->longitude,
            'keterangan'  => $request->keterangan,
            'json_data'  => $request->json_data,
            'coordinates'  => $request->coordinates
        ]);
        return redirect('admin/kabupaten')->with(['sukses' => "Data kabupaten telah diganti."]);
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

        $id_kabupaten = $request->id_kabupaten;
        //chek kalau belum milih data
        if (empty($id_kabupaten)) {
            return redirect('admin/kabupaten')->with(['warning' => "Anda belum memilih kabupaten"]);
        }

        //proses
        if (isset($_POST['hapus'])) {
            //proses hapus kabupaten
            for ($i = 0; $i < sizeof($id_kabupaten); $i++) {
                DB::table('kabupaten')->where('id_kabupaten', $id_kabupaten[$i])->delete();
            }
            return redirect('admin/kabupaten')->with(['sukses' => "Data telah dihapus"]);
        } elseif (isset($_POST['update'])) {
            //proses update akses level kabupaten
            for ($i = 0; $i < sizeof($id_kabupaten); $i++) {
                DB::table('kabupaten')->where('id_kabupaten', $id_kabupaten[$i])->update([
                    'aktif' => $request->aktif
                ]);
            }
            return redirect('admin/kabupaten')->with(['sukses' => "Data telah diupdate"]);
        }
    }


    //delete
    public function delete($id_kabupaten)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        DB::table('kabupaten')->where('id_kabupaten', $id_kabupaten)->delete();
        return redirect('admin/kabupaten')->with(['sukses' => "Data kabupaten telah dihapus."]);
    }
}
