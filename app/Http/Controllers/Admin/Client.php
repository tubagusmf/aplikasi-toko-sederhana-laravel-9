<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client_model; //Manggil model yg dibuat
use App\Models\Provinsi_model; //Manggil model yg dibuat
use App\Models\Kabupaten_model; //Manggil model yg dibuat
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB; //Load bawaan fungsi DB
use Illuminate\Support\Str;
use Image;
use PDF;

class Client extends Controller
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

        $m_client = new Client_model();
        $m_provinsi = new Provinsi_model();
        $client = $m_client->listing();
        $provinsi = $m_provinsi->listing();
        $data = [
            'title' => 'Data Client',
            'client' => $client,
            'provinsi' => $provinsi,
            'content' => 'admin/client/index'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //unduh pdf
    public function unduh()
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_client = new Client_model();
        $m_kategori = new Kategori_model();
        $client = $m_client->listing();
        $kategori = $m_kategori->listing();
        $data = [
            'title' => 'Pricelist client tanggal ' . date('d-m-Y'),
            'client' => $client,
            'kategori' => $kategori
        ];

        // return view('admin/layout/wrapper', $data);
        //setting view pdf
        $config = [
            'format' => 'A4-P', //ukuran portrait
            // 'format' => 'A4-L', //ukuran landscape
        ];
        $pdf = PDF::loadview('admin/client/unduh', $data, [], $config);
        $nama_file = 'Pricelist client tanggal per- ' . date('d-m-Y') . '.pdf';
        // return $pdf->download($nama_file, 'D'); //untuk download
        return $pdf->stream($nama_file); //untuk preview
    }

    //status_client
    public function status_client($status_client)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_client = new Client_model();
        $m_kategori = new Kategori_model();
        $client = $m_client->status_client($status_client);
        $kategori = $m_kategori->listing();
        $data = [
            'title' => 'Client dengan status: ' . $status_client,
            'client' => $client,
            'kategori' => $kategori,
            'content' => 'admin/client/index'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //kategori
    public function kategori($id_kategori)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_client = new Client_model();
        $m_kategori = new Kategori_model();
        $client = $m_client->kategori($id_kategori);
        $kategori = $m_kategori->listing();
        $kategori_detail = $m_kategori->detail($id_kategori);
        $data = [
            'title' => 'Client dengan status: ' . $kategori_detail->nama_kategori,
            'client' => $client,
            'kategori' => $kategori,
            'content' => 'admin/client/index'
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

        $m_kabupaten = new Kabupaten_model();
        $m_provinsi = new Provinsi_model();
        $data = [
            'title' => 'Tambah Client',
            'kabupaten' => $m_kabupaten->listing(),
            'provinsi' => $m_provinsi->listing(),
            'content' => 'admin/client/tambah'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //edit
    public function edit($id_client)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_client = new Client_model();
        $m_kabupaten = new Kabupaten_model();
        $m_provinsi = new Provinsi_model();
        $client = $m_client->detail($id_client);
        $kabupaten = $m_kabupaten->listing();
        $provinsi = $m_provinsi->listing();
        $data = [
            'title' => 'Edit Client',
            'client' => $client,
            'kabupaten' => $kabupaten,
            'provinsi' => $provinsi,
            'content' => 'admin/client/edit'
        ];

        return view('admin/layout/wrapper', $data);
    }

    //cetak
    public function cetak($id_client)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        $m_client = new Client_model();
        $m_merek = new Merek_model();
        $m_kategori = new Kategori_model();
        $client = $m_client->detail($id_client);
        $merek = $m_merek->listing();
        $kategori = $m_kategori->listing();
        $data = [
            'title' => $client->nama_client,
            'client' => $client,
            'merek' => $merek,
            'kategori' => $kategori
        ];

        // return view('admin/layout/cetak', $data);

        //setting view pdf
        $config = [
            'format' => 'A4-P', //ukuran portrait
            // 'format' => 'A4-L', //ukuran landscape
        ];
        $pdf = PDF::loadview('admin/client/cetak', $data, [], $config);
        $nama_file = $client->nama_client . '.pdf';
        // return $pdf->download($nama_file, 'D'); //untuk download
        return $pdf->stream($nama_file); //untuk preview
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
            'nama_client'  => 'required|unique:client',
            'gambar' => 'file|image|mimes:jpeg,png,jpg|max:8024',
        ]);

        // UPLOAD START
        $image                          = $request->file('gambar');
        if (!empty($image)) {
            $filenamewithextension      = $request->file('gambar')->getClientOriginalName();
            $filename                   = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['gambar']            = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath            = './assets/upload/image/thumbs/';
            $img = Image::make($image->getRealPath(), array(
                'width'     => 150,
                'height'    => 150,
                'greyscale' => false
            ));
            $img->save($destinationPath . '/' . $input['gambar']);
            $destinationPath = './assets/upload/image/';
            $image->move($destinationPath, $input['gambar']);
            // END UPLOAD

            DB::table('client')->insert([
                'id_user'  => Session()->get('id_user'),
                'id_provinsi'  => $request->id_provinsi,
                'id_kabupaten'  => $request->id_kabupaten,
                'jenis_client'  => $request->jenis_client,
                'nama_client'  => $request->nama_client,
                'pimpinan'  => $request->pimpinan,
                'alamat'  => $request->alamat,
                'telepon'  => $request->telepon,
                'website'  => $request->website,
                'email'  => $request->email,
                'password'  => sha1($request->password),
                'isi'  => $request->isi,
                'status_testimoni'  => $request->status_testimoni,
                'isi_testimoni'  => $request->isi_testimoni,
                'gambar'  => $input['gambar'],
                'status_client'  => $request->status_client,
                'keywords'  => $request->keywords,
                'status_baca'  => $request->status_baca,
                'tempat_lahir'  => $request->tempat_lahir,
                'tanggal_lahir'  => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'tanggal_post'  => date('Y-m-d H:i:s')
            ]);
        } else {
            DB::table('client')->insert([
                'id_user'  => Session()->get('id_user'),
                'id_provinsi'  => $request->id_provinsi,
                'id_kabupaten'  => $request->id_kabupaten,
                'jenis_client'  => $request->jenis_client,
                'nama_client'  => $request->nama_client,
                'pimpinan'  => $request->pimpinan,
                'alamat'  => $request->alamat,
                'telepon'  => $request->telepon,
                'website'  => $request->website,
                'email'  => $request->email,
                'password'  => sha1($request->password),
                'isi'  => $request->isi,
                'status_testimoni'  => $request->status_testimoni,
                'isi_testimoni'  => $request->isi_testimoni,
                'status_client'  => $request->status_client,
                'keywords'  => $request->keywords,
                'status_baca'  => $request->status_baca,
                'tempat_lahir'  => $request->tempat_lahir,
                'tanggal_lahir'  => date('Y-m-d', strtotime($request->tanggal_lahir)),
                'tanggal_post'  => date('Y-m-d H:i:s')
            ]);
        }
        return redirect('admin/client')->with(['sukses' => "Data telah ditambah."]);
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
            'nama_client'  => 'required',
            'gambar' => 'file|image|mimes:jpeg,png,jpg|max:8024',
        ]);

        // UPLOAD START
        $image                          = $request->file('gambar');
        if (!empty($image)) {
            $filenamewithextension      = $request->file('gambar')->getClientOriginalName();
            $filename                   = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['gambar']            = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath            = './assets/upload/image/thumbs/';
            $img = Image::make($image->getRealPath(), array(
                'width'     => 150,
                'height'    => 150,
                'greyscale' => false
            ));
            $img->save($destinationPath . '/' . $input['gambar']);
            $destinationPath = './assets/upload/image/';
            $image->move($destinationPath, $input['gambar']);
            // END UPLOAD

            DB::table('client')->where('id_client', $request->id_client)->update([
                'id_user'  => Session()->get('id_user'),
                'id_provinsi'  => $request->id_provinsi,
                'id_kabupaten'  => $request->id_kabupaten,
                'jenis_client'  => $request->jenis_client,
                'nama_client'  => $request->nama_client,
                'pimpinan'  => $request->pimpinan,
                'alamat'  => $request->alamat,
                'telepon'  => $request->telepon,
                'website'  => $request->website,
                'email'  => $request->email,
                // 'password'  => sha1($request->password),
                'isi'  => $request->isi,
                'status_testimoni'  => $request->status_testimoni,
                'isi_testimoni'  => $request->isi_testimoni,
                'gambar'  => $input['gambar'],
                'status_client'  => $request->status_client,
                'keywords'  => $request->keywords,
                'status_baca'  => $request->status_baca,
                'tempat_lahir'  => $request->tempat_lahir,
                'tanggal_lahir'  => date('Y-m-d', strtotime($request->tanggal_lahir))
            ]);
        } else {
            DB::table('client')->where('id_client', $request->id_client)->update([
                'id_user'  => Session()->get('id_user'),
                'id_provinsi'  => $request->id_provinsi,
                'id_kabupaten'  => $request->id_kabupaten,
                'jenis_client'  => $request->jenis_client,
                'nama_client'  => $request->nama_client,
                'pimpinan'  => $request->pimpinan,
                'alamat'  => $request->alamat,
                'telepon'  => $request->telepon,
                'website'  => $request->website,
                'email'  => $request->email,
                // 'password'  => sha1($request->password),
                'isi'  => $request->isi,
                'status_testimoni'  => $request->status_testimoni,
                'isi_testimoni'  => $request->isi_testimoni,
                'status_client'  => $request->status_client,
                'keywords'  => $request->keywords,
                'status_baca'  => $request->status_baca,
                'tempat_lahir'  => $request->tempat_lahir,
                'tanggal_lahir'  => date('Y-m-d', strtotime($request->tanggal_lahir))
            ]);
        }
        return redirect('admin/client')->with(['sukses' => "Data telah diupdate."]);
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

        $id_client = $request->id_client;
        //chek kalau belum milih data
        if (empty($id_client)) {
            return redirect('admin/client')->with(['warning' => "Anda belum memilih client"]);
        }

        //proses
        if (isset($_POST['hapus'])) {
            //proses hapus client
            for ($i = 0; $i < sizeof($id_client); $i++) {
                DB::table('client')->where('id_client', $id_client[$i])->delete();
            }
            return redirect('admin/client')->with(['sukses' => "Data telah dihapus"]);
        } elseif (isset($_POST['update'])) {
            //proses update akses level client
            for ($i = 0; $i < sizeof($id_client); $i++) {
                DB::table('client')->where('id_client', $id_client[$i])->update([
                    'id_provinsi' => $request->id_provinsi
                ]);
            }
            return redirect('admin/client')->with(['sukses' => "Data telah diupdate"]);
        } elseif (isset($_POST['draft'])) {
            //proses update akses level client
            for ($i = 0; $i < sizeof($id_client); $i++) {
                DB::table('client')->where('id_client', $id_client[$i])->update([
                    'status_client' => 'Draft'
                ]);
            }
            return redirect('admin/client')->with(['sukses' => "Data telah diupdate"]);
        } elseif (isset($_POST['publish'])) {
            //proses update akses level client
            for ($i = 0; $i < sizeof($id_client); $i++) {
                DB::table('client')->where('id_client', $id_client[$i])->update([
                    'status_client' => 'Publish'
                ]);
            }
            return redirect('admin/client')->with(['sukses' => "Data telah diupdate"]);
        }
    }

    //provinsi
    public function provinsi()
    {
        $id_provinsi = $_GET['q'];
        $m_kabupaten = new Kabupaten_model();
        $kabupaten = $m_kabupaten->provinsi($id_provinsi);

        $data = ['kabupaten' => $kabupaten];
        return view('admin/client/provinsi', $data);
    }


    //delete
    public function delete($id_client)
    {
        //proteksi halaman
        if (Session()->get('username') == "") { //jika username masih kosong, maka akan diarahkan ke halaman login
            $last_page = url()->full();
            return redirect('login?redirect=' . $last_page)->with(['warning' => 'Mohon maaf, Anda belum login.']);
        }
        //end proteksi halaman

        DB::table('client')->where('id_client', $id_client)->delete();
        return redirect('admin/client')->with(['sukses' => "Data client telah dihapus."]);
    }
}
