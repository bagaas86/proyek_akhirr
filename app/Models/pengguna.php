<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pengguna extends Model
{
    use HasFactory;

    public function getData()
    {
        return DB::table('users')->where('status_user', "Aktif")->get();
    }

    public function allData()
    {
        return DB::table('users')->where('status_user', "Aktif")
        ->whereNot('sebagai', "Admin")
        ->orWhere('sebagai', null)
        ->get();
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

    public function whatsapp1()
    {
        return DB::table('users')->where('sebagai', "Kepala Bagian")->orwhere('sebagai', "Staff Umum")->get();
    }

    public function sebagai()
    {
        return DB::table('users')->distinct()->select('sebagai')->get();
    }

    // untuk pengaturan
    public function bagian_umum()
    {
        return DB::table('users')->where('sebagai', "Staff Umum")->whereNot('username', null)->get();
    }

    public function wakil_direktur_1()
    {
        return DB::table('users')->where('sebagai', "Wakil Direktur 1")->whereNot('username', null)->get();
    }

    public function wakil_direktur_2()
    {
        return DB::table('users')->where('sebagai', "Wakil Direktur 2")->whereNot('username', null)->get();
    }

    public function kepala_bagian()
    {
        return DB::table('users')->where('sebagai', "Kepala Bagian")->whereNot('username', null)->get();
    }

    public function pengelola_supir()
    {
        return DB::table('users')->where('sebagai', "Pengelola Supir")->whereNot('username', null)->get();
    }

    // Dashboard
    public function totalPengguna()
    {
        return DB::table('users')->whereNot('username', null)->count();
    }
    
}
