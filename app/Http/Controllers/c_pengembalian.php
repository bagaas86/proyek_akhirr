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
use App\Models\pengaturan;
use App\Models\foto;
use DB;
use Auth;
use PDF;
use Carbon\Carbon;
use Twilio\Rest\Client;


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
        $this->pengaturan = new pengaturan();
        $this->foto = new foto();
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
        $tujuan = $this->peminjaman->detailPeminjaman2($id_peminjaman);
        $kabag = $this->pengaturan->joinKabag();
        $status = $request->status;
        $alasan = $request->alasan;
        $data = [
            'status_pengembalian'=> $status,
            'alasan'=> $alasan
        ];
      
        $this->pengembalian->editData($id_peminjaman, $data);

        $whatsapp = $this->sendWhatsapp_Confirm($tujuan->name, $tujuan->no_telepon, $tujuan->nama_kegiatan);
        $whatsapp2 = $this->sendWhatsapp_Confirm($kabag->name, $kabag->no_telepon, $tujuan->nama_kegiatan);
    }

    public function feedback(Request $request, $id_peminjaman)
    {
        $data = [
            'alasan' => $request->alasan,
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
        $id_peminjaman = $request->id_peminjaman;
        $name = "pengembalian_".$request->id_peminjaman.".png";
        $filename = $this->simpangambar($request->bukti_pengembalian, $name);

        $file = $request->bukti_video;
        $filename2= "pengembalian_video_".$request->id_peminjaman.".mp4";  
        $file->move(public_path('foto/pengembalian/video'),$filename2);

        $umum = $this->pengaturan->joinUmum();
        $tujuan = $this->peminjaman->detailPeminjaman2($id_peminjaman);

        $data = [
            'id_peminjaman' => $request->id_peminjaman,
            'deskripsi_pengembalian' => $request->deskripsi_pengembalian,
            'bukti_pengembalian' => $filename,
            'bukti_video' => $filename2,
            'waktu_pengembalian' => $now,
            'status_pengembalian' => "Proses Pengembalian",
        ];
        $this->pengembalian->editData($request->id_peminjaman,$data);

        $jumlah_rusak_data = $request->input('jumlah_rusak');
    


        foreach ($jumlah_rusak_data as $id_keranjang => $jumlah_rusak) {
            // Assuming "keranjang" is the table name in the database
            DB::table('keranjangs')
                ->where('id_keranjang', $id_keranjang)
                ->update(['jumlah_rusak' => $jumlah_rusak]);
        }

        // if($bukti_selesai_data <> null){
        //     foreach ($bukti_selesai_data as $id_keranjang => $bukti_selesai) {
        //         $file_item = $request->file('bukti_selesai')[$id_keranjang];
            
        //         // Check if the file exists and is valid
        //         if ($file_item && $file_item->isValid()) {
        //             $filename = $id_keranjang . ".png"; // Change the file extension as needed
                    
        //             // Move the uploaded file to the desired location
        //             $file_item->move(public_path('foto/pengembalian/foto'), $filename);
                    
        //             // Update the database with the file path or other relevant data
        //             DB::table('keranjangs')
        //                 ->where('id_keranjang', $id_keranjang)
        //                 ->update(['bukti_selesai' => $filename]);
        //         } else {
        //             // Handle the case when the file is missing or not valid
        //             echo "File for id_keranjang=$id_keranjang is missing or not valid.";
        //         }
        //     }
    
        // }

        $bukti_selesai_data = $request->file('foto_selesai');

        foreach ($bukti_selesai_data as $id_keranjang => $sets_of_files) {
            DB::table('foto')
            ->where('id_keranjang', $id_keranjang)
            ->where('jenis_foto', "Pengembalian")
            ->delete();
            $i=1;
            foreach ($sets_of_files as $file) {
                // Store the file in the 'foto/pengembalian/foto' directory inside the 'public' disk
                $extension = $file->getClientOriginalExtension(); // Get the file extension (e.g., jpg)
                $filename = $id_keranjang . '_pengembalian_' . $i . '.' . $extension; // Create a unique filename
    
                $file->move(public_path('foto/pengembalian/foto'), $filename);
    
                // Save the file information to the database
                $data = [
                    'id_keranjang' => $id_keranjang,
                    'jenis_foto' => 'Pengembalian',
                    'foto_bukti' => $filename,
                    'tanggal_upload' => $now,
                ];
    
                DB::table('foto')->insert($data);
                $i = $i+1;
            }
        }
        
   
    
        $whatsapp = $this->sendWhatsapp_Lapor($umum->name, $umum->no_telepon, $tujuan->nama_kegiatan);
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

    public function updateItem(Request $request)
    {
        $status= $request->status;
        $data = [
            'selesai' => $status,
        ];
        $this->keranjang->gantiSupir($request->id_keranjang, $data);
    }

    public function lihatBukti($id_keranjang)
    {
        $data = [
            'foto' => $this->foto->getPengembalian($id_keranjang),
            'awal' => $this->foto->getPengambilan($id_keranjang),
        ];

        return view('user.pengembalian.lihatBukti', $data);
    }
    

    public function sendWhatsapp_Lapor($name, $no_telepon, $nama_kegiatan)
    {

        // $token = '8233afc8ddee3653c46b286b9ee646bdad641929648039544f80a615edc2cd25';
        // $whatsapp_phone = "+62".$no_telepon;
        // $message = "Hallo ".$name."\n 1 Peminjaman Masuk! Perlu persetujuan anda \nKunjungi Website https://bmnpolsub.elearningpolsub.com";

        // $url = "https://sendtalk-api.taptalk.io/api/v1/message/send_whatsapp";
        // $data = [
        //     "phone" => $whatsapp_phone,
        //     "messageType" => "text",
        //     "body" => $message
        // ];

        // $curl = curl_init($url);
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // $headers = array(
        //     "API-Key: $token",
        //     "Content-Type: application/json",
        // );
        // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // //for debug only!
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        // curl_exec($curl);
        // curl_close($curl);

        $sid = "ACfb515188f6c67480edd55995f3f41f0c";
        $token = "641b842a6c43d1c3a08f589abb69b355";
        $twilioNumber = "+14155238886";
        $recipientNumber = "+62".$no_telepon;
        $client = new Client($sid, $token);
    
        $message = $client->messages->create(
            'whatsapp:' . $recipientNumber, // Replace with the recipient's WhatsApp number
            [
                'from' => 'whatsapp:' . $twilioNumber,
                'body' => "Hallo ".$name."\n 1 Pelaporan Pengembalian Masuk! Kegiatan ".$nama_kegiatan." \n Info lebih lengkap kunjungi website https://bmnpolsub.elearningpolsub.com",
            ]
        );



    }

    public function sendWhatsapp_Confirm($name, $no_telepon, $nama_kegiatan)
    {

        // $token = '8233afc8ddee3653c46b286b9ee646bdad641929648039544f80a615edc2cd25';
        // $whatsapp_phone = "+62".$no_telepon;
        // $message = "Hallo ".$name."\n 1 Peminjaman Masuk! Perlu persetujuan anda \nKunjungi Website https://bmnpolsub.elearningpolsub.com";

        // $url = "https://sendtalk-api.taptalk.io/api/v1/message/send_whatsapp";
        // $data = [
        //     "phone" => $whatsapp_phone,
        //     "messageType" => "text",
        //     "body" => $message
        // ];

        // $curl = curl_init($url);
        // curl_setopt($curl, CURLOPT_URL, $url);
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // $headers = array(
        //     "API-Key: $token",
        //     "Content-Type: application/json",
        // );
        // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        // //for debug only!
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        // curl_exec($curl);
        // curl_close($curl);

        $sid = "ACfb515188f6c67480edd55995f3f41f0c";
        $token = "641b842a6c43d1c3a08f589abb69b355";
        $twilioNumber = "+14155238886";
        $recipientNumber = "+62".$no_telepon;
        $client = new Client($sid, $token);
    
        $message = $client->messages->create(
            'whatsapp:' . $recipientNumber, // Replace with the recipient's WhatsApp number
            [
                'from' => 'whatsapp:' . $twilioNumber,
                'body' => "Hallo ".$name."\n 1 Pelaporan Pengembalian BMN Kegiatan  ".$nama_kegiatan." telah disetujui. \n Info lebih lengkap kunjungi website https://bmnpolsub.elearningpolsub.com",
            ]
        );



    }



    

}
