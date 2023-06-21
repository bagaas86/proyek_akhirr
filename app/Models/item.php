<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class item extends Model
{
    use HasFactory;
   

    public function allData()
    {
        return DB::table('items')->get();
    }

    public function itemReady()
    {
        return DB::table('items')->where('kondisi_item','=','Ready')->get();
    }

    public function ruanganData()
    {
        return DB::table('items')->where('kategori_item','=','Ruangan')->get();
    }

    public function barangData()
    {
        return DB::table('items')->where('kategori_item','=','Barang')->get();
    }

    public function kendaraanData()
    {
        return DB::table('items')->join('kendaraan', 'items.id_item','=','kendaraan.id_item')->where('kategori_item','=','Kendaraan')->get();
    }

    public function checkID()
    {
        return DB::table('items')->count();
    }

    public function maxIditem()
    {
        return DB::table('items')->max('id_item');
    }


    public function itemFilter($filterUser)
    {
        return DB::table('items')->where('kategori_item', '=', $filterUser)->where('kondisi_item','=','Ready')->get();
    }

   
    // public function checkitem($namaitem)
    // {
    //     return DB::table('items')->where('nama_item', $namaitem)->count();
    // }

    public function addData($data)
    {
        DB::table('items')->insert($data);
    }

    public function detailData($id)
    {
        return DB::table('items')->where('id_item', $id)->first();
    }
    public function editData($id, $data)
    {
        return DB::table('items')->where('id_item', $id)->update($data);
    }
    public function deleteData($id)
    {
        return DB::table('items')->where('id_item', $id)->delete();
    }

    public function checkItemTersedia($filterUser)
    {
        return DB::table('items')->where('item_tersedia','<', '1')
        ->where('kategori_item', $filterUser)
        ->get();
    }

    public function detailKendaraan($id_item)
    {
        return DB::table('items')->join('kendaraan','items.id_item','=','kendaraan.id_item')->where('kendaraan.id_item', $id_item)->first();
    }

    public function checkItemNull()
    {
        return DB::table('items')->whereNot('item_tersedia', '0')->get();
    }

    public function ambilData($id_item, $filterUser)
        {
            return DB::table('items')->whereNot('id_item', $id_item)->where('kategori_item', $filterUser)->get();
        }


    // public function checkItem($fromdate, $todate)
    // {
    //        return DB::table('items')->leftjoin('keranjangs','items.id_item', '=', 'keranjangs.id_item')->groupby('items.nama_item')->get();
    //     // return DB::table('items')->join('keranjangs','items.id_item', '=', 'keranjangs.id_item')->join('peminjaman', 'keranjangs.id_peminjaman', '=', 'peminjaman.id_peminjaman')->whereBetween('waktu_awal', [$fromdate, $todate])->orWhereBetween('waktu_akhir', [$fromdate, $todate])->get();
    
    // }
    


}
