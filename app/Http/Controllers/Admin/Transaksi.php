<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Header_transaksi_model;
use App\Models\Transaksi_model;
use App\Models\Client_model;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB; //Load bawaan fungsi DB
use PDF;

class Transaksi extends Controller
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


        $m_header_transaksi = new Header_transaksi_model();
        $header_transaksi = $m_header_transaksi->listing();

        $data = [
            'title' => 'Data Transaksi',
            'header_transaksi' => $header_transaksi,
            'content' => 'admin/transaksi/index'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //detail
    public function detail($id_header_transaksi)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_header_transaksi = new Header_transaksi_model();
        $m_transaksi = new Transaksi_model();
        $m_client = new Client_model();
        $header_transaksi = $m_header_transaksi->detail($id_header_transaksi);
        $transaksi = $m_transaksi->kode_transaksi($header_transaksi->kode_transaksi);
        $client = $m_client->detail($header_transaksi->id_client);

        $data = [
            'title' => 'Detail Transaksi ' . $header_transaksi->kode_transaksi,
            'header_transaksi' => $header_transaksi,
            'transaksi' => $transaksi,
            'client' => $client,
            'content' => 'admin/transaksi/detail'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //edit
    public function edit($id_header_transaksi)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_header_transaksi = new Header_transaksi_model();
        $m_transaksi = new Transaksi_model();
        $m_client = new Client_model();
        $header_transaksi = $m_header_transaksi->detail($id_header_transaksi);
        $transaksi = $m_transaksi->kode_transaksi($header_transaksi->kode_transaksi);
        $client = $m_client->detail($header_transaksi->id_client);

        $data = [
            'title' => 'Edit Transaksi ' . $header_transaksi->kode_transaksi,
            'header_transaksi' => $header_transaksi,
            'transaksi' => $transaksi,
            'client' => $client,
            'content' => 'admin/transaksi/edit'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //proses_edit
    public function proses_edit(Request $request)
    {
        DB::table('header_transaksi')->where('id_header_transaksi', $request->id_header_transaksi)->update([
            'id_user'   => Session()->get('id_user'),
            'nama_pelanggan' => $request->nama_pelanggan,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'status_bayar' => $request->status_bayar
        ]);

        return redirect('admin/transaksi')->with(['sukses' => "Data telah diupdate"]);
    }

    //cetak
    public function cetak($id_header_transaksi)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_header_transaksi = new Header_transaksi_model();
        $m_transaksi = new Transaksi_model();
        $m_client = new Client_model();
        $header_transaksi = $m_header_transaksi->detail($id_header_transaksi);
        $transaksi = $m_transaksi->kode_transaksi($header_transaksi->kode_transaksi);
        $client = $m_client->detail($header_transaksi->id_client);

        $data = [
            'title' => 'Detail Transaksi ' . $header_transaksi->kode_transaksi,
            'header_transaksi' => $header_transaksi,
            'transaksi' => $transaksi,
            'client' => $client,
        ];

        //setting view pdf
        $config = [
            'format' => 'A4-P', //ukuran portrait
            // 'format' => 'A4-L', //ukuran landscape
        ];
        $pdf = PDF::loadview('admin/transaksi/cetak', $data, [], $config);
        $nama_file = 'transaksi ' . $header_transaksi->kode_transaksi . '' . date('d-m-Y') . '.pdf';
        // return $pdf->download($nama_file, 'D'); //untuk download
        return $pdf->stream($nama_file); //untuk preview
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

        $id_header_transaksi = $request->id_header_transaksi;
        //chek kalau belum milih data
        if (empty($id_header_transaksi)) {
            return redirect('admin/transaksi')->with(['warning' => "Anda belum memilih header_transaksi"]);
        }

        //proses
        if (isset($_POST['hapus'])) {
            //proses hapus header_transaksi
            for ($i = 0; $i < sizeof($id_header_transaksi); $i++) {
                DB::table('header_transaksi')->where('id_header_transaksi', $id_header_transaksi[$i])->delete();
            }
            return redirect('admin/transaksi')->with(['sukses' => "Data telah dihapus"]);
        } elseif (isset($_POST['update'])) {
            //proses update akses level header_transaksi
            for ($i = 0; $i < sizeof($id_header_transaksi); $i++) {
                DB::table('header_transaksi')->where('id_header_transaksi', $id_header_transaksi[$i])->update([
                    'status_bayar' => $request->status_bayar,
                    'id_user'   => Session()->get('id_user')
                ]);
            }
            return redirect('admin/transaksi')->with(['sukses' => "Data telah diupdate"]);
        }
    }

    //delete
    public function delete($id_header_transaksi)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        DB::table('header_transaksi')->where('id_header_transaksi', $id_header_transaksi)->delete();
        return redirect('admin/transaksi')->with(['sukses' => "Data transaksi telah dihapus."]);
    }
}
