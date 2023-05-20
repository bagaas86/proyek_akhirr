<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\peminjaman;
use App\Models\item;
use App\Models\keranjang;
use App\Models\kendaraan;
use App\Models\approval;
use DB;
use Auth;
use PDF;
use Carbon\Carbon;

class c_peminjaman extends Controller
{
    public function __construct()
    {
        $this->peminjaman = new peminjaman();
        $this->item = new item();
        $this->keranjang = new keranjang();
        $this->kendaraan = new kendaraan();
        $this->approval = new approval();
    }

    // Controller Admin
    public function viewPengajuan()
    {
        return view ('admin.peminjaman.index');
    }

    public function detailPengajuan($id_peminjaman)
    {
        $data = [
            'keranjang' => $this->keranjang->detailPeminjaman($id_peminjaman),
            'peminjaman'=> $this->peminjaman->detailPeminjaman2($id_peminjaman),
        ];
        return view ('admin.peminjaman.detail' ,$data);
    }

    public function cetakBerita(Request $request, $id_peminjaman)
    {
        $getData = $this->peminjaman->detailPeminjaman2($id_peminjaman);

        $waktu_awal = $getData->waktu_awal;
        $waktu_akhir= $getData->waktu_akhir; 

        // waktu peminjaman
        $from = Carbon::parse($waktu_awal)->translatedFormat('l, d F Y');
        $to = Carbon::parse($waktu_akhir)->translatedFormat('l, d F Y');
        // end waktu peminjaman

        // selisih hari
        $startDate = Carbon::parse($waktu_awal);
        $endDate = Carbon::parse($waktu_akhir);
        $diffInDays = $startDate->diffInDays($endDate);
        // end selisih hari

        // pukul
        $jam_mulai = Carbon::parse($waktu_awal)->translatedFormat('H.i');
        $jam_selesai = Carbon::parse($waktu_akhir)->translatedFormat('H.i');
        // end pukul

        // tanggal ke terbilang
        $tanggal = Carbon::now()->format('d');
        $bulan = Carbon::now()->translatedformat('F');
        $tahun =  Carbon::now()->format('Y');
        $now = Carbon::now()->format('d-m-Y');

        $tanggal = $this->penyebut($tanggal);
        $tahun = $this->penyebut($tahun);
        // end tanggal ke terbilang

        if($request->cek == "Barang")
        {
            $data = [
                'keranjang' => $this->keranjang->detailPeminjamanBarang($id_peminjaman),
                'peminjaman'=> $this->peminjaman->detailPeminjaman2($id_peminjaman),
                'from'=> $from, 
                'to'=> $to, 
                'selisih' => $diffInDays+1,
                'jam_mulai'=> $jam_mulai,
                'jam_selesai'=> $jam_selesai,
                'tanggal' => $tanggal,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'now'=> $now,
            ];
              $pdf = PDF::loadView('admin.beritaacara.barang', $data)->setPaper('legal', 'potrait');
              $path = public_path('pdf/');
              $fileName =  'ba_barang'.'-'.$getData->nama_kegiatan.'-'.$now.'.'.'pdf' ;
              $pdf->save($path . '/' . $fileName);
              $pdf = public_path('pdf/'.$fileName);
              return response()->download($pdf);
        
        }elseif($request->cek == "Ruangan"){
            $data = [
                'ruangan' => $this->keranjang->detailPeminjamanRuangan($id_peminjaman),
                'peminjaman'=> $this->peminjaman->detailPeminjaman2($id_peminjaman),
                'from'=> $from, 
                'to'=> $to, 
                'selisih' => $diffInDays+1,
                'jam_mulai'=> $jam_mulai,
                'jam_selesai'=> $jam_selesai,
                'tanggal' => $tanggal,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'now'=> $now,
            ];
            $pdf = PDF::loadView('admin.beritaacara.ruangan', $data)->setPaper('legal', 'potrait');
            $path = public_path('pdf/');
            $fileName =  'ba_ruangan'.'-'.$getData->nama_kegiatan.'-'.$now.'.'.'pdf' ;
            $pdf->save($path . '/' . $fileName);
            $pdf = public_path('pdf/'.$fileName);
            return response()->download($pdf);
        }       
      
    }

    
    public function tableOrmawa()
    {
        $data =[
            'peminjaman'=> $this->peminjaman->tampilPeminjaman(),
        ];
        return view ('admin.peminjaman.tableormawa', $data);
    }

