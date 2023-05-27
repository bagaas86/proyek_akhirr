<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pengguna extends Model
{
    use HasFactory;
    public function allData()
    {
        return DB::table('users')->Orwhere('level', "Dosen")->Orwhere('level', "Ormawa")->Orwhere('level', "Wadir 1")->Orwhere('level', "Wadir 2")->Orwhere('level', "Kabag")->get();
    }

    public function addData($data)
    {
        DB::table('users')->insert($data);
    }
    public function detailData($id)
    {
        return DB::table('users')->where('id', $id)->first();
    }
    public function editData($id, $data)
    {
        return DB::table('users')->where('id', $id)->update($data);
    }
    public function deleteData($id)
    {
        return DB::table('users')->where('id', $id)->delete();
    }
}
