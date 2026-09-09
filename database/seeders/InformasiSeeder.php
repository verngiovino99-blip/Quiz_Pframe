<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataku = [
            [
                'kategori_id' => 1, 
                'judul' => 'Coordination in a Supply Chain', 
                'ringkasan' => 'Analisis SCM untuk PT Indofood CBP Sukses Makmur Tbk.', 
                'isi' => 'Laporan ini membahas implementasi sistem TI seperti ERP/SAP dan analisis strategis untuk meningkatkan koordinasi rantai pasokan dari hulu ke hilir.', 
                'sumber' => 'Laporan Akademik', 
                'status' => 'published'
            ],

            [
                'kategori_id' => 2, 
                'judul' => 'Prescriptive Analytics Reseller', 
                'ringkasan' => 'Analisis pasar menggunakan multi-table Pivot.', 
                'isi' => 'Pemanfaatan fitur Pivot Table di Excel untuk mengidentifikasi pasar yang underperforming dan merumuskan rekomendasi strategi harga.', 
                'sumber' => 'Proyek Analisis Data', 
                'status' => 'draft'
            ],

            [
                'kategori_id' => 3, 
                'judul' => 'Identifikasi Bug Sistematis', 
                'ringkasan' => 'Penerapan 5 Rules of Software Bugs.', 
                'isi' => 'Analisis dan pengujian kualitas perangkat lunak secara sistematis untuk melacak anomali.', 
                'sumber' => 'Catatan SQA', 
                'status' => 'published'
            ],
        ];
        DB::table('informasis')->insert($dataku);
    }
}
