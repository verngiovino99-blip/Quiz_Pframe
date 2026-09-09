<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $dataku = [
            ['nama' => 'Supply Chain Management'],
            ['nama' => 'Business Intelligence'],
            ['nama' => 'Software Quality Assurance'],
        ];

        DB::table('kategoris')->insert($dataku);
    }
}