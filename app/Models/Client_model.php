<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client_model extends Model
{
    // use HasFactory;

    // listing
    public function listing()
    {
        $query = DB::table('client')
            ->select(
                'client.*',
                'provinsi.nama_provinsi',
                'provinsi.kode_provinsi',
                'kabupaten.nama_kabupaten',
                'users.nama'
            )
            ->join('provinsi', 'provinsi.id_provinsi', '=', 'client.id_provinsi', 'LEFT')
            ->join('kabupaten', 'kabupaten.id_kabupaten', '=', 'client.id_kabupaten', 'LEFT')
            ->join('users', 'users.id_user', '=', 'client.id_user', 'LEFT')
            ->orderBy('client.id_client', 'DESC')
            ->get();
        return $query;
    }

    // check
    public function check($email)
    {
        $query = DB::table('client')
            ->select('*')
            ->where('email', $email)
            ->orderBy('client.id_client', 'DESC')
            ->first();
        return $query;
    }

    // detail
    // public function detail($id_client)
    // {
    //     $query = DB::table('client')
    //         ->select('*')
    //         ->where('id_client', $id_client)
    //         ->orderBy('client.id_client', 'DESC')
    //         ->first();
    //     return $query;
    // }

    // login
    public function login($username, $password)
    {
        $query = DB::table('client')
            ->select('*')
            ->where([
                'email' => $username,
                'password' => sha1($password)
            ])
            ->orderBy('client.id_client', 'DESC')
            ->first();
        return $query;
    }

    // status_client
    public function status_client($status_client)
    {
        $query = DB::table('client')
            ->select(
                'client.*',
                'provinsi.nama_provinsi',
                'provinsi.kode_provinsi',
                'kabupaten.nama_kabupaten',
                'users.nama'
            )
            ->join('provinsi', 'provinsi.id_provinsi', '=', 'client.id_provinsi', 'LEFT')
            ->join('kabupaten', 'kabupaten.id_kabupaten', '=', 'client.id_kabupaten', 'LEFT')
            ->join('users', 'users.id_user', '=', 'client.id_user', 'LEFT')
            ->where('client.status_client', $status_client)
            ->orderBy('client.id_client', 'DESC')
            ->get();
        return $query;
    }

    // provinsi
    public function provinsi($id_provinsi)
    {
        $query = DB::table('client')
            ->select(
                'client.*',
                'provinsi.nama_provinsi',
                'provinsi.kode_provinsi',
                'kabupaten.nama_kabupaten',
                'users.nama'
            )
            ->join('provinsi', 'provinsi.id_provinsi', '=', 'client.id_provinsi', 'LEFT')
            ->join('kabupaten', 'kabupaten.id_kabupaten', '=', 'client.id_kabupaten', 'LEFT')
            ->join('users', 'users.id_user', '=', 'client.id_user', 'LEFT')
            ->where('client.id_provinsi', $id_provinsi)
            ->orderBy('client.id_client', 'DESC')
            ->get();
        return $query;
    }

    //detail
    public function detail($id_client)
    {
        $query = DB::table('client')
            ->select(
                'client.*',
                'provinsi.nama_provinsi',
                'provinsi.kode_provinsi',
                'kabupaten.nama_kabupaten',
                'users.nama'
            )
            ->join('provinsi', 'provinsi.id_provinsi', '=', 'client.id_provinsi', 'LEFT')
            ->join('kabupaten', 'kabupaten.id_kabupaten', '=', 'client.id_kabupaten', 'LEFT')
            ->join('users', 'users.id_user', '=', 'client.id_user', 'LEFT')
            ->where('client.id_client', $id_client)
            ->orderBy('client.id_client', 'DESC')
            ->first(); //untuk menampilkan 1 data
        return $query;
    }
}