    public function tableDosen()
    {
        $data =[
            'peminjaman'=> $this->peminjaman->tampilPeminjamanDosen(),
        ];
        return view ('admin.peminjaman.tabledosen', $data);
    }

    public function ubahStatus($id_peminjaman)
    {
        $data = [
            'staff_umum'=> "Disetujui",
        ];
        $this->approval->updatePeminjaman($id_peminjaman, $data);
    }

    public function modalCetak($id_peminjaman)
    {
        $checkBarang = $this->keranjang->checkBarang($id_peminjaman);
        $checkRuangan = $this->keranjang->checkRuangan($id_peminjaman);
        $checkKendaraan = $this->keranjang->checkKendaraan($id_peminjaman);
        
        $data = [
            'checkbarang'=> $checkBarang,
            'checkruangan'=> $checkRuangan,
            'checkkendaraan'=> $checkKendaraan,
            'id_peminjaman'=> $id_peminjaman,
        ];
       return view('admin.peminjaman.modalCetak', $data);
    }

    public function modalApproval($id_peminjaman)
    {
        $data = [
            'approval' => $this->approval->detailData($id_peminjaman)
        ];
        return view('admin.peminjaman.modalApproval', $data);
    }


    // End Controller Admin


    // Controller User
    public function index()
    {
        return view ('user.peminjaman.index');
    }

    public function read()
    {
        return view ('user.peminjaman.read');
    }


    public function pengajuanSaya()
    {
        return view ('user.keranjang.index');
    }

    public function listBarang()
    {
        $id = Auth::user()->id;
        $data = [
            'keranjang'=> $this->keranjang->keranjangBarang($id),
            'ruangan'=> $this->keranjang->keranjangRuangan($id),
            'kendaraan'=> $this->keranjang->keranjangKendaraan($id),
        ];
        return view ('user.peminjaman.list',$data);
    }

