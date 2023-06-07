<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\unit;
use DB;

class c_unit extends Controller
{
    public function __construct()
    {
        $this->unit = new unit();
       
    }
    public function index()
    {
        $data =[
            'unit'=> $this->unit->allData()
        ];
        return view ('admin.unit.index', $data);
    }

    public function create()
    {
        return view ('admin.unit.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_unit' => 'required|unique:unit,nama_unit',
            'jenis_unit' => 'required',
        ],[
            'nama_unit.required'=>'Nama Unit Wajib Terisi',
            'nama_unit.unique'=>'Nama Unit Sudah Ada',
            'jenis_unit.required'=>'Jenis Unit Wajib Terisi',
        ]);

        $data = [
            'nama_unit'=> $request->nama_unit,
            'jenis_unit'=> $request->jenis_unit,
            'status_unit'=> "Aktif",
        ];
        $this->unit->addData($data);
          
        return redirect()->route('dm.unit.index')->with('success','Unit berhasil ditambahkan');
    }

    public function edit($id_unit)
    {
        $data =[
            'unit'=> $this->unit->detailData($id_unit)
        ];
        return view ('admin.unit.edit', $data);
    }

    public function update(Request $request, $id_unit)
    {
        $validator = $this->unit->detailData($id_unit);
        if($request->nama_unit <> $validator->nama_unit)
        {
            $request->validate([
                'nama_unit' => 'required|unique:unit,nama_unit',
                'jenis_unit' => 'required',
            ],[
                'nama_unit.required'=>'Nama Unit Wajib Terisi',
                'nama_unit.unique'=>'Nama Unit Sudah Ada',
                'jenis_unit.required'=>'Jenis Unit Wajib Terisi',
            ]);
        }else
        {
            $request->validate([
                'nama_unit' => 'required',
                'jenis_unit' => 'required',
            ],[
                'nama_unit.required'=>'Nama Unit Wajib Terisi',
                'nama_unit.unique'=>'Nama Unit Sudah Ada',
                'jenis_unit.required'=>'Jenis Unit Wajib Terisi',
            ]);
        }
      

        $data = [
            'nama_unit'=> $request->nama_unit,
            'jenis_unit'=> $request->jenis_unit,
            'status_unit'=> "Aktif",
        ];
        $this->unit->editData($id_unit, $data);
        return redirect()->route('dm.unit.index')->with('success', 'Unit Berhasil diupdate.');

    }


}
