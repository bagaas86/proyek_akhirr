<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class pengaturan extends Model
{
    use HasFactory;
    public function editData($data)
    {
        return DB::table('pengaturan')->where('id_pengaturan', 1)->update($data);
    }

    public function detailPengaturan()
    {
        return DB::table('pengaturan')->where('id_pengaturan', 1)->first();
    }

    public function joinKabag()
    {
        return DB::table('pengaturan')
        ->join('users', 'pengaturan.id_kepala_bagian','=','users.id')
        ->where('pengaturan.id_pengaturan', 1)->first();
    }

    public function joinUmum()
    {
        return DB::table('pengaturan')
        ->join('users', 'pengaturan.id_bagian_umum','=','users.id')
        ->where('pengaturan.id_pengaturan', 1)->first();
    }

    public function joinWadir1()
    {
        return DB::table('pengaturan')
        ->join('users', 'pengaturan.id_wadir1','=','users.id')
        ->where('pengaturan.id_pengaturan', 1)->first();
    }

    public function joinWadir2()
    {
        return DB::table('pengaturan')
        ->join('users', 'pengaturan.id_wadir2','=','users.id')
        ->where('pengaturan.id_pengaturan', 1)->first();
    }
    public function joinPengelolaSupir()
    {
        return DB::table('pengaturan')
        ->join('users', 'pengaturan.id_pengelola_supir','=','users.id')
        ->where('pengaturan.id_pengaturan', 1)->first();
    }
}
