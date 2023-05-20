<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provinsi_model extends Model
{
    // use HasFactory;

    // listing
    public function listing()
    {
        $query = DB::table('provinsi')
            ->select('*')
            ->orderBy('provinsi.id_provinsi', 'DESC')
            ->get();
        return $query;
    }

    //detail
    public function detail($id_provinsi)
    {
        $query = DB::table('provinsi')
            ->select('*')
            ->where('id_provinsi', $id_provinsi)
            ->orderBy('provinsi.id_provinsi', 'DESC')
            ->first(); //untuk menampilkan 1 data
        return $query;
    }
}
