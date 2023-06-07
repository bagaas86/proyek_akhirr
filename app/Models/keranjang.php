<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class keranjang extends Model
{
    use HasFactory;
    public function addData($data)
    {
        DB::table('keranjangs')->insert($data);
    }

    public function ubahQty($id_keranjang, $id, $data)
    {
        return DB::table('keranjangs')->where('id_keranjang', $id_keranjang)->where('id_user', $id)->update($data);
    }

    public function checkKeranjang($id_item, $id_user)
    {
        return DB::table('keranjangs')->where('id_peminjaman', null)->where('id_item', $id_item)->where('id_user', $id_user)->count();
    }

    public function checkBarang($id_peminjaman)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')->where('id_peminjaman', $id_peminjaman)->where("items.kategori_item", "Barang")->count();
    }

    public function checkRuangan($id_peminjaman)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')->where('id_peminjaman', $id_peminjaman)->where("items.kategori_item", "Ruangan")->count();
    }

    public function checkKendaraan($id_peminjaman)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')->where('id_peminjaman', $id_peminjaman)->where("items.kategori_item", "Kendaraan")->count();
    }

    public function keranjangBarang($id)
    {
        return DB::table('keranjangs')->join('users','keranjangs.id_user','=','users.id')->join('items','keranjangs.id_item','=','items.id_item')
        ->where('items.kategori_item','Barang')->where('keranjangs.id_peminjaman',null)->where('keranjangs.id_user', $id)->get();
    }

    public function keranjangRuangan($id)
    {
        return DB::table('keranjangs')->join('users','keranjangs.id_user','=','users.id')->join('items','keranjangs.id_item','=','items.id_item')
        ->where('items.kategori_item','Ruangan')->where('keranjangs.id_peminjaman',null)->where('keranjangs.id_user', $id)->get();
    }

    public function keranjangKendaraan($id)
    {
        return DB::table('keranjangs')
        ->join('users','keranjangs.id_user','=','users.id')
        ->join('items','keranjangs.id_item','=','items.id_item')
        ->join('kendaraan', 'keranjangs.id_item','=','kendaraan.id_item')
        ->where('items.kategori_item','Kendaraan')->where('keranjangs.id_peminjaman',null)->where('keranjangs.id_user', $id)->get();
    }

    public function deleteData($id_keranjang)
    {
        return DB::table('keranjangs')->where('id_keranjang', $id_keranjang)->delete();
    }

    public function resetKeranjang($id)
    {
        return DB::table('keranjangs')->where('id_user', $id)->where('id_peminjaman', null)->delete();
    }

    public function finish($id_user, $data2)
    {
        return DB::table('keranjangs')->where('id_peminjaman', null)->where('id_user', $id_user)->update($data2);
    }

    public function detailPeminjaman($id_peminjaman)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')->where('id_peminjaman', $id_peminjaman)->orderBy('items.kategori_item','ASC')->get();
    }

    public function detailPeminjamanRuangan($id_peminjaman)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')->where('items.kategori_item', "Ruangan")->where('id_peminjaman', $id_peminjaman)->orderBy('items.kategori_item','ASC')->get();
    }

    public function detailPeminjamanBarang($id_peminjaman)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')->where('items.kategori_item', "Barang")->where('id_peminjaman', $id_peminjaman)->orderBy('items.kategori_item','ASC')->get();
    }
    // public function getDataUser()
    // {
    //     return DB::table('keranjangs')->join('users','keranjangs.id_user','=','users.id')->join('items','keranjangs.id_item','=','items.id_item')->get();
    // }

    public function checkPeminjaman()
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')->get();
    }

    // public function joinKeranjang_Items($fromdate, $todate)
    // {
    //     // return DB::table('keranjangs')->join('peminjaman','keranjangs.id_peminjaman','=','keranjangs.id_peminjaman')
    //     // ->where('keranjangs.id_item', $id_item)
    //     // ->where('waktu_awal', '<=', $fromdate)
    //     // ->where('waktu_akhir', '>=', $todate)
    //     // ->get();
    //     return DB::table('keranjangs')->join('peminjaman','keranjangs.id_peminjaman','=','keranjangs.id_peminjaman')
    //     ->whereNotBetween('waktu_awal', [$fromdate, $todate])
    //     ->OrwhereNotBetween('waktu_akhir', [$fromdate, $todate])
    //     ->get();
    // }

    // public function join($id_item)
    // {
    //     return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')->where('items.id_item', $id_item)->get();
    // }

    public function checkBarang1($id)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')
        ->where('id_user', $id)
        ->where("items.kategori_item", "Barang")
        ->where("keranjangs.id_peminjaman", null)
        ->count();
    }

    public function checkRuangan1($id)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')
        ->where('id_user', $id)
        ->where("items.kategori_item", "Ruangan")
        ->where("keranjangs.id_peminjaman", null)
        ->count();
    }

    public function checkKendaraan1($id)
    {
        return DB::table('keranjangs')->join('items','keranjangs.id_item','=','items.id_item')
        ->where('id_user', $id)
        ->where("items.kategori_item", "Kendaraan")
        ->where("keranjangs.id_peminjaman", null)
        ->count();
    }





    
}
