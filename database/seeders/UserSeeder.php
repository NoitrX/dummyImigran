<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Udin',
            'email' => 'Udin@gmail.com',
            'password' => Hash::make('123456'),
            'tanggal_lahir' => '2000-01-01',
            'tempat_lahir' => 'Bogor',
            'alamat' => 'Jalan Ciherang Peuntas RT 02/05',
            'usia' => 25,
            'agama' => 'ISLAM',
            'no_telp' => '081387197080',
            'no_kk' => 320178907652,
            'doc_ktp' => 'ktp.jpg',
            'doc_surat_izin' => 'surat_izin.jpg',
            'status_menikah' => 'belom_menikah',
            'foto' => 'foto.jpg'
        ]);
    }
}
