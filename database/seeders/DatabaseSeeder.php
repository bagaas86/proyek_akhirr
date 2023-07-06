<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Agata Novi Anindita, S.E.',
            'username' => 'umum',
            'sebagai' => 'Staff Umum',
            'keterangan' => 'Dosen/Staff',
            'foto'=> 'default.png',
            'no_telepon'=> '+6282249025414',
            'status_user' => "Aktif",
            'no_identitas' => '198811052019032015',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        DB::table('users')->insert([
            'name' => 'Wiwik Endah Rahayu, S.TP., M.Si.',
            'username' => 'wadir1',
            'sebagai' => 'Wakil Direktur 1',
            'keterangan' => 'Wakil Direktur 1',
            'foto'=> 'default.png',
            'no_telepon'=> '+6282249025414',
            'status_user' => "Aktif",
            'no_identitas' => '197909152015041000',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        DB::table('users')->insert([
            'name' => 'Nunu Nugraha Purnawan, S.Pd., M.Kom',
            'username' => 'wadir2',
            'sebagai' => 'Wakil Direktur 2',
            'keterangan' => 'Wakil Direktur 2',
            'foto'=> 'default.png',
            'no_telepon'=> '+6282249025414',
            'status_user' => "Aktif",
            'no_identitas' => '197909152015041000',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        DB::table('users')->insert([
            'name' => 'Zaenal Abidin, S.Pd.I., M.Si.',
            'username' => 'kabag',
            'sebagai' => 'Kepala Bagian',
            'keterangan' => 'Kepala Bagian',
            'foto'=> 'default.png',
            'no_telepon'=> '+6282249025414',
            'status_user' => "Aktif",
            'no_identitas' => '196704221996011001',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

    }

}
