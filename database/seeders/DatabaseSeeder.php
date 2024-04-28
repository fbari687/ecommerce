<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Member;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Member::create([
            'f_nama' => "Fathul Bari",
            'f_username' => "fbariaja",
            'f_password' => Hash::make('bari123'),
            'f_tempatlahir' => 'Bogor',
            'f_tanggallahir' => "2006-05-09"
        ]);

        Admin::create([
            'f_nama' => "Admin Perpus",
            'f_username' => "admin",
            'f_password' => Hash::make('admin123'),
            'f_level' => 'Admin',
            'f_status' => 'Aktif'
        ]);

        Admin::create([
            'f_nama' => "Pustakawan Perpus",
            'f_username' => "pustakawan",
            'f_password' => Hash::make("pustakawan123"),
            'f_level' => 'Pustakawan',
            'f_status' => 'Aktif'
        ]);
    }
}
