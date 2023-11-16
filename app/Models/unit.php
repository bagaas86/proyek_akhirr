<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class unit extends Model
{
    use HasFactory;
    public function allData()
    {
        return DB::table('unit')->get();
    }

    public function unitData()
    {
        return DB::table('unit')->where('jenis', "Unit")->get();
    }
    
    public function jabatanData()
    {
        return DB::table('unit')->where('jenis', "Jabatan")->get();
    }


    
    // public function jurusanData()
    // {
    //     return DB::table('unit')->where('jenis_unit', "Jurusan")->get();
    // }

    // public function ormawaData()
    // {
    //     return DB::table('unit')->where('jenis_unit', "Ormawa")->get();
    // }

  
    // create
    public function addData($data)
    {
        DB::table('unit')->insert($data);
    }

    // edit
    public function detailData($id_unit)
    {
        return DB::table('unit')->where('id_unit', $id_unit)->first();
    }

    public function editData($id_unit, $data)
    {
        return DB::table('unit')->where('id_unit', $id_unit)->update($data);
    }

    // status unit
}
