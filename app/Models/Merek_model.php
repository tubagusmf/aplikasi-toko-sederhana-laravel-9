<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Merek_model extends Model
{
    // use HasFactory;

    // listing
    public function listing()
    {
        $query = DB::table('merek')
            ->select('*')
            ->orderBy('merek.id_merek', 'DESC')
            ->get();
        return $query;
    }

    //detail
    public function detail($id_merek)
    {
        $query = DB::table('merek')
            ->select('*')
            ->where('id_merek', $id_merek)
            ->orderBy('merek.id_merek', 'DESC')
            ->first(); //untuk menampilkan 1 data
        return $query;
    }

    //login
    // public  function login($username, $password)
    // {
    //     $query = DB::table('merek')
    //         ->select('*')
    //         ->where([
    //             'username' => $username,
    //             'password' => sha1($password)
    //         ])
    //         ->orderBy('merek.id_merek', 'DESC')
    //         ->first();
    //     return $query;
    // }
}
