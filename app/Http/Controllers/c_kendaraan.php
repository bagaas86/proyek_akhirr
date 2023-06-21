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
        $request->validate([
            'nama_item' => 'required',
            'tipe_kendaraan' => 'required',
            'warna_kendaraan' => 'required',
            'plat_kendaraan' => 'required',
            'kondisi_item' => 'required',
            'deskripsi_item' => 'required',
        ],[
            'nama_item.required'=>'Merk Kendaraan Wajib terisi',
            'tipe_kendaraan.required'=>'Tipe Kendaraan Wajib terisi',
            'warna_kendaraan.required'=>'Warna Kendaraan wajib terisi',
            'plat_kendaraan.required'=>'Plat Kendaraan Wajib terisi',
            'kondisi_item.required'=>'Kondisi Kendaraan wajib terisi',
            'deskripsi_item.required' => 'Deskripsi Kendaraan wajib terisi',
        ]);

            if($request->foto_item <> null){
                $file = $request->foto_item;
                $filename = $request->nama_item.".".$request->plat_kendaraan.".".$file->extension();     
                $file->move(public_path('foto/dm/kendaraan'),$filename);
                $data = [
                    'id_item' => $request->id_item,
                    'nama_item'=> $request->nama_item,
                    'lokasi_item'=> "Fleksibel",
                    'jumlah_item' => $request->jumlah_item,
                    'kondisi_item'=> $request->kondisi_item,
                    'deskripsi_item'=> $request->deskripsi_item,
                    'kategori_item'=>"Kendaraan",
                    'foto_item'=> $filename,
                    'item_tersedia'=>$request->jumlah_item,
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
                    'item_tersedia'=>$request->jumlah_item,
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

    public function edit($id_item)
    {
        $data =[
            'kendaraan'=> $this->item->detailKendaraan($id_item)
        ];
        return view ('admin.kendaraan.edit', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_item' => 'required',
            'deskripsi_item' => 'required',
        ],[
            'nama_item.required'=>'Nama Kendaraan Wajib terisi',
            'deskripsi_item.required'=>'Deskripsi Kendaraan wajib terisi',
        ]);
    
   
    // Ganti Foto
    if($request->foto_item <> null){
        $file = $request->foto_item;
        $filename= $file->extension();   
        $file->move(public_path('foto/dm/kendaraan'),$filename);
        $data['foto_item'] = $filename;
        $this->item->editData($request->id_item, $data);
    }

    //field form
    $data = [
        'nama_item'=> $request->nama_item,
        'deskripsi_item'=> $request->deskripsi_item,
    ];
    $this->item->editData($request->id_item, $data);

    $data_kendaraan = [
        'merk_kendaraan'=> $request->nama_item,
        'tipe_kendaraan'=> $request->tipe_kendaraan,
        'plat_kendaraan'=> $request->plat_kendaraan,
        'warna_kendaraan'=> $request->warna_kendaraan,
    ];
    $this->kendaraan->editData($request->id_item, $data_kendaraan);

    return redirect()->route('dm.kendaraan.index')->with('success','Barang berhasil diupdate.');
    }
    
}