    public function kirimPengajuan(Request $request)
    {
       $id_user = Auth::user()->id;
       $checkidPeminjaman = $this->peminjaman->checkID();
       $id_peminjaman = $checkidPeminjaman + 1;
        // filename
        date_default_timezone_set("Asia/Jakarta");
        $tahun = date("Y");
        $now = date("Y-m-d h:i");
        $file_pengenal = $request->foto_identitas;
        $file_surat_pengajuan = $request->surat_pengajuan;

        // validasi
        $request->validate([
            'fromdate' => 'required',
            'todate' => 'required',
            'nama_pj' => 'required',
            'no_identitas' => 'required',
            'foto_identitas' => 'required|mimes:jpg,png,bmp',
            'nama_kegiatan' => 'required',
            'no_hp' => 'required',
        ],[
            'fromdate.required'=>'Waktu Awal Peminjaman Wajib terisi',
            'todate.required'=>'Waktu Akhir Peminjaman Wajib terisi',
            'nama_pj.required'=>'Nama Penanggung Jawab Wajib Terisi',
            'no_identitas.required'=>'Nomor Identitas Wajib terisi',
            'no_hp.required'=>'Nomor Handphone Wajib terisi',
            'foto_identitas.required'=>'Foto Identitas wajib terisi',
            'foto_identitas.mimes'=>'Foto Identitas Harus berformat jpg, png, atau bmp',
        ]);

       if($checkidPeminjaman == null){
         if($request->surat_pengajuan == null)
         {
            $filename_pengenal = $request->nama_pj."-".$tahun.'.'. $file_pengenal->extension();   
            $file_pengenal->move(public_path('foto/peminjaman/foto_identitas'),$filename_pengenal);
            $data = [
                'id_peminjaman'=> $id_peminjaman,
                'id_user'=> $id_user,
                'waktu_awal'=> $request->fromdate,
                'waktu_akhir'=> $request->todate,
                'nama_pj'=> $request->nama_pj,
                'no_identitas'=> $request->no_identitas,
                'no_hp'=> $request->no_hp,
                'foto_identitas'=> $filename_pengenal,
                'nama_kegiatan'=> $request->nama_kegiatan,
                'surat_pengajuan'=> "Tanpa Surat Pengajuan",
                'status_peminjaman' => "Proses",
                'waktu_pengajuan'=> $now,
               ];
            $this->peminjaman->addData($data);
    
            $data2 = [
                'id_peminjaman'=> $id_peminjaman, 
            ];
            $this->keranjang->finish($id_user, $data2);

            $data_approval = [
                'id_peminjaman'=> $id_peminjaman,
                'wakil_direktur_1'=> "Proses",
                'wakil_direktur_2'=> "Proses",
                'kepala_bagian'=> "Proses",
                'staff_umum'=> "Proses",
               ];
            $this->approval->addData($data_approval);

         }else{
            $filename_pengenal = $request->nama_pj."-".$tahun.'.'. $file_pengenal->extension();   
            $file_pengenal->move(public_path('foto/peminjaman/foto_identitas'),$filename_pengenal);
            $filename_surat_pengajuan = $request->nama_kegiatan."-".$tahun.'.'. $file_surat_pengajuan->extension();   
            $file_surat_pengajuan->move(public_path('foto/peminjaman/surat_pengajuan'),$filename_surat_pengajuan);
                $data = [
                    'id_peminjaman'=> $id_peminjaman,
                    'id_user'=> $id_user,
                    'waktu_awal'=> $request->fromdate,
                    'waktu_akhir'=> $request->todate,
                    'nama_pj'=> $request->nama_pj,
                    'no_identitas'=> $request->no_identitas,
                    'no_hp'=> $request->no_hp,
                    'foto_identitas'=> $filename_pengenal,
                    'nama_kegiatan'=> $request->nama_kegiatan,
                    'surat_pengajuan'=> $filename_surat_pengajuan,
                    'status_peminjaman' => "Proses",
                    'waktu_pengajuan'=> $now,
                ];
                $this->peminjaman->addData($data);
    
                $data2 = [
                    'id_peminjaman'=> $id_peminjaman, 
                ];
                $this->keranjang->finish($id_user, $data2);

                $data_approval = [
                    'id_peminjaman'=> $id_peminjaman,
                    'wakil_direktur_1'=> "Proses",
                    'wakil_direktur_2'=> "Proses",
                    'kepala_bagian'=> "Proses",
                    'staff_umum'=> "Proses",
                   ];
                $this->approval->addData($data_approval);
         }
        return redirect()->route('dashboard')->with('success','Pengajuan Berhasil Dikirim');

       }else{
        $maxIdPeminjaman = $this->peminjaman->maxIdPeminjaman();
        $id_peminjaman = $maxIdPeminjaman + 1;
        if($request->surat_pengajuan == null){
            $filename_pengenal = $request->nama_pj."-".$tahun.'.'. $file_pengenal->extension();   
            $file_pengenal->move(public_path('foto/peminjaman/foto_identitas'),$filename_pengenal);
            $data = [
                'id_peminjaman' => $id_peminjaman,
                'id_user'=> $id_user,
                'waktu_awal'=> $request->fromdate,
                'waktu_akhir'=> $request->todate,
                'nama_pj'=> $request->nama_pj,
                'no_identitas'=> $request->no_identitas,
                'no_hp'=> $request->no_hp,
                'foto_identitas'=> $filename_pengenal,
                'nama_kegiatan'=> $request->nama_kegiatan,
                'surat_pengajuan'=> "Tanpa Surat Pengajuan",
                'status_peminjaman' => "Proses",
                'waktu_pengajuan'=> $now,
               ];
               $this->peminjaman->addData($data);
                $data2 = [
                    'id_peminjaman'=> $id_peminjaman, 
                ];
                $this->keranjang->finish($id_user, $data2);
        }else{
            $filename_pengenal = $request->nama_pj."-".$tahun.'.'. $file_pengenal->extension();   
            $file_pengenal->move(public_path('foto/peminjaman/foto_identitas'),$filename_pengenal);
            $filename_surat_pengajuan = $request->nama_kegiatan."-".$tahun.'.'. $file_surat_pengajuan->extension();   
            $file_surat_pengajuan->move(public_path('foto/peminjaman/surat_pengajuan'),$filename_surat_pengajuan);
            $data = [
                'id_peminjaman' => $id_peminjaman,
                'id_user'=> $id_user,
                'waktu_awal'=> $request->fromdate,
                'waktu_akhir'=> $request->todate,
                'nama_pj'=> $request->nama_pj,
                'no_identitas'=> $request->no_identitas,
                'no_hp'=> $request->no_hp,
                'foto_identitas'=> $filename_pengenal,
                'nama_kegiatan'=> $request->nama_kegiatan,
                'surat_pengajuan'=> $filename_surat_pengajuan,
                'status_peminjaman' => "Proses",
                'waktu_pengajuan'=> $now,
               ];
               $this->peminjaman->addData($data);
                $data2 = [
                    'id_peminjaman'=> $id_peminjaman, 
                ];
                $this->keranjang->finish($id_user, $data2);
        }
       
           return redirect()->route('dashboard')->with('success','Pengajuan Berhasil Dikirim');
       }
    }

