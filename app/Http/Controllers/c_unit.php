<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\unit;
use DB;
use Auth;

class c_unit extends Controller
{
    public function __construct()
    {
        $this->unit = new unit();
    }

    public function index()
    {
        $data = [
            'unit' => $this->unit->allData(),
        ];
        return view ('admin.unit.index', $data);
    }

    public function create()
    {
        return view('admin.unit.create');
    }

    public function store(Request $request)
    {
        $data = [
            'nama_unit' => $request->nama_unit,
            'jenis' => $request->jenis,
        ];
        $this->unit->addData($data);

        return redirect()->route('dm.unit.index')->with('success','Unit berhasil ditambahkan');
    }

    public function edit($id_unit)
    {
        $data = [
            'unit' => $this->unit->detailData($id_unit)
        ];
        return view('admin.unit.edit', $data);
    }

    public function update(Request $request, $id_unit)
    {
        $data = [
            'nama_unit' => $request->nama_unit,
            'jenis' => $request->jenis,
        ];
        $this->unit->editData($id_unit, $data);
        return redirect()->route('dm.unit.index')->with('success','Unit berhasil diupdate');
    }
    
}
