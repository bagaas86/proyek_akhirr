<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\item;
use App\Models\keranjang;
use DB;
use File;

class c_barang extends Controller
{

    public function __construct()
    {
        $this->item = new item();
        $this->keranjang = new keranjang();
       
    }
    public function index()
    {
        $data =[
            'item'=> $this->item->barangData()
        ];
        return view ('admin.barang.index', $data);
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
        return view ('admin.barang.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => 'required',
            'lokasi_item' => 'required',
            'jumlah_item' => 'required',
            'kondisi_item' => 'required',
            'deskripsi_item' => 'required',
            'foto_item' => 'mimes:jpg,png',
        ],[
            'nama_item.required'=>'Nama Barang Wajib terisi',
            'lokasi_item.required'=>'Lokasi Barang Wajib terisi',
            'jumlah_item.required'=>'Jumlah Barang wajib terisi',
            'kondisi_item.required'=>'Kondisi Barang Wajib terisi',
            'deskripsi_item.required'=>'Deskripsi Barang wajib terisi',
            'foto_item.mimes'=>'Foto Barang Harus Berformat JPG or PNG',
        ]);

            if($request->foto_item <> null){
                $file = $request->foto_item;
                $filename = $request->nama_item.'.png';   
                $file->move(public_path('foto/dm/barang'),$filename);
                $data = [
                    'id_item' => $request->id_item,
                    'nama_item'=> $request->nama_item,
                    'lokasi_item'=> $request->lokasi_item,
                    'jumlah_item' => $request->jumlah_item,
                    'kondisi_item'=> $request->kondisi_item,
                    'deskripsi_item'=> $request->deskripsi_item,
                    'kategori_item'=>"Barang",
                    'item_tersedia'=>$request->jumlah_item,
                    'foto_item'=> $filename
                ];
                $this->item->addData($data);
            }else{
                $data = [
                    'id_item' => $request->id_item,
                    'nama_item'=> $request->nama_item,
                    'lokasi_item'=> $request->lokasi_item,
                    'jumlah_item' => $request->jumlah_item,
                    'kondisi_item'=> $request->kondisi_item,
                    'deskripsi_item'=> $request->deskripsi_item,
                    'kategori_item'=>"Barang",
                    'foto_item'=> 'nbarang.png',
                    'item_tersedia'=>$request->jumlah_item,
                ];
                $this->item->addData($data);
            }
          
            return redirect()->route('dm.barang.index')->with('success','Barang berhasil ditambahkan');
       
    }

    public function edit($id)
    {
        $data =[
            'item'=> $this->item->detailData($id)
        ];
        return view ('admin.barang.edit', $data);
    }

    public function detail($id)
    {
        $data =[
            'item'=> $this->item->detailData($id)
        ];
        return view ('admin.barang.detail', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_item' => 'required',
            'lokasi_item' => 'required',
            'jumlah_item' => 'required',
            'kondisi_item' => 'required',
            'deskripsi_item' => 'required',
            'foto_item' => 'mimes:jpg,png',
        ],[
            'nama_item.required'=>'Nama Barang Wajib terisi',
            'lokasi_item.required'=>'Lokasi Barang Wajib terisi',
            'jumlah_item.required'=>'Jumlah Barang wajib terisi',
            'kondisi_item.required'=>'Kondisi Barang Wajib terisi',
            'deskripsi_item.required'=>'Deskripsi Barang wajib terisi',
            'foto_item.mimes'=>'Foto Barang Harus Berformat JPG or PNG',
        ]);
        
       
        // Ganti Foto
        if($request->foto_item <> null){
            $file = $request->foto_item;
            $filename= $request->nama_item.".png";   
            $file->move(public_path('foto/dm/barang'),$filename);
            $data['foto_item'] = $filename;
            $this->item->editData($id, $data);
        }

        //field form
        $data = [
            'nama_item'=> $request->nama_item,
            'lokasi_item'=> $request->lokasi_item,
            'jumlah_item' => $request->jumlah_item,
            'kondisi_item'=> $request->kondisi_item,
            'deskripsi_item'=> $request->deskripsi_item,
            'kategori_item'=>"Barang",
        ];
        $this->item->editData($id, $data);
        return redirect()->route('dm.barang.index')->with('success','Barang berhasil diupdate.');
    }

    public function destroy($id)
    {
        // $deleteFoto = $this->item->detailData($id);
        // if($deleteFoto->foto_item <> "nbarang.png"){
        //     File::delete('foto/dm/barang/'.$deleteFoto->foto_item);
        // }
        $data = [
            'kondisi_item' => "Dihapus",
        ];
        $this->item->editData($id, $data);
        return redirect()->route('dm.barang.index')->with('success','Barang berhasil dihapus.');
    }
}
