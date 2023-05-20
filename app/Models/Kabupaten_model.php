<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kabupaten_model extends Model
{
    // use HasFactory;

    // listing
    public function listing()
    {
        $query = DB::table('kabupaten')
            ->select(
                'kabupaten.*',
                'provinsi.nama_provinsi'
            )
            ->join('provinsi', 'provinsi.id_provinsi', '=', 'kabupaten.id_provinsi', 'LEFT')
            ->orderBy('kabupaten.id_kabupaten', 'DESC')
            ->get();
        return $query;
    }

    //detail
    public function detail($id_kabupaten)
    {
        $query = DB::table('kabupaten')
            ->select('*')
            ->where('id_kabupaten', $id_kabupaten)
            ->orderBy('kabupaten.id_kabupaten', 'DESC')
            ->first(); //untuk menampilkan 1 data
        return $query;
    }

    // provinsi
    public function provinsi($id_provinsi)
    {
        $query = DB::table('kabupaten')
            ->select('*')
            ->where('id_provinsi', $id_provinsi)
            ->orderBy('kabupaten.id_kabupaten', 'DESC')
            ->get();
        return $query;
    }
}
