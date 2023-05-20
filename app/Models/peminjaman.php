<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class peminjaman extends Model
{
    use HasFactory;

    public function addData($data)
    {
        DB::table('peminjaman')->insert($data);
    }

    public function updatePeminjaman($id_peminjaman, $data)
    {
        return DB::table('peminjaman')->where('id_peminjaman', $id_peminjaman)->update($data);
    }
    
    public function checkID()
    {
        return DB::table('peminjaman')->count();
    }
    public function maxIdPeminjaman()
    {
        return DB::table('peminjaman')->max('id_peminjaman');
    }

    public function myData($id)
    {
        return DB::table('peminjaman')->where('id_user', $id)->get();
    }
    
    public function detailPeminjaman($id_peminjaman)
    {
        return DB::table('peminjaman')->where('id_peminjaman', $id_peminjaman)->first();
    }

    public function detailPeminjaman2($id_peminjaman)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')->where('id_peminjaman', $id_peminjaman)->first();
    }

    public function tampilPeminjaman()
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')->where('level', 'Ormawa')->get();
    }
    public function tampilPeminjamanDosen()
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')->where('level', 'Dosen')->get();
    }

   

    

    

}
