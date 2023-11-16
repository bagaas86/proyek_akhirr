<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\item;
use App\Models\peminjaman;
use App\Models\pengguna;
use App\Models\pengembalian;
use App\Models\pengaturan;
use App\Models\supir;
use DB;

class c_login extends Controller
{


    public function errorPage()
    {
        $this->item = new item();
        $this->pengaturan= new pengaturan();
        $data = [
            'item' => $this->item->itemReady(),
            'umum' => $this->pengaturan->joinUmum(),
        ];
        return view('v_landingPage', $data);
    }
    public function landingPage()
    {
        $this->item = new item();
        $this->pengaturan= new pengaturan();
        $data = [
            'item' => $this->item->itemReady(),
            'umum' => $this->pengaturan->joinUmum(),
        ];

        return view('v_landingPage', $data);
    }

    public function index()
    {
        return view('v_login');
    }


    public function check(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required'=>'Username wajib terisi',
            'password.required'=>'Password wajib terisi',
        ]);
        $user = $request->username;
        $pass = $request->password;

        if(auth()->attempt(array('username'=>$user,'password'=>$pass)))
        {
            return redirect('/dashboard');
        }
        else
        {
            session()->flash('error', 'Username atau password salah');
            return redirect()->back();
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect('/');
        // Auth::logout();
        // $request->session()->flush();
        // return redirect()->route('user.login');
    }

    // Login multiuser
    public function dashboard(){

        $this->peminjaman = new peminjaman();
        $this->item = new item();
        $this->pengguna = new pengguna();
        $this->pengembalian = new pengembalian();
        $this->pengaturan = new pengaturan();
        $this->supir = new supir();
        $id = Auth::user()->id;

        $total_barang = $this->item->totalBarang();
        $total_ruangan = $this->item->totalRuangan();
        $total_kendaraan = $this->item->totalKendaraan();
        $total_pengguna = $this->pengguna->totalPengguna();
        $total_pengembalian = $this->pengembalian->totalPengembalian();
        $tpp = $this->peminjaman->totalPengajuan_Peminjaman();
        $total_peminjaman_saya = $this->peminjaman->totalPengajuan_Saya($id);
        // $tpp_diterima = $this->peminjaman->totalPengajuanDiterima_Peminjaman();

        $pengaturan = $this->pengaturan->detailPengaturan();

        $id_wadir2 = intval($pengaturan->id_wadir2);  
        $id_kepala_bagian  = intval($pengaturan->id_kepala_bagian);   
        $id_bagian_umum = intval($pengaturan->id_bagian_umum);  
        $id_pengelola_supir = intval($pengaturan->id_pengelola_supir);  
        $id_user = Auth::user()->id;

        // kabag
        $total_pengajuan_kabag = $this->peminjaman->totalPengajuan_Kabag();
        $total_pengajuan_kabag_disetujui = $this->peminjaman->totalPengajuan_Kabag_Disetujui();
        $total_pengajuan_kabag_ditolak = $this->peminjaman->totalPengajuan_Kabag_Ditolak();
        // end kabag

        // wadir2
        $total_pengajuan_wadir2 = $this->peminjaman->totalPengajuan_Wadir2();
        $total_pengajuan_wadir2_disetujui = $this->peminjaman->totalPengajuan_Wadir2_Disetujui();
        $total_pengajuan_wadir2_ditolak = $this->peminjaman->totalPengajuan_Wadir2_Ditolak();
        // end wadir2

        // supir
        $total_pengajuan_supir= $this->peminjaman->totalPengajuan_Supir();
        $total_pengajuan_supir_disetujui = $this->peminjaman->totalPengajuan_Supir_Disetujui();
        $total_pengajuan_supir_ditolak = $this->peminjaman->totalPengajuan_Supir_Ditolak();
        $total_supir = $this->supir->countSupir();
        // end supir

            if(Auth::user()->sebagai == "Wakil Direktur 2" AND $id_wadir2 == $id_user){
            $data = [
                'total_pengajuan_wadir2' => $total_pengajuan_wadir2,
                'total_pengajuan_wadir2_disetujui' => $total_pengajuan_wadir2_disetujui,
                'total_pengajuan_wadir2_ditolak' => $total_pengajuan_wadir2_ditolak,
                'total_peminjaman_saya' => $total_peminjaman_saya,
                ];
                return view('admin.v_dashboard', $data);
            }elseif(Auth::user()->sebagai == "Admin"){
                  $data = [
                    'total_pengajuan_peminjaman' => $tpp,
                    'total_barang'  => $total_barang,
                    'total_ruangan'  => $total_ruangan,
                    'total_kendaraan'  => $total_kendaraan,
                    'total_pengguna'  => $total_pengguna,
                    'total_pengembalian' => $total_pengembalian,
                    // 'total_pengajuan_diterima_peminjaman' => $tpp_diterima,
                ];
                return view('admin.v_dashboard', $data);
            }
            elseif(Auth::user()->sebagai == "Kepala Bagian" AND $id_kepala_bagian == $id_user){
            $data = [
                'total_pengajuan_kabag' => $total_pengajuan_kabag,
                'total_pengajuan_kabag_disetujui' => $total_pengajuan_kabag_disetujui,
                'total_pengajuan_kabag_ditolak' => $total_pengajuan_kabag_ditolak,
                'total_peminjaman_saya' => $total_peminjaman_saya,
                    ];
                    return view('admin.v_dashboard', $data);
            }
            elseif(Auth::user()->sebagai == "Staff Umum" AND $id_bagian_umum == $id_user){
                $data = [
                            'total_pengajuan_peminjaman' => $tpp,
                            'total_barang'  => $total_barang,
                            'total_ruangan'  => $total_ruangan,
                            'total_kendaraan'  => $total_kendaraan,
                            'total_pengguna'  => $total_pengguna,
                            'total_pengembalian' => $total_pengembalian,
                            'total_peminjaman_saya' => $total_peminjaman_saya,
                            // 'total_pengajuan_diterima_peminjaman' => $tpp_diterima,
                        ];
                        return view('admin.v_dashboard', $data);
            }
            elseif(Auth::user()->sebagai == "Pengelola Supir" AND $id_pengelola_supir == $id_user){
                $data = [
                    'total_pengajuan_supir' => $total_pengajuan_supir,
                    'total_pengajuan_supir_disetujui' => $total_pengajuan_supir_disetujui,
                    'total_pengajuan_supir_ditolak' => $total_pengajuan_supir_ditolak,
                    'total_peminjaman_saya' => $total_peminjaman_saya,
                    'total_supir' => $total_supir,
                        ];
                        return view('admin.v_dashboard', $data);
            }else{
            $data = [
                        'total_peminjaman_saya' => $total_peminjaman_saya,
                    ];
                    return view('user.v_dashboard', $data);
             }

        // if (Auth::user()->sebagai == "Staff Umum" OR Auth::user()->sebagai == "Kepala Bagian" OR Auth::user()->sebagai == "Wakil Direktur 1" OR Auth::user()->sebagai == "Wakil Direktur 2" OR Auth::user()->sebagai == "Pengelola Supir") {
        //     $data = [
        //         'total_pengajuan_peminjaman' => $tpp,
        //         'total_barang'  => $total_barang,
        //         'total_ruangan'  => $total_ruangan,
        //         'total_kendaraan'  => $total_kendaraan,
        //         'total_pengguna'  => $total_pengguna,
        //         'total_pengembalian' => $total_pengembalian,
        //         // 'total_pengajuan_diterima_peminjaman' => $tpp_diterima,
        //     ];
        //     return view('admin.v_dashboard', $data);
        // }else{
        //     $data = [
        //         'total_peminjaman_saya' => $total_peminjaman_saya,
        //     ];
        //     return view('user.v_dashboard', $data);
        // }
       
    }

   
}
