<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class approval extends Model
{
    use HasFactory;
    public function addData($data_approval)
    {
        DB::table('approvals')->insert($data_approval);
    }

    public function detailData($id_peminjaman)
    {
        return DB::table('approvals')
        ->join('peminjaman', 'approvals.id_peminjaman','=','peminjaman.id_peminjaman')
        ->where('approvals.id_peminjaman', $id_peminjaman)->first();
    }

    public function updatePeminjaman($id_peminjaman, $data)
    {
        return DB::table('approvals')->where('id_peminjaman', $id_peminjaman)->update($data);
    }
    
}
