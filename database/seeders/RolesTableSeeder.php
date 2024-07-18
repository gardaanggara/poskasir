<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pengisian Seeder Untuk Role
        DB::table('roles')->insert([
            ['keterangan' => 'Admin'],
            ['keterangan' => 'Kasir']
        ]);
    }
}