    // Ajax
    
    public function loadItem(Request $request)
    {
        $filterUser = $request->kategori;
        if($filterUser <> "All"){
            $data =[
                'item'=> $this->item->itemFilter($filterUser),
            ];
        }else{
            $data = [
                'item'=> $this->item->itemReady(),
            ];
        }
        return view('user.peminjaman.table',$data);  
    }


    public function tambahItem(Request $request)
    {
        $id_user = $request->id_user;
        $id_item = $request->id_item;
        $checkKeranjang = $this->keranjang->checkKeranjang($id_item, $id_user);
        if($checkKeranjang == 0)
        {
            $data =[
                'id_user'=>$request->id_user,
                'id_item'=> $request->id_item,
                'jumlah'=> "1",
            ];
            $this->keranjang->addData($data);
            $data = 1;
            return $data;
        }else
         $data = 2;
         return $data;
      
    }

    public function ubahJumlah(Request $request)
    {
        
        $id_keranjang = $request->id_keranjang;
        $id = Auth::user()->id;
        $jumlah = $request->jumlah;
        $data =[
            'jumlah'=>$jumlah,
        ];
        $this->keranjang->ubahQty($id_keranjang, $id, $data);
        $data = 1;
        return $data;
    }

    public function hapusBarang($id_keranjang)
    {
        $this->keranjang->deleteData($id_keranjang);
    }

    public function detailBMN($id_item)
    {
        $data = [
            'item'=>$this->item->detailData($id_item),
            'kendaraan'=>$this->kendaraan->detailData($id_item),
        ];
    
        return view('user.peminjaman.detailbmn', $data);
    }

    public function penyebut($nilai) {
        $nilai = abs($nilai);
        $libs = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
			$n = " ". $libs[$nilai];
		} else if ($nilai <20) {
			$n = self::penyebut($nilai - 10). " Belas";
		} else if ($nilai < 100) {
			$n = self::penyebut($nilai/10)." Puluh". self::penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$n = " Seratus" . self::penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$n = self::penyebut($nilai/100) . " Ratus" . self::penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$n = " Seribu" . self::penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$n = self::penyebut($nilai/1000) . " Ribu" . self::penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$n = self::penyebut($nilai/1000000) . " Juta" . self::penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$n = self::penyebut($nilai/1000000000) . " Milyar" . self::penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$n = self::penyebut($nilai/1000000000000) . " Trilyun" . self::penyebut(fmod($nilai,1000000000000));
		}
        return $n;
       }
      


    



}
