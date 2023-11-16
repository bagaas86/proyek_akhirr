<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class foto extends Model
{
    use HasFactory;
    //all Data
    public function getPengembalian($id_keranjang)
    {
        return DB::table('foto')
        ->where('jenis_foto', "Pengembalian")
        ->where('id_keranjang', $id_keranjang)
        ->get();
    }

    public function getPengambilan($id_keranjang)
    {
        return DB::table('foto')
        ->where('jenis_foto', "Pengambilan")
        ->where('id_keranjang', $id_keranjang)
        ->get();
    }

 
}
