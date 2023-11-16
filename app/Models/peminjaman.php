<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class peminjaman extends Model
{
    use HasFactory;

    public function allData()
    {
        return DB::table('peminjaman')->get();
    }

    public function addData($data)
    {
        DB::table('peminjaman')->insert($data);
    }

    public function updatePeminjaman($id_peminjaman, $data)
    {
        return DB::table('peminjaman')->where('id_peminjaman', $id_peminjaman)->update($data);
    }
    
    public function checkID()
    {
        return DB::table('peminjaman')->count();
    }
    public function maxIdPeminjaman()
    {
        return DB::table('peminjaman')->max('id_peminjaman');
    }

    public function myData($id)
    {
        return DB::table('peminjaman')->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')->where('peminjaman.id_user', $id)->orderBy('waktu_pengajuan', 'DESC')->get();
    }


    public function detailPeminjaman2($id_peminjaman)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->where('id_peminjaman', $id_peminjaman)->first();
    }

    public function tampilPeminjamann($dari, $sampai)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->get();
    }

    public function tampilPeminjamans($dari, $sampai, $filter)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->where('peminjaman.jenis_peminjaman', 'LIKE', '%'.$filter.'%')
        // ->where('peminjaman.jenis_peminjaman', $filter)
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->get();
    }

    public function tampilPeminjamann_Kabag($dari, $sampai)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->where('staff_umum', "Disetujui")
        ->whereNot('dari', "Kepala Bagian")
        ->get();
    }

    public function tampilPeminjamans_Kabag($dari, $sampai, $filter)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->where('peminjaman.jenis_peminjaman', 'LIKE', '%'.$filter.'%')
        // ->where('peminjaman.jenis_peminjaman', $filter)
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->where('staff_umum', "Disetujui")
        ->whereNot('dari', "Kepala Bagian")
        ->get();
    }

    public function tampilPeminjamann_Wadir2($dari, $sampai)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->where('staff_umum', "Disetujui")
        ->where('kepala_bagian', "Disetujui")
        ->whereNot('dari', "Wakil Direktur 2")
        ->get();
    }

    public function tampilPeminjamans_Wadir2($dari, $sampai, $filter)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->where('peminjaman.jenis_peminjaman', 'LIKE', '%'.$filter.'%')
        // ->where('peminjaman.jenis_peminjaman', $filter)
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->where('staff_umum', "Disetujui")
        ->where('kepala_bagian', "Disetujui")
        ->whereNot('dari', "Wakil Direktur 2")
        ->get();
    }

    public function tampilPeminjamann_PengelolaSupir($dari, $sampai)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->where('staff_umum', "Disetujui")
        ->where('kepala_bagian', "Disetujui")
        ->where('wakil_direktur_2', "Disetujui")
        ->get();
    }

    public function tampilPeminjamans_PengelolaSupir($dari, $sampai, $filter)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->where('peminjaman.jenis_peminjaman', 'LIKE', '%'.$filter.'%')
        // ->where('peminjaman.jenis_peminjaman', $filter)
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->where('staff_umum', "Disetujui")
        ->where('kepala_bagian', "Disetujui")
        ->where('wakil_direktur_2', "Disetujui")
        ->get();
    }


  

    public function myPengembalian($id)
    {
        return DB::table('peminjaman')
        ->where('peminjaman.id_user', $id)
        ->where('peminjaman.status_peminjaman', "Pengajuan Diterima")
        ->Orwhere('peminjaman.status_peminjaman', "Proses Pengembalian")
        ->Orwhere('peminjaman.status_peminjaman', "Pengembalian Ditolak")
        ->Orwhere('peminjaman.status_peminjaman', "Pengembalian Diterima")
        ->orderBy('waktu_pengajuan', 'DESC')->get();
    }

    public function Laporan($dari, $sampai)
    {
        return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
        ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
        ->whereBetween('waktu_awal', [$dari, $sampai])
        ->whereBetween('waktu_akhir', [$dari, $sampai])
        ->where('status_peminjaman', "Pengajuan Diterima")
        ->get();
    }



    // Dashboard
        // Admin
        public function totalPengajuan_Peminjaman()
        {
            return DB::table('peminjaman')->count();
        }
        public function totalPengajuanDiterima_Peminjaman()
        {
            return DB::table('peminjaman')->where('status_peminjaman', "Pengajuan Diterima")->count();
        }

        // kabag
        public function totalPengajuan_Kabag()
        {
            return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
            ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
            ->where('staff_umum', "Disetujui")
            ->whereNot('sebagai', "Kepala Bagian")
            ->count();
        }

        public function totalPengajuan_Kabag_Disetujui()
        {
            return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
            ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
            ->where('staff_umum', "Disetujui")
            ->where('kepala_bagian', "Disetujui")
            ->whereNot('sebagai', "Kepala Bagian")
            ->count();
        }

        public function totalPengajuan_Kabag_Ditolak()
        {
            return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
            ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
            ->where('staff_umum', "Disetujui")
            ->whereNot('kepala_bagian', "Disetujui")
            ->whereNot('kepala_bagian', "Proses")
            ->whereNot('sebagai', "Wakil Direktur 2")
            ->count();
        }
        // end kabag

         // wadir2
         public function totalPengajuan_Wadir2()
         {
             return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
             ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
             ->where('staff_umum', "Disetujui")
             ->where('kepala_bagian', "Disetujui")
             ->where('peminjaman.jenis_peminjaman', 'LIKE', '%Kendaraan%')
             ->whereNot('sebagai', "Wakil Direktur 2")
             ->count();
         }
 
         public function totalPengajuan_Wadir2_Disetujui()
         {
             return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
             ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
             ->where('staff_umum', "Disetujui")
             ->where('kepala_bagian', "Disetujui")
             ->where('wakil_direktur_2', "Disetujui")
             ->where('peminjaman.jenis_peminjaman', 'LIKE', '%Kendaraan%')
             ->whereNot('sebagai', "Wakil Direktur 2")
             ->count();
         }
 
         public function totalPengajuan_Wadir2_Ditolak()
         {
             return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
             ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
             ->where('staff_umum', "Disetujui")
             ->where('kepala_bagian', "Disetujui")
             ->where('peminjaman.jenis_peminjaman', 'LIKE', '%Kendaraan%')
             ->whereNot('wakil_direktur_2', "Disetujui")
             ->whereNot('wakil_direktur_2', "Proses")
             ->whereNot('sebagai', "Wakil Direktur 2")
             ->count();
         }
         // end wadir2

           // supir
           public function totalPengajuan_Supir()
           {
               return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
               ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
               ->where('staff_umum', "Disetujui")
               ->where('kepala_bagian', "Disetujui")
               ->where('wakil_direktur_2', "Disetujui")
               ->where('peminjaman.jenis_peminjaman', 'LIKE', '%Supir%')
               ->count();
           }
   
           public function totalPengajuan_Supir_Disetujui()
           {
               return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
               ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
               ->where('staff_umum', "Disetujui")
               ->where('kepala_bagian', "Disetujui")
               ->where('wakil_direktur_2', "Disetujui")
               ->where('peminjaman.jenis_peminjaman', 'LIKE', '%Supir%')
               ->count();
           }
   
           public function totalPengajuan_Supir_Ditolak()
           {
               return DB::table('peminjaman')->join('users', 'peminjaman.id_user','=','users.id')
               ->join('approvals', 'peminjaman.id_peminjaman','=','approvals.id_peminjaman')
               ->where('staff_umum', "Disetujui")
               ->where('kepala_bagian', "Disetujui")
               ->where('wakil_direktur_2', "Disetujui")
               ->where('peminjaman.jenis_peminjaman', 'LIKE', '%Supir%')
               ->whereNot('pengelola_supir', "Disetujui")
               ->whereNot('pengelola_supir', "Proses")
               ->whereNot('sebagai', "Pengelola Supir")
               ->count();
           }
           // end supir

        // user
        public function totalPengajuan_Saya($id)
        {
            return DB::table('peminjaman')->where('id_user', $id)->count();
        }






   

    

   

    

    

}
