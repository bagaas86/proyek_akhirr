<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class kendaraan extends Model
{
    use HasFactory;
    public function addData($data_kendaraan)
    {
        DB::table('kendaraan')->insert($data_kendaraan);
    }
    public function detailData($id_item)
    {
        return DB::table('kendaraan')->where('id_item', $id_item)->first();
    }
}
