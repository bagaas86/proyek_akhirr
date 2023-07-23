<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\peminjaman;
use App\Models\pengembalian;
use App\Models\item;
use App\Models\keranjang;
use App\Models\kendaraan;
use App\Models\approval;
use App\Models\aktivitas;
use App\Models\pengguna;
use App\Models\supir;
use App\Models\pengaturan;
use DB;
use Auth;
use PDF;
use Carbon\Carbon;
use Twilio\Rest\Client;

class c_peminjaman extends Controller
{
    public function __construct()
    {
        $this->peminjaman = new peminjaman();
        $this->pengembalian = new pengembalian();
        $this->item = new item();
        $this->keranjang = new keranjang();
        $this->kendaraan = new kendaraan();
        $this->approval = new approval();
        $this->pengguna = new pengguna();
        $this->aktivitas = new aktivitas();
        $this->supir = new supir();
        $this->pengaturan = new pengaturan();
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
            'supir' => $this->keranjang->detailPeminjamanSupir($id_peminjaman),
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

        // ambil tanda tangan
        $ttd = $this->pengaturan->detailPengaturan();
        $kabag = $this->pengaturan->joinKabag();
        $umum = $this->pengaturan->joinUmum();
        // end ambil tanda tangan

        // ambil status persetujuan
        $approval = $this->approval->detailData($id_peminjaman);
        // end status persetujuan

        // nomor surat
        $nomor_surat = $request->nomor_surat;
        // end nomor surat

  

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
                'kabag'=> $kabag,
                'umum'=> $umum,
                'approval'=> $approval,
            ];
              $pdf = PDF::loadView('admin.beritaacara.barang', $data)->setPaper('legal', 'potrait');
              $path = public_path('pdf/');
              $fileNameBarang =  'ba_barang'.'-'.$getData->nama_kegiatan.'-'.$now.'.'.'pdf' ;
              $pdf->save($path . '/' . $fileNameBarang);
              $pdf = public_path('pdf/'.$fileNameBarang);
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
                'kabag'=> $kabag,
                'umum'=> $umum,
                'approval'=> $approval,
            ];
            $pdf = PDF::loadView('admin.beritaacara.ruangan', $data)->setPaper('legal', 'potrait');
            $path = public_path('pdf/');
            $fileNameRuangan =  'ba_ruangan'.'-'.$getData->id_peminjaman.'-'.$getData->nama_kegiatan.'-'.$now.'.'.'pdf' ;
            $pdf->save($path . '/' . $fileNameRuangan);
            $pdf = public_path('pdf/'.$fileNameRuangan);
            
            // $beritaRuangan = [
            //     'id_peminjaman' => $id_peminjaman,
            //     'ba_ruangan' => $fileNameRuangan,
            
            // ];
            // $this->beritaacara->editData($id, $beritaRuangan);
            return response()->download($pdf);
        }elseif($request->cek == "Kendaraan")
        {
            $data = [
                'keranjang' => $this->keranjang->detailPeminjamanKendaraan($id_peminjaman),
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
                'kabag'=> $kabag,
                'umum'=> $umum,
                'approval'=> $approval,
                'nomor_surat'=> $nomor_surat,
            ];
              $pdf = PDF::loadView('admin.beritaacara.kendaraan', $data)->setPaper('legal', 'potrait');
          
              $path = public_path('pdf/');
              $fileNameBarang =  'ba_barang'.'-'.$getData->nama_kegiatan.'-'.$now.'.'.'pdf' ;
              $pdf->save($path . '/' . $fileNameBarang);
              $pdf = public_path('pdf/'.$fileNameBarang);
              return response()->download($pdf);
        
        }       
      
    }

    public function tablePeminjaman(Request $request)
    {
      
        $filter = $request->filter;
        $dari = $request->dari." "."00:00:00";
        $sampai = $request->sampai." "."23:59:59";
        if($filter == "Semua")
        {
            $data =[
                'peminjaman'=> $this->peminjaman->tampilPeminjamann($dari, $sampai)
            ];
        }else{
            $data =[
                'peminjaman'=> $this->peminjaman->tampilPeminjamans($dari, $sampai, $filter)
            ];
        }

        return view ('admin.peminjaman.table', $data);
    }


    public function ubahStatus(Request $request, $id_peminjaman)
    {
        $status = $request->status;

        if($status == "Staff Umum"){
            $data = [
                'staff_umum'=> "Disetujui",
            ];
        }elseif($status == "Kepala Bagian"){
            $data = [
                'kepala_bagian'=> "Disetujui",
            ];
        }elseif($status == "Wakil Direktur 2"){
            $data = [
                'wakil_direktur_2'=> "Disetujui",
            ];
        }elseif($status == "Pengelola Supir"){
            $data = [
                'pengelola_supir'=> "Disetujui",
            ];

            $peminjaman = $this->peminjaman->detailPeminjaman2($id_peminjaman);
            // $supirAktivitas = $this->keranjang->detailSupir($id_peminjaman);
            $supirAktivitas = $this->keranjang->sendAktivitas($id_peminjaman);
            foreach ($supirAktivitas as $supir) {
                $tambahAktivitas = [
                    'id_peminjaman' => $supir->id_peminjaman,
                    'id_supir' => $supir->id_supir,
                    'nama_aktivitas' => $peminjaman->nama_kegiatan,
                    'mulai_aktivitas' => $peminjaman->waktu_awal,
                    'selesai_aktivitas' => $peminjaman->waktu_akhir,
                ];
                $this->aktivitas->addData($tambahAktivitas);
            }
            // $tambahAktivitas = [
            //     'id_peminjaman' => $id_peminjaman,
            //     'id_supir' => $supirAktivitas->id_supir,
            //     'nama_aktivitas' => $peminjaman->nama_kegiatan,
            //     'mulai_aktivitas' => $peminjaman->waktu_awal,
            //     'selesai_aktivitas' => $peminjaman->waktu_akhir,
            // ];
            // $this->aktivitas->addData($tambahAktivitas);
        }
        $this->approval->updatePeminjaman($id_peminjaman, $data);
        $approval = $this->otomatis($id_peminjaman);
      
    }

    public function ubahStatusTolak(Request $request, $id_peminjaman)
    {
        $status = $request->status;
        $alasan = $request->alasan;

        if($status == "Staff Umum"){
            $data = [
                'staff_umum'=> $alasan,
            ];
        }elseif($status == "Kepala Bagian"){
            $data = [
                'kepala_bagian'=> $alasan,
            ];
        }elseif($status == "Wakil Direktur 2"){
            $data = [
                'wakil_direktur_2'=> $alasan,
            ];
        }elseif($status == "Pengelola Supir"){
            $data = [
                'pengelola_supir'=> $alasan,
            ];
        }
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
        $checkBarang = $this->keranjang->checkBarang1($id);
        $checkRuangan = $this->keranjang->checkRuangan1($id);
        $checkKendaraan = $this->keranjang->checkKendaraan1($id);
        $checkSupir = $this->keranjang->checkSupir1($id);
        $data = [
            'check1' => $checkBarang,
            'check2' => $checkRuangan,
            'check3' => $checkKendaraan,
            'check4' => $checkSupir,
            'keranjang'=> $this->keranjang->keranjangBarang($id),
            'ruangan'=> $this->keranjang->keranjangRuangan($id),
            'kendaraan'=> $this->keranjang->keranjangKendaraan($id),
            'supir'=> $this->keranjang->keranjangSupir($id),
        ];
        
        return view ('user.peminjaman.list',$data);
    }

    public function kirimPengajuan(Request $request)
    {
       $nama_pj = $request->nama_pj;
       $jenis_peminjaman = $request->jenis_peminjaman;

       $sebagai = Auth::user()->sebagai;
       $id_user = Auth::user()->id;
       $checkidPeminjaman = $this->peminjaman->checkID();
       $id_peminjaman = $checkidPeminjaman + 1;
        // filename
        date_default_timezone_set("Asia/Jakarta");
        $tahun = date("Y");
        $now = date("Y-m-d H:i");
        $file_pengenal = $request->foto_identitas;
        $file_surat_pengajuan = $request->surat_pengajuan;

        $fromdate = date('Y-m-d H:i:s', strtotime($request->fromdate));
        $todate = date('Y-m-d H:i:s', strtotime($request->todate));

        // validasi
        $request->validate([
            'fromdate' => 'required',
            'todate' => 'required',
            'nama_pj' => 'required',
            // 'foto_identitas' => 'mimes:jpg,png,bmp',
            'nama_kegiatan' => 'required',
            // 'no_hp' => 'required',
        ],[
            'fromdate.required'=>'Waktu Awal Peminjaman Wajib terisi',
            'todate.required'=>'Waktu Akhir Peminjaman Wajib terisi',
            'nama_pj.required'=>'Nama Penanggung Jawab Wajib Terisi',
            // 'no_hp.required'=>'Nomor Handphone Wajib terisi',
            // 'foto_identitas.required'=>'Foto Identitas wajib terisi',
            // 'foto_identitas.mimes'=>'Foto Identitas Harus berformat jpg, png, atau bmp',
        ]);

       if($checkidPeminjaman == null){
         if($request->surat_pengajuan == null)
         {
            // $filename_pengenal = $request->nama_pj."-".$tahun.'.'. $file_pengenal->extension();   
            // $file_pengenal->move(public_path('foto/peminjaman/foto_identitas'),$filename_pengenal);
            $data = [
                'id_peminjaman'=> $id_peminjaman,
                'id_user'=> $id_user,
                'jenis_peminjaman' => $request->jenis_peminjaman,
                'waktu_awal'=> $fromdate,
                'waktu_akhir'=> $todate,
                'nama_pj'=> $request->nama_pj,
                'no_identitas'=> $request->no_identitas,
                'no_hp'=> $request->no_hp,
                // 'foto_identitas'=> $filename_pengenal,
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

            $approval = $this->approval($sebagai, $id_peminjaman);
         }else{
            // $filename_pengenal = $request->nama_pj."-".$tahun.'.'. $file_pengenal->extension();   
            // $file_pengenal->move(public_path('foto/peminjaman/foto_identitas'),$filename_pengenal);
            $filename_surat_pengajuan = $request->nama_kegiatan."-".$tahun.'.'. $file_surat_pengajuan->extension();   
            $file_surat_pengajuan->move(public_path('foto/peminjaman/surat_pengajuan'),$filename_surat_pengajuan);
                $data = [
                    'id_peminjaman'=> $id_peminjaman,
                    'id_user'=> $id_user,
                    'jenis_peminjaman' => $request->jenis_peminjaman,
                    'waktu_awal'=> $fromdate,
                    'waktu_akhir'=> $todate,
                    'nama_pj'=> $request->nama_pj,
                    'no_identitas'=> $request->no_identitas,
                    'no_hp'=> $request->no_hp,
                    // 'foto_identitas'=> $filename_pengenal,
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

               $approval = $this->approval($sebagai, $id_peminjaman);
               
         }
         $whatsapp = $this->createNumber($jenis_peminjaman);
        return redirect()->route('dashboard')->with('success','Pengajuan Berhasil Dikirim');

       }else{
        $maxIdPeminjaman = $this->peminjaman->maxIdPeminjaman();
        $id_peminjaman = $maxIdPeminjaman + 1;
        if($request->surat_pengajuan == null){
            // $filename_pengenal = $request->nama_pj."-".$tahun.'.'. $file_pengenal->extension();   
            // $file_pengenal->move(public_path('foto/peminjaman/foto_identitas'),$filename_pengenal);
            $data = [
                'id_peminjaman' => $id_peminjaman,
                'id_user'=> $id_user,
                'jenis_peminjaman' => $request->jenis_peminjaman,
                'waktu_awal'=> $fromdate,
                'waktu_akhir'=> $todate,
                'nama_pj'=> $request->nama_pj,
                'no_identitas'=> $request->no_identitas,
                'no_hp'=> $request->no_hp,
                // 'foto_identitas'=> $filename_pengenal,
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

                $approval = $this->approval($sebagai, $id_peminjaman);
        }else{
            // $filename_pengenal = $request->nama_pj."-".$tahun.'.'. $file_pengenal->extension();   
            // $file_pengenal->move(public_path('foto/peminjaman/foto_identitas'),$filename_pengenal);
            $filename_surat_pengajuan = $request->nama_kegiatan."-".$tahun.'.'. $file_surat_pengajuan->extension();   
            $file_surat_pengajuan->move(public_path('foto/peminjaman/surat_pengajuan'),$filename_surat_pengajuan);
            $data = [
                'id_peminjaman' => $id_peminjaman,
                'id_user'=> $id_user,
                'jenis_peminjaman' => $request->jenis_peminjaman,
                'waktu_awal'=> $fromdate,
                'waktu_akhir'=> $todate,
                'nama_pj'=> $request->nama_pj,
                'no_identitas'=> $request->no_identitas,
                'no_hp'=> $request->no_hp,
                // 'foto_identitas'=> $filename_pengenal,
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

                $approval = $this->approval($sebagai, $id_peminjaman);
           
        }
            // $whatsapp = $this->sendWhatsapp($nama_pj, $jenis_peminjaman, $fromdate, $todate, $no_telepon);
            $whatsapp = $this->createNumber($jenis_peminjaman);
           return redirect()->route('dashboard')->with('success','Pengajuan Berhasil Dikirim');
       }
    }


    public function createNumber($jenis_peminjaman)
    {
        // $jenis_peminjaman = "Barang";
        $kabag = $this->pengaturan->joinKabag();
        $umum = $this->pengaturan->joinUmum();
        // $wadir1 = $this->pengaturan->joinWadir1();
        $wadir2 = $this->pengaturan->joinWadir2();
        $wadir2 = $this->pengaturan->joinWadir2();
        $pengelola_supir = $this->pengaturan->joinPengelolaSupir();


        if($jenis_peminjaman == "Barang" OR $jenis_peminjaman == "Ruangan" OR $jenis_peminjaman == "Barang,Ruangan" )
        {
            $this->sendWhatsapp($umum->no_telepon, $umum->name);
            $this->sendWhatsapp($kabag->no_telepon, $kabag->name);     
        }elseif($jenis_peminjaman == "Kendaraan" OR $jenis_peminjaman == "Barang,Kendaraan" OR $jenis_peminjaman == "Ruangan,Kendaraan" OR $jenis_peminjaman == "Barang,Ruangan,Kendaraan"){
            if($wadir2 <> null){
                $this->sendWhatsapp($wadir2->no_telepon, $wadir2->name);
            }
            if($umum <> null){
                $this->sendWhatsapp($umum->no_telepon, $umum->name);
            }
            if($kabag <> null){
                $this->sendWhatsapp($kabag->no_telepon, $kabag->name);
            } 
        }elseif($jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir" OR $jenis_peminjaman == "Barang,Kendaraan,Supir" OR $jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $jenis_peminjaman == "Kendaraan,Supir"){
            if($wadir2 <> null){
                $this->sendWhatsapp($wadir2->no_telepon, $wadir2->name);
            }
            if($umum <> null){
                $this->sendWhatsapp($umum->no_telepon, $umum->name);
            }
            if($kabag <> null){
                $this->sendWhatsapp($kabag->no_telepon, $kabag->name);
            } 
            if($pengelola_supir <> null){
                $this->sendWhatsapp($pengelola_supir->no_telepon, $pengelola_supir->name);
            } 
        }     
    }

   

    public function sendWhatsapp($no_telepon, $name)
    {

        $token = '8233afc8ddee3653c46b286b9ee646bdad641929648039544f80a615edc2cd25';
        $whatsapp_phone = "+62".$no_telepon;
        $message = "Hallo ".$name."\n 1 Peminjaman Masuk! Perlu persetujuan anda \nKunjungi Website https://bmnpolsub.elearningpolsub.com";

        $url = "https://sendtalk-api.taptalk.io/api/v1/message/send_whatsapp";
        $data = [
            "phone" => $whatsapp_phone,
            "messageType" => "text",
            "body" => $message
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "API-Key: $token",
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        curl_exec($curl);
        curl_close($curl);



    }

    // public function sendWhatsapp($nama_pj, $jenis_peminjaman, $fromdate, $todate) 
    // {
    //     $sid = "ACfb515188f6c67480edd55995f3f41f0c";
    //     $token = "641b842a6c43d1c3a08f589abb69b355";
    //     $twilioNumber = "+14155238886";
    //     $recipientNumber = "+6282249025414";
    //     $client = new Client($sid, $token);
    
    //     $message = $client->messages->create(
    //         'whatsapp:' . $recipientNumber, // Replace with the recipient's WhatsApp number
    //         [
    //             'from' => 'whatsapp:' . $twilioNumber,
    //             'body' => 'Hallo, 1 Pengajuan Peminjaman '.$jenis_peminjaman." dilakukan oleh".$nama_pj."\n\n Ayo masuk ke sistem untuk menyetujui peminjaman ini.", // Replace with your desired message
    //         ]
    //     );
    
    //     return response()->json(['message' => 'WhatsApp message sent successfully.', 'messageSid' => $message->sid]);
    // }

    

    public function approval($sebagai, $id_peminjaman)
    {
        if($sebagai == "Bagian Umum"){
            $data_approval = [
                'id_peminjaman'=> $id_peminjaman,
                'wakil_direktur_2'=> "Proses",
                'kepala_bagian'=> "Proses",
                'staff_umum'=> "Disetujui",
                'pengelola_supir'=> "Proses",
               ];
        }elseif($sebagai == "Kepala Bagian"){
            $data_approval = [
                'id_peminjaman'=> $id_peminjaman,
                'wakil_direktur_2'=> "Proses",
                'kepala_bagian'=> "Disetujui",
                'staff_umum'=> "Proses",
                'pengelola_supir'=> "Proses",
               ];
        }elseif($sebagai == "Wakil Direktur 2"){
            $data_approval = [
                'id_peminjaman'=> $id_peminjaman,
                'wakil_direktur_2'=> "Disetujui",
                'kepala_bagian'=> "Proses",
                'staff_umum'=> "Proses",
                'pengelola_supir'=> "Proses",
               ];
        }elseif($sebagai == "Pengelola Supir"){
            $data_approval = [
                'id_peminjaman'=> $id_peminjaman,
                'wakil_direktur_2'=> "Proses",
                'kepala_bagian'=> "Proses",
                'staff_umum'=> "Proses",
                'pengelola_supir'=> "Proses",
               ];
        }else{
            $data_approval = [
                'id_peminjaman'=> $id_peminjaman,
                'wakil_direktur_2'=> "Proses",
                'kepala_bagian'=> "Proses",
                'staff_umum'=> "Proses",
                'pengelola_supir'=> "Proses",
               ];
        }
        $this->approval->addData($data_approval);
      
    }

    public function otomatis($id_peminjaman)
    {
        $ubahStatus = $this->approval->detailData($id_peminjaman);
        if($ubahStatus->jenis_peminjaman == "Barang" OR $ubahStatus->jenis_peminjaman == "Ruangan" OR $ubahStatus->jenis_peminjaman == "Barang,Ruangan" )
        {
            if($ubahStatus->staff_umum == "Disetujui" AND $ubahStatus->kepala_bagian == "Disetujui")
            {
                $data = [
                    'status_peminjaman' => "Pengajuan Diterima"
                ];
                $this->peminjaman->updatePeminjaman($id_peminjaman, $data);

                $pengembalian = [
                    'id_peminjaman' => $id_peminjaman,
                    'status_pengembalian' => "Belum Dikembalikan",
                   ];
                   $this->pengembalian->addData($pengembalian);
            }
        }elseif($ubahStatus->jenis_peminjaman == "Barang,Ruangan,Kendaraan" OR $ubahStatus->jenis_peminjaman == "Barang,Kendaraan" OR $ubahStatus->jenis_peminjaman == "Ruangan,Kendaraan" OR $ubahStatus->jenis_peminjaman == "Kendaraan" OR $ubahStatus->jenis_peminjaman == "Barang,Ruangan,Kendaraan,Supir" OR $ubahStatus->jenis_peminjaman == "Barang,Kendaraan,Supir" OR $ubahStatus->jenis_peminjaman == "Ruangan,Kendaraan,Supir" OR $ubahStatus->jenis_peminjaman == "Kendaraan,Supir")
        {
            if($ubahStatus->staff_umum == "Disetujui" AND $ubahStatus->kepala_bagian == "Disetujui" AND  $ubahStatus->wakil_direktur_2 == "Disetujui")
            {
                $data = [
                    'status_peminjaman' => "Pengajuan Diterima"
                ];
                $this->peminjaman->updatePeminjaman($id_peminjaman, $data);

                $pengembalian = [
                    'id_peminjaman' => $id_peminjaman,
                    'status_pengembalian' => "Belum Dikembalikan",
                   ];
                   $this->pengembalian->addData($pengembalian);
            }
        }

    }   



    // Ajax

    public function resetKeranjang()
    {
        $id = Auth::user()->id;
        $this->keranjang->resetKeranjang($id);
    }

    public function hari(Request $request)
    {
        $data1 = strtotime($request->bulan1);
        $data2 = strtotime($request->bulan2);
        $kalender = CAL_GREGORIAN;
        $bulan = date('m', $data1);
        $tahun = date('Y', $data1);

        $bulan2 = date('m', $data2);
        $tahun2 = date('Y', $data2);

        $hari = cal_days_in_month($kalender, $bulan, $tahun);
        $hari2 = cal_days_in_month($kalender, $bulan2, $tahun2);
        return $hari2;
    }
    
    public function loadItem(Request $request)
    {
        // $toDate = $request->todate;
        // $fromDate = $request->fromdate;
        $fromDate = Carbon::parse($request->fromdate)->translatedFormat('Y-m-d H:i:s');
        $toDate = Carbon::parse($request->todate)->translatedFormat('Y-m-d H:i:s');

        $unusedItems = DB::table('items')
        ->where('items.kondisi_item', 'Ready')
        ->leftJoin('keranjangs', 'items.id_item', '=', 'keranjangs.id_item')
        ->leftJoin('peminjaman', 'keranjangs.id_peminjaman', '=', 'peminjaman.id_peminjaman')
        ->where(function ($query) use ($fromDate, $toDate) {
            $query->where('peminjaman.waktu_awal', '>', $toDate)
                ->orWhere('peminjaman.waktu_akhir', '<', $fromDate)
                ->orWhereNull('peminjaman.id_peminjaman');
        })
        ->orWhereExists(function ($query) use ($fromDate, $toDate) {
            $query->select(DB::raw(1))
                ->from('peminjaman as p')
                ->join('keranjangs as k', function ($join) {
                    $join->on('p.id_peminjaman', '=', 'k.id_peminjaman')
                        ->whereColumn('k.id_item', 'items.id_item')
                        ->where('items.kondisi_item', 'Ready');
                })
                ->where(function ($query) use ($fromDate, $toDate) {
                    $query->where(function ($query) use ($fromDate, $toDate) {
                        $query->where('p.waktu_awal', '>', $toDate)
                            ->orWhere('p.waktu_akhir', '<', $fromDate);
                    })
                    ->orWhere(function ($query) use ($fromDate, $toDate) {
                        $query->where('p.waktu_awal', '<=', $toDate)
                            ->where('p.waktu_akhir', '>=', $fromDate);
                    });
                });
        })
        ->select(
            'items.id_item',
            'items.nama_item',
            'items.jumlah_item',
            'items.kategori_item',
            'items.foto_item',
            DB::raw("CAST(items.jumlah_item - COALESCE(SUM(CASE WHEN peminjaman.waktu_awal <= '{$toDate}' AND peminjaman.waktu_akhir >= '{$fromDate}' THEN keranjangs.jumlah ELSE 0 END), 0) AS UNSIGNED) AS ready_stok")
        )
        ->where('items.jumlah_item', '>', 0)
        ->groupBy('items.id_item', 'items.nama_item', 'items.jumlah_item', 'items.kategori_item',  'items.foto_item')
        ->havingRaw("CAST(items.jumlah_item - COALESCE(SUM(CASE WHEN peminjaman.waktu_awal <= '{$toDate}' AND peminjaman.waktu_akhir >= '{$fromDate}' THEN keranjangs.jumlah ELSE 0 END), 0) AS UNSIGNED) > 0")
        ->distinct()
        ->get();

        
    


            $data = [
                'item' => $unusedItems,
            ];


        // if($filterUser <> "All"){
        //     $data =[
        //         'item'=> $this->item->itemFilter($filterUser),
        //     ];
        // }else{
        //     $data = [
        //         'item'=> $this->item->itemReady(),
        //     ];
        // }
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

    public function tambahSupir(Request $request)
    {
        $id_user = $request->id_user;
        $id_supir = $request->id_supir;
        $checkKeranjangSupir = $this->keranjang->checkKeranjangSupir($id_supir, $id_user);

        if($checkKeranjangSupir == 0)
        {
            $data =[
                'id_user'=>$request->id_user,
                'id_supir'=> $id_supir,
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
        $fromDate = Carbon::parse($request->fromdate)->translatedFormat('Y-m-d H:i:s');
        $toDate = Carbon::parse($request->todate)->translatedFormat('Y-m-d H:i:s');
        
        $detail = $this->keranjang->detailData($id_keranjang);
        $id_item = $detail->id_item;

        $readyStok = DB::table('items')
        ->where('items.kondisi_item', 'Ready')
        ->where('items.id_item', $id_item)
        ->leftJoin('keranjangs', 'items.id_item', '=', 'keranjangs.id_item')
        ->leftJoin('peminjaman', 'keranjangs.id_peminjaman', '=', 'peminjaman.id_peminjaman')
        ->where(function ($query) use ($fromDate, $toDate) {
            $query->where('peminjaman.waktu_awal', '>', $toDate)
                ->orWhere('peminjaman.waktu_akhir', '<', $fromDate)
                ->orWhereNull('peminjaman.id_peminjaman');
        })
        ->orWhereExists(function ($query) use ($fromDate, $toDate, $id_item) {
            $query->select(DB::raw(1))
                ->from('peminjaman as p')
                ->join('keranjangs as k', function ($join) use ($id_item) {
                    $join->on('p.id_peminjaman', '=', 'k.id_peminjaman')
                        ->whereColumn('k.id_item', 'items.id_item')
                        ->where('items.id_item', $id_item)
                        ->where('items.kondisi_item', 'Ready');
                })
                ->where(function ($query) use ($fromDate, $toDate) {
                    $query->where(function ($query) use ($fromDate, $toDate) {
                        $query->where('p.waktu_awal', '>', $toDate)
                            ->orWhere('p.waktu_akhir', '<', $fromDate);
                    })
                    ->orWhere(function ($query) use ($fromDate, $toDate) {
                        $query->where('p.waktu_awal', '<=', $toDate)
                            ->where('p.waktu_akhir', '>=', $fromDate);
                    });
                });
        })
        ->select(
            'items.id_item',
            'items.nama_item',
            'items.jumlah_item',
            'items.kategori_item',
            'items.foto_item',
            DB::raw("CAST(items.jumlah_item - COALESCE(SUM(CASE WHEN peminjaman.waktu_awal <= '{$toDate}' AND peminjaman.waktu_akhir >= '{$fromDate}' THEN keranjangs.jumlah ELSE 0 END), 0) AS UNSIGNED) AS ready_stok")
        )
        ->where('items.jumlah_item', '>', 0)
        ->groupBy('items.id_item', 'items.nama_item', 'items.jumlah_item', 'items.kategori_item',  'items.foto_item')
        ->havingRaw("CAST(items.jumlah_item - COALESCE(SUM(CASE WHEN peminjaman.waktu_awal <= '{$toDate}' AND peminjaman.waktu_akhir >= '{$fromDate}' THEN keranjangs.jumlah ELSE 0 END), 0) AS UNSIGNED) > 0")
        ->first();



        
        // $readyStok = DB::table('items')
        //     ->leftJoin('keranjangs', function ($join) use ($id_item, $id_keranjang) {
        //         $join->on('items.id_item', '=', 'keranjangs.id_item')
        //             ->where('keranjangs.id_keranjang', '<>', $id_keranjang);
        //     })
        //     ->select(
        //         'items.id_item',
        //         'items.nama_item',
        //         'items.jumlah_item',
        //         'items.kategori_item',
        //         'items.foto_item',
        //         DB::raw("CAST(items.jumlah_item - COALESCE(SUM(CASE WHEN keranjangs.id_peminjaman IS NOT NULL THEN keranjangs.jumlah ELSE 0 END), 0) AS UNSIGNED) AS ready_stok")
        //     )
        //     ->where('items.id_item', $id_item)
        //     ->where('items.jumlah_item', '>', 0)
        //     ->groupBy('items.id_item', 'items.nama_item', 'items.jumlah_item', 'items.kategori_item', 'items.foto_item')
        //     ->first();
        
        //     dd($readyStok);
        
        if ($jumlah <= $readyStok->ready_stok) {
            $input = [
                'jumlah' => $jumlah,
            ];
            $this->keranjang->ubahQty($id_keranjang, $id, $input);
            $data = 1;
        }else{
            $data = 2;
        }

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

    public function modalSupir(Request $request)
    {
      
        $fromdate = date('Y-m-d H:i:s', strtotime($request->fromdate));
        $todate = date('Y-m-d H:i:s', strtotime($request->todate));
        // $check = $this->supir->checkSupir($fromdate, $todate);
        
        
        $driversWithoutActivities = DB::table('supir')
        ->leftJoin('aktivitas', 'supir.id_supir', '=', 'aktivitas.id_supir')
        ->where(function ($query) use ($fromdate, $todate) {
            $query->where(function ($query) use ($fromdate, $todate) {
                $query->where('aktivitas.mulai_aktivitas', '>', $todate)
                    ->orWhere('aktivitas.selesai_aktivitas', '<', $fromdate);
            })
            ->orWhereNull('aktivitas.id_supir');
        })
        ->select('supir.*')
        ->distinct()
        ->get();
    

        // $driversWithoutActivities = DB::table('supir')->get();


        // $ready = $this->aktivitas->readySupir($driversWithoutActivities);
        $data = [
            'supir' => $driversWithoutActivities,
        ];

    
   
    
        return view ('user.peminjaman.checkSupir', $data);
    // foreach ($driversWithoutActivities as $driver) {
    //     echo "$driver->id_supir tidak memiliki aktivitas pada rentang tanggal $fromdate sampai $todate.<br>";
    // }

    
    
    
    
    
    
    
        //  $check = $this->supir->allData();
        //  $count = count($check);
        // if($check->isEmpty()){
        //     $data = [
        //         'supir'=> $this->supir->allData(),
        //     ];
        //     return $data;
        // }
        // else{
        //     for ($i=0; $i < $count; $i++) { 
        //         foreach ($check as $data) {
        //             $x = $data->id_supir;
                 
        //         }
              
        //     }
           
            
            

        // }
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
      
       public function test()
       {
        return view('admin.beritaacara.kwitansi');
       }


    



}
