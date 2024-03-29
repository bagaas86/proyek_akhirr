<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\item;
use DB;
use File;

class c_ruangan extends Controller
{
    public function __construct()
    {
        $this->item = new item();
       
    }

    public function index()
    {
        $data =[
            'item'=> $this->item->ruanganData()
        ];
        return view ('admin.ruangan.index', $data);
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
        return view ('admin.ruangan.create' ,$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_item' => 'required',
            'lokasi_item' => 'required',
            'kondisi_item' => 'required',
            'deskripsi_item' => 'required',
            'foto_item' => 'mimes:jpg,png',
        ],[
            'nama_item.required'=>'Nama Ruangan Wajib terisi',
            'nama_item.unique'=>'Nama Ruangan Sudah Ada',
            'lokasi_item.required'=>'Lokasi Ruangan Wajib terisi',
            'kondisi_item.required'=>'Kondisi Ruangan Wajib terisi',
            'deskripsi_item.required'=>'Deskripsi Ruangan wajib terisi',
            'foto_item.mimes'=>'Foto Ruangan Harus Berformat JPG or PNG',
            
        ]);

            if($request->foto_item <> null){
                $file = $request->foto_item;
                $filename = $request->nama_item.'.png';   
                $file->move(public_path('foto/dm/ruangan'),$filename);
                $data = [
                    'nama_item'=> $request->nama_item,
                    'lokasi_item'=> $request->lokasi_item,
                    'jumlah_item' => "1",
                    'kondisi_item'=> $request->kondisi_item,
                    'deskripsi_item'=> $request->deskripsi_item,
                    'kategori_item'=>"Ruangan",
                    'foto_item'=> $filename,
                    'item_tersedia' => "1",
                ];
                $this->item->addData($data);
            }else{
                $data = [
                    'nama_item'=> $request->nama_item,
                    'lokasi_item'=> $request->lokasi_item,
                    'jumlah_item' => "1",
                    'kondisi_item'=> $request->kondisi_item,
                    'deskripsi_item'=> $request->deskripsi_item,
                    'kategori_item'=>"Ruangan",
                    'foto_item'=> 'nruangan.png',
                    'item_tersedia' => "1",
                ];
                $this->item->addData($data);
            }
          
            return redirect()->route('dm.ruangan.index')->with('success','Ruangan berhasil ditambahkan');
       
    }

    public function edit($id)
    {
        $data =[
            'item'=> $this->item->detailData($id)
        ];
        return view ('admin.ruangan.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_item' => 'required',
            'lokasi_item' => 'required',
            'kondisi_item' => 'required',
            'deskripsi_item' => 'required',
            'foto_item' => 'mimes:jpg,png',
        ],[
            'nama_item.required'=>'Nama Ruangan Wajib terisi',
            'nama_item.unique'=>'Nama Ruangan Sudah Ada',
            'lokasi_item.required'=>'Lokasi Ruangan Wajib terisi',
            'kondisi_item.required'=>'Kondisi Ruangan Wajib terisi',
            'deskripsi_item.required'=>'Deskripsi Ruangan wajib terisi',
            'foto_item.mimes'=>'Foto Ruangan Harus Berformat JPG or PNG',
            
        ]);
      
       
        // Ganti Foto
        if($request->foto_item <> null){
            $file = $request->foto_item;
            $filename= $request->nama_item.".png";   
            $file->move(public_path('foto/dm/ruangan'),$filename);
            $data['foto_item'] = $filename;
            $this->item->editData($id, $data);
        }

        //field form
        $data = [
            'nama_item'=> $request->nama_item,
            'lokasi_item'=> $request->lokasi_item,
            'kondisi_item'=> $request->kondisi_item,
            'deskripsi_item'=> $request->deskripsi_item,
            'kategori_item'=>"Ruangan",
        ];
        $this->item->editData($id, $data);
        return redirect()->route('dm.ruangan.index')->with('success','Ruangan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = [
            'kondisi_item' => "Dihapus",
        ];
        $this->item->editData($id, $data);    
        return redirect()->route('dm.ruangan.index')->with('success','Ruangan berhasil dihapus.');
    }


}
