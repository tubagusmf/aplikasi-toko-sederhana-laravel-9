<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi_model; //Manggil model yg dibuat
use Illuminate\Support\Facades\DB; //Load bawaan fungsi DB

class Provinsi extends Controller
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

        $m_provinsi = new Provinsi_model();
        $provinsi = $m_provinsi->listing();
        $data = [
            'title' => 'Data Provinsi',
            'provinsi' => $provinsi,
            'content' => 'admin/provinsi/index'
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
            'content' => 'admin/provinsi/tambah'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //edit
    public function edit($id_provinsi)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_provinsi = new Provinsi_model();
        $provinsi = $m_provinsi->detail($id_provinsi);
        $data = [
            'title' => 'Edit Provinsi',
            'provinsi' => $provinsi,
            'content' => 'admin/provinsi/edit'
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
            'id_provinsi'  => 'required|unique:provinsi',
            'nama_provinsi'  => 'required|unique:provinsi'
        ]);

        DB::table('provinsi')->insert([
            'id_provinsi'  => $request->id_provinsi,
            'nama_provinsi'  => $request->nama_provinsi,
            'latitude'  => $request->latitude,
            'longitude'  => $request->longitude,
            'keterangan'  => $request->keterangan,
            'json_data'  => $request->json_data,
            'coordinates'  => $request->coordinates,
            'kode_provinsi'  => $request->kode_provinsi,
            'kode_highmap'  => $request->kode_highmap,
            'name_highmap'  => $request->name_highmap,
            'nomor_highmap'  => $request->nomor_highmap,
            'aktif'  => $request->aktif,
        ]);
        return redirect('admin/provinsi')->with(['sukses' => "Data telah ditambah."]);
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
            'nama_provinsi'  => 'required'
        ]);


        DB::table('provinsi')->where('id_provinsi', $request->id_provinsi)->update([
            'id_provinsi'  => $request->id_provinsi,
            'nama_provinsi'  => $request->nama_provinsi,
            'latitude'  => $request->latitude,
            'longitude'  => $request->longitude,
            'keterangan'  => $request->keterangan,
            'json_data'  => $request->json_data,
            'coordinates'  => $request->coordinates,
            'kode_provinsi'  => $request->kode_provinsi,
            'kode_highmap'  => $request->kode_highmap,
            'name_highmap'  => $request->name_highmap,
            'nomor_highmap'  => $request->nomor_highmap,
            'aktif'  => $request->aktif,
        ]);
        return redirect('admin/provinsi')->with(['sukses' => "Data provinsi telah diganti."]);
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

        $id_provinsi = $request->id_provinsi;
        //chek kalau belum milih data
        if (empty($id_provinsi)) {
            return redirect('admin/provinsi')->with(['warning' => "Anda belum memilih provinsi"]);
        }

        //proses
        if (isset($_POST['hapus'])) {
            //proses hapus provinsi
            for ($i = 0; $i < sizeof($id_provinsi); $i++) {
                DB::table('provinsi')->where('id_provinsi', $id_provinsi[$i])->delete();
            }
            return redirect('admin/provinsi')->with(['sukses' => "Data telah dihapus"]);
        } elseif (isset($_POST['update'])) {
            //proses update akses level provinsi
            for ($i = 0; $i < sizeof($id_provinsi); $i++) {
                DB::table('provinsi')->where('id_provinsi', $id_provinsi[$i])->update([
                    'aktif' => $request->aktif
                ]);
            }
            return redirect('admin/provinsi')->with(['sukses' => "Data telah diupdate"]);
        }
    }


    //delete
    public function delete($id_provinsi)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        DB::table('provinsi')->where('id_provinsi', $id_provinsi)->delete();
        return redirect('admin/provinsi')->with(['sukses' => "Data provinsi telah dihapus."]);
    }
}
