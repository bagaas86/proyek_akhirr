<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class supir extends Model
{
    use HasFactory;
    //all Data
    public function allData()
    {
        return DB::table('supir')->where('status_supir', "Aktif")->get();
    }
    
    // create
    public function addData($data)
    {
        DB::table('supir')->insert($data);
    }

    // edit
    public function detailData($id_supir)
    {
        return DB::table('supir')->where('id_supir', $id_supir)->first();
    }

    public function editData($id_supir, $data)
    {
        return DB::table('supir')->where('id_supir', $id_supir)->update($data);
    }

    public function checkSupir($fromdate, $todate)
    {
        return DB::table('supir')->join('aktivitas','supir.id_supir','=','aktivitas.id_supir')
        ->whereBetween('aktivitas.mulai_aktivitas', [$fromdate, $todate])
        ->OrwhereBetween('aktivitas.selesai_aktivitas', [$fromdate, $todate])
        ->get();
    }
    public function readySupir($check)
    {
        return DB::table('supir')->rightjoin('aktivitas','supir.id_supir','=','aktivitas.id_supir')
        ->whereNotIn('supir.id_supir', [$check])
        ->get();
    }

    public function checkData($id_supir)
    {
        return DB::table('supir')->whereNot('id_supir', $id_supir);
    }
}
