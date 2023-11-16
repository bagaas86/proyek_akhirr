<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ulasan extends Model
{
    use HasFactory;
    public function addData($data)
    {
        return DB::table('ulasan')->insert($data);
    }

    public function allData($id_user)
    {
        return DB::table('ulasan')->where('id_user', $id_user)->get();
    }
    
    public function cekUlasan($id)
    {
        return DB::table('ulasan')->where('id_peminjaman', $id)->count();
    }
}
