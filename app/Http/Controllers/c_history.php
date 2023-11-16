<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\pengguna;
use App\Models\peminjaman;
use App\Models\item;
use App\Models\keranjang;
use App\Models\approval;
use App\Models\foto;
use DB;
use Auth;

class c_history extends Controller
{
    public function __construct()
    {
        $this->peminjaman = new peminjaman();
        $this->item = new item();
        $this->keranjang = new keranjang();
        $this->approval = new approval();
        $this->foto = new foto();
    }

    public function index()
    {
        $id = Auth::user()->id;
        $data =[
            'history' => $this->peminjaman->myData($id),
        ];
        return view('user.history.index', $data);
    }

    public function history()
    {
        $id = Auth::user()->id;

        $data =[
            'history' => $this->peminjaman->myData($id),
        ];
        return view('user.history.history', $data);
    }

    public function detailHistory($id_peminjaman)
    {
        $data =[
            'keranjang' => $this->keranjang->detailPeminjaman($id_peminjaman),
            'peminjaman'=> $this->peminjaman->detailPeminjaman2($id_peminjaman),
            'approval' => $this->approval->detailData($id_peminjaman),
            'supir' => $this->keranjang->detailPeminjamanSupir($id_peminjaman),
        ];
        
        return view('user.history.detail', $data);
    }

    public function sendBukti_Awal(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $bukti_awal_data = $request->file('foto_awal');

        if($bukti_awal_data <> null){
            foreach ($bukti_awal_data as $id_keranjang => $sets_of_files) {
                DB::table('foto')
                ->where('id_keranjang', $id_keranjang)
                ->where('jenis_foto', "Pengambilan")
                ->delete();
                $i=1;
                foreach ($sets_of_files as $file) {
                    // Store the file in the 'foto/pengembalian/foto' directory inside the 'public' disk
                    $extension = $file->getClientOriginalExtension(); // Get the file extension (e.g., jpg)
                    $filename = $id_keranjang . '_pengambilan_' . $i . '.' . $extension; // Create a unique filename
        
                    $file->move(public_path('foto/peminjaman/foto'), $filename);
        
                    // Save the file information to the database
                    $data = [
                        'id_keranjang' => $id_keranjang,
                        'jenis_foto' => 'Pengambilan',
                        'foto_bukti' => $filename,
                        'tanggal_upload' => $now,
                    ];
        
                    DB::table('foto')->insert($data);
                    $i = $i+1;
                }
            }
            return redirect()->back();
        }
       
       
    }
   
}
