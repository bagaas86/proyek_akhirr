<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\item;
use App\Models\kendaraan;
use DB;
use File;

class c_kendaraan extends Controller
{
    public function __construct()
    {
        $this->item = new item();
        $this->kendaraan= new kendaraan();
       
    }
    public function index()
    {
        $data =[
            'item'=> $this->item->kendaraanData()
        ];
        return view ('admin.kendaraan.index', $data);
    }

    public function create()
    {
        $checkiditem = $this->item->checkID();
        $id_item = $checkiditem + 1;
        if($checkiditem == null){
            $data =[
                'id_item' => $id_item,
            ];
        }else{
            $maxIditem = $this->item->maxIditem();
            $id_item = $maxIditem + 1;
            $data = [
                'id_item' => $id_item,
            ];
        }
        return view ('admin.kendaraan.create' ,$data);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama_item' => 'required|unique:items,nama_item',
        //     'lokasi_item' => 'required',
        //     'jumlah_item' => 'required',
        //     'kondisi_item' => 'required',
        //     'deskripsi_item' => 'required',
        // ],[
        //     'nama_item.required'=>'Nama Barang Wajib terisi',
        //     'nama_item.unique'=>'Nama Barang Sudah Ada',
        //     'lokasi_item.required'=>'Lokasi Barang Wajib terisi',
        //     'jumlah_item.required'=>'Jumlah Barang wajib terisi',
        //     'kondisi_item.required'=>'Kondisi Barang Wajib terisi',
        //     'deskripsi_item.required'=>'Deskripsi Barang wajib terisi',
        // ]);

            if($request->foto_item <> null){
                $file = $request->foto_item;
                $filename = $request->nama_item.".".$file->extension();     
                $file->move(public_path('foto/dm/kendaraan'),$filename);
                $data = [
                    'id_item' => $request->id_item,
                    'nama_item'=> $request->nama_item,
                    'lokasi_item'=> "Fleksibel",
                    'jumlah_item' => $request->jumlah_item,
                    'kondisi_item'=> $request->kondisi_item,
                    'deskripsi_item'=> $request->deskripsi_item,
                    'kategori_item'=>"Kendaraan",
                    'foto_item'=> $filename
                ];
                $this->item->addData($data);
                $data_kendaraan = [
                    'id_item'=> $request->id_item,
                    'merk_kendaraan'=> $request->nama_item,
                    'tipe_kendaraan' => $request->tipe_kendaraan,
                    'warna_kendaraan' => $request->warna_kendaraan,
                    'plat_kendaraan' => $request->plat_kendaraan,
                ];
                $this->kendaraan->addData($data_kendaraan);

            }else{
                $data = [
                    'id_item' => $request->id_item,
                    'nama_item'=> $request->nama_item,
                    'lokasi_item'=> "Fleksibel",
                    'jumlah_item' => $request->jumlah_item,
                    'kondisi_item'=> $request->kondisi_item,
                    'deskripsi_item'=> $request->deskripsi_item,
                    'kategori_item'=>"Kendaraan",
                    'foto_item'=> "nbarang.png",
                ];
                $this->item->addData($data);
                $data_kendaraan = [
                    'id_item'=> $request->id_item,
                    'merk_kendaraan'=> $request->nama_item,
                    'tipe_kendaraan' => $request->tipe_kendaraan,
                    'warna_kendaraan' => $request->warna_kendaraan,
                    'plat_kendaraan' => $request->plat_kendaraan,
                ];
                $this->kendaraan->addData($data_kendaraan);
            }
          
            return redirect()->route('dm.kendaraan.index')->with('success','Kendaraan berhasil ditambahkan');
       
    }
}
