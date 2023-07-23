<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\supir;
use App\Models\aktivitas;
use DB;
use File;
use Carbon\Carbon;
use PDF;

class c_supir extends Controller
{
    public function __construct()
    {
        $this->supir = new supir();
        $this->aktivitas = new aktivitas();
    }

    public function index()
    {
        $data = [
            'supir' => $this->supir->getSupir(),
        ];
        return view('admin.supir.index', $data);
    }

    public function create()
    {
        return view('admin.supir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supir' => 'required',
            'umur_supir' => 'required',
        ],[
            'nama_supir.required'=>'Nama Supir Wajib Terisi',
            'umur_supir.required'=>'Umur Supir Wajib Terisi',
        ]);

        $data = [
            'nama_supir'=> $request->nama_supir,
            'umur_supir'=> $request->umur_supir,
            'status_supir'=> "Aktif",
        ];
        $this->supir->addData($data);
          
        return redirect()->route('supir.kelola.index')->with('success','Supir berhasil ditambahkan');
    }

    public function edit($id_supir)
    {
        $data =[
            'supir'=> $this->supir->detailData($id_supir)
        ];
        return view ('admin.supir.edit', $data);
    }

    public function update(Request $request, $id_supir)
    {
        $request->validate([
            'nama_supir' => 'required',
            'umur_supir' => 'required',
        ],[
            'nama_supir.required'=>'Nama Supir Wajib Terisi',
            'umur_supir.required'=>'Umur Supir Wajib Terisi',
        ]);
      

        $data = [
            'nama_supir'=> $request->nama_supir,
            'umur_supir'=> $request->umur_supir,
            'status_supir'=> "Aktif",
        ];
        $this->supir->editData($id_supir, $data);
        return redirect()->route('supir.kelola.index')->with('success', 'Supir Berhasil diupdate.');

    }

    public function ubahStatus_Supir(Request $request, $id_supir)
    {
        $status = $request->status;
        $data = [
            'status_supir'=> $status
        ];
      
        $this->supir->editData($id_supir, $data);
         return redirect()->route('supir.kelola.index')->with('success', 'Supir Berhasil diupdate.');

      
    }


    // Aktivitas Supir
    public function tampilAktivitas()
    {
        $data = [
            'aktivitas' => $this->aktivitas->joinData()
        ];
        
       return view ('admin.aktivitas.index', $data);
    }

    public function createAktivitas()
    {
        $data = [
            'supir' => $this->supir->allData()
        ];
        return view ('admin.aktivitas.create', $data);
    }

    public function storeAktivitas(Request $request)
    {
        $fromdate = date('Y-m-d H:i:s', strtotime($request->mulai_aktivitas));
        $todate = date('Y-m-d H:i:s', strtotime($request->selesai_aktivitas));
        $request->validate([
            'id_supir' => 'required',
            'nama_aktivitas' => 'required',
            'mulai_aktivitas' => 'required',
            'selesai_aktivitas' => 'required',
        ],[
            'id_supir.required'=>'Nama Supir Wajib Terisi',
            'nama_aktivitas.required'=>'Nama Supir Wajib Terisi',
            'mulai_aktivitas.required'=>'Mulai Aktivitas Wajib Terisi',
            'selesai_aktivitas.required'=>'Selesai Aktivitas Wajib Terisi',
        ]);

        $data = [
            'id_supir'=> $request->id_supir,
            'nama_aktivitas'=> $request->nama_aktivitas,
            'mulai_aktivitas'=> $fromdate,
            'selesai_aktivitas'=> $todate,
        ];
        $this->aktivitas->addData($data);
          
        return redirect()->route('supir.aktivitas.index')->with('success','Aktivitas Supir berhasil ditambahkan');
    }

    public function cetakSurat(Request $request, $id_aktivitas)
    {
        $getData = $this->aktivitas->suratData($id_aktivitas);
        $now = Carbon::now()->format('d-m-Y');
        $nomor_surat = $request->nomor_st;
        $data = [
            'aktivitas' => $getData,
            'now' => $now,
            'nomor_surat' => $nomor_surat,
        ];

        $pdf = PDF::loadView('admin.beritaacara.surat', $data)->setPaper('A4', 'potrait');
        $path = public_path('pdf/');
        $fileNameST =  'Surat Tugas'.'-'.$getData->nama_supir.'-'.$getData->id_aktivitas.'-'.$now.'.'.'pdf' ;
        $pdf->save($path . '/' . $fileNameST);
        $pdf = public_path('pdf/'.$fileNameST);
        return response()->download($pdf);
        // return view ('admin.beritaacara.surat', $data);
    }
}
