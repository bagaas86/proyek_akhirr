<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class aktivitas extends Model
{
    use HasFactory;
    //all Data
    public function allData()
    {
        return DB::table('aktivitas')->get();
    }
    
    public function joinData()
    {
        return DB::table('aktivitas')->join('supir','aktivitas.id_supir','=','supir.id_supir')->get();
    }


    // create
    public function addData($data)
    {
        DB::table('aktivitas')->insert($data);
    }

    // edit
    public function detailData($id_aktivitas)
    {
        return DB::table('aktivitas')->where('id_aktivitas', $id_aktivitas)->first();
    }

    public function editData($id_aktivitas, $data)
    {
        return DB::table('aktivitas')->where('id_aktivitas', $id_aktivitas)->update($data);
    }


    public function readySupir($driversWithoutActivities)
    {
        $j = $driversWithoutActivities;
            return DB::table('aktivitas')->when($j, function($queri, $j) {
              foreach ($j as $data) {
                    $queri->whereNot('id_supir', $data->id_supir);
              }
            })->get();
    }

    public function suratData($id_aktivitas)
    {
        return DB::table('aktivitas')
        ->join('supir','aktivitas.id_supir','=','supir.id_supir')
        ->where('aktivitas.id_aktivitas', $id_aktivitas)
        ->first();
    }
}
