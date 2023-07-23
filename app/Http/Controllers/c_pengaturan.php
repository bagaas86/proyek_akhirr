<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengaturan;
use App\Models\pengguna;
use Carbon\Carbon;

class c_pengaturan extends Controller
{
    public function __construct()
    {
        $this->pengaturan = new pengaturan();
        $this->pengguna = new pengguna();
    }

    public function index()
    {
        $bagian_umum = $this->pengguna->bagian_umum();
        $kepala_bagian = $this->pengguna->kepala_bagian();
        $wadir1 = $this->pengguna->wakil_direktur_1();
        $wadir2 = $this->pengguna->wakil_direktur_2();
        $pengelola_supir = $this->pengguna->pengelola_supir();

        $detailPengaturan = $this->pengaturan->detailPengaturan();

    

        $data = [
            'bagian_umum' => $bagian_umum,
            'kepala_bagian' => $kepala_bagian,
            // 'wadir1'    => $wadir1,
            'wadir2'    => $wadir2,
            'supir'     => $pengelola_supir,
            'index'     => $detailPengaturan,
        ];
        return view('admin.pengaturan.index', $data);
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'ttd_kabag' => 'mimes:jpg,png',
            'ttd_bagian_umum' => 'mimes:jpg,png',
            'ttd_pengelola_supir' => 'mimes:jpg,png',
        ],[
            'ttd_kabag.mimes'=>'TTD Harus Berformat JPG atau PNG.',
            'ttd_bagian_umum.mimes'=>'TTD Harus Berformat JPG atau PNG.',
            'ttd_pengelola_supir.mimes'=>'TTD Harus Berformat JPG atau PNG.',
        ]);

        $now = Carbon::now()->format('d-m-Y H:i');
        $file_ttd_kabag = $request->ttd_kabag;
        $file_ttd_bagian_umum = $request->ttd_bagian_umum;
        $file_ttd_pengelola_supir = $request->ttd_pengelola_supir;

        if($file_ttd_kabag <> null)
        {
            $filename_ttd_kabag = 'TTD KABAG'.'.'.$file_ttd_kabag->extension();   
            $file_ttd_kabag->move(public_path('foto/ttd'),$filename_ttd_kabag);
            $data = [
                'ttd_kabag' => $filename_ttd_kabag,
            ];
            $this->pengaturan->editData($data);
        }

        if($file_ttd_bagian_umum <> null)
        {
            $filename_ttd_bagian_umum = 'TTD BAGIAN UMUM'.'.'.$file_ttd_bagian_umum->extension();   
            $file_ttd_bagian_umum->move(public_path('foto/ttd'),$filename_ttd_bagian_umum);
            $data = [
                'ttd_bagian_umum' => $filename_ttd_bagian_umum,
            ];
            $this->pengaturan->editData($data);
        }

        if($file_ttd_pengelola_supir <> null)
        {
            $filename_ttd_pengelola_supir = 'TTD PENGELOLA SUPIR'.'.'.$file_ttd_pengelola_supir->extension();   
            $file_ttd_pengelola_supir->move(public_path('foto/ttd'),$filename_ttd_pengelola_supir);
            $data = [
                'ttd_pengelola_supir' => $filename_ttd_pengelola_supir,
            ];
            $this->pengaturan->editData($data);
        }

        $jabatan = [
            // 'id_wadir1' => $request->id_wadir1,
            'id_wadir2' => $request->id_wadir2,
            'id_kepala_bagian' => $request->id_kepala_bagian,
            'id_bagian_umum' => $request->id_bagian_umum,
            'id_pengelola_supir' => $request->id_pengelola_supir,
            'update_tanggal' => $now,
        ];
        $this->pengaturan->editData($jabatan);

        return redirect()->route('pengaturan.index')->with('success', "Pengaturan Berhasil Diupdate.");
    }
}
