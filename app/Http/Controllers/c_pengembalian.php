<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\peminjaman;
use App\Models\pengembalian;
use App\Models\item;
use App\Models\keranjang;
use App\Models\kendaraan;
use App\Models\supir;
use App\Models\ulasan;
use DB;
use Auth;
use PDF;
use Carbon\Carbon;


class c_pengembalian extends Controller
{
    public function __construct()
    {
        $this->peminjaman = new peminjaman();
        $this->pengembalian = new pengembalian();
        $this->item = new item();
        $this->keranjang = new keranjang();
        $this->kendaraan = new kendaraan();
        $this->supir = new supir();
        $this->ulasan = new ulasan();
    }

    // Controller Admin
    public function viewPengembalian()
    {
        return view ('admin.pengembalian.index');
    }

    public function detailPengembalian_Admin($id_peminjaman)
    {
        $data = [
            'keranjang' => $this->keranjang->detailPeminjaman($id_peminjaman),
            'peminjaman'=> $this->pengembalian->detailPeminjaman($id_peminjaman),
            'supir' => $this->keranjang->detailPeminjamanSupir($id_peminjaman),
        ];
        return view ('admin.pengembalian.detail' ,$data);
    }

    public function hari2($id)
    {
        $data = strtotime($id);
        $kalender = CAL_GREGORIAN;
        $bulan = date('m', $data);
        $tahun = date('Y', $data);
        $hari = cal_days_in_month($kalender, $bulan, $tahun);
        return $hari;
    }

    public function tablePengembalian(Request $request)
    {
        
        $filter = $request->filter;
        $dari = $request->dari." "."00:00:00";
        $sampai = $request->sampai." "."23:59:59";
        if($filter == "Semua")
        {
            $data =[
                'pengembalian'=> $this->pengembalian->tampilPengembalian($dari, $sampai),
            ];
        }else{
            $data =[
                'pengembalian'=> $this->pengembalian->tampilPengembalians($dari, $sampai, $filter),
            ];
        }

        return view ('admin.pengembalian.table', $data);
    }

    public function ubahStatus_Pengembalian(Request $request, $id_peminjaman)
    {
        $status = $request->status;
        $alasan = $request->alasan;
        $data = [
            'status_pengembalian'=> $status,
            'alasan'=> $alasan
        ];
      
        $this->pengembalian->editData($id_peminjaman, $data);
    }



    // User
    public function index()
    {
        $id = Auth::user()->id;
        $data =[
            'pengembalian' => $this->peminjaman->myData($id),
        ];

        return view('user.pengembalian.index', $data);
    }

    public function pengembalian()
    {
        $id = Auth::user()->id;

        $data =[
            'pengembalian' => $this->pengembalian->myPengembalian($id),
        ];
        return view('user.pengembalian.pengembalian', $data);
    }

    public function detailPengembalian_User($id_peminjaman)
    {
        $data =[
            'keranjang' => $this->keranjang->detailPeminjaman($id_peminjaman),
            'check' => $this->pengembalian->checkPengembalian($id_peminjaman),
            'pengembalian'=> $this->pengembalian->detailPeminjaman($id_peminjaman),
        ];

        return view('user.pengembalian.detail', $data);
    }
    public function simpangambar($data, $name)
    {
        $img = str_replace('data:image/png;base64,', '', $data);
	    $img = str_replace(' ', '+', $img);
	    $data = base64_decode($img);
        $filename = $name;
        $file = public_path('foto/pengembalian')."/".$filename;
        
        file_put_contents($file, $data);
        return $filename;
    }

    public function laporPengembalian_Ulang($id_peminjaman)
    {
        $data =[
            'keranjang' => $this->keranjang->detailPeminjaman($id_peminjaman),
            'peminjaman'=> $this->peminjaman->detailPeminjaman2($id_peminjaman),
            'supir' => $this->keranjang->detailPeminjamanSupir($id_peminjaman),
        ];
        return view('user.pengembalian.laporUlang', $data);
    }

    public function storePengembalian_Ulang(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d H:i:s");
        $name = "pengembalian_".$request->id_peminjaman.".png";
        $filename = $this->simpangambar($request->bukti_pengembalian, $name);

        $data = [
            'id_peminjaman' => $request->id_peminjaman,
            'deskripsi_pengembalian' => $request->deskripsi_pengembalian,
            'bukti_pengembalian' => $filename,
            'waktu_pengembalian' => $now,
            'status_pengembalian' => "Proses Pengembalian",
        ];
        $this->pengembalian->editData($request->id_peminjaman,$data);
        return redirect()->route('pengembalian.lapor.index');
    }

    public function kirimUlasan( Request $request)
    {
        $now = Carbon::now()->format('d-m-Y');
        $get = $this->peminjaman->detailPeminjaman2($request->id_peminjaman);
        $data = 
        [
            'id_peminjaman' => $request->id_peminjaman,
            'ulasan' => $request->ulasan,
            'id_user'=> $get->id_user,
            'waktu_ulasan' => $now,
        ];
        
        $this->ulasan->addData($data);
    }

    public function dataUlasan($id_user)
    {
        $data = [
            'ulasan' => $this->ulasan->allData($id_user)
        ];
        return view ('admin.peminjaman.ulasan', $data);
    }

    

}
