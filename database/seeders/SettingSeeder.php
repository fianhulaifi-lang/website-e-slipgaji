<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        DB::connection('db_induk')->table('settings')->insert([

            // ── KEPEGAWAIAN ──────────────────────────────
            [
                'key'        => 'usia_pensiun',
                'value'      => '55',
                'label'      => 'Usia Pensiun (tahun)',
                'keterangan' => 'Usia pensiun karyawan TETAP. Dihitung otomatis dari tanggal lahir.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'key'        => 'jatah_cuti_default',
                'value'      => '12',
                'label'      => 'Jatah Cuti Default (hari)',
                'keterangan' => 'Jatah cuti yang otomatis terisi saat tambah karyawan baru.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'key'        => 'masa_kontrak_default',
                'value'      => '12',
                'label'      => 'Masa Kontrak Default (bulan)',
                'keterangan' => 'Durasi kontrak default karyawan KONTRAK.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'key'        => 'status_pegawai_options',
                'value'      => 'TETAP,KONTRAK,MAGANG',
                'label'      => 'Pilihan Status Pegawai',
                'keterangan' => 'Pisahkan dengan koma.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'key'        => 'status_aktif_options',
                'value'      => 'AKTIF,NON AKTIF',
                'label'      => 'Pilihan Status Aktif',
                'keterangan' => 'Pisahkan dengan koma.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'key'        => 'golongan_options',
                'value'      => 'IA,IB,IC,ID,IIA,IIB,IIC,IID,IIIA,IIIB,IIIC,IIID,IVA,IVB,IVC,IVD,IVE',
                'label'      => 'Pilihan Golongan',
                'keterangan' => 'Pisahkan dengan koma.',
                'created_at' => now(), 'updated_at' => now(),
            ],

            // ── BANK ─────────────────────────────────────
            [
                'key'        => 'bank_options',
                'value'      => 'BCA,BNI,BRI,Mandiri,BSI,CIMB Niaga,Danamon,BTN,Permata',
                'label'      => 'Pilihan Bank',
                'keterangan' => 'Pisahkan dengan koma.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'key'        => 'max_bank',
                'value'      => '3',
                'label'      => 'Maksimal Jumlah Bank',
                'keterangan' => 'Batas maksimal rekening bank per karyawan.',
                'created_at' => now(), 'updated_at' => now(),
            ],

            // ── ANAK ─────────────────────────────────────
            [
                'key'        => 'max_anak',
                'value'      => '7',
                'label'      => 'Maksimal Jumlah Anak',
                'keterangan' => 'Batas maksimal data anak per karyawan.',
                'created_at' => now(), 'updated_at' => now(),
            ],

            // ── DATA PRIBADI ──────────────────────────────
            [
                'key'        => 'agama_options',
                'value'      => 'Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
                'label'      => 'Pilihan Agama',
                'keterangan' => 'Pisahkan dengan koma.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'key'        => 'status_nikah_options',
                'value'      => 'BELUM MENIKAH,MENIKAH,CERAI',
                'label'      => 'Pilihan Status Nikah',
                'keterangan' => 'Pisahkan dengan koma.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'key'        => 'jaminan_kesehatan_options',
                'value'      => 'tercover,tidak tercover',
                'label'      => 'Pilihan Jaminan Kesehatan',
                'keterangan' => 'Pisahkan dengan koma.',
                'created_at' => now(), 'updated_at' => now(),
            ],

            // ── PENDIDIKAN ────────────────────────────────
            [
                'key'        => 'pendidikan_terakhir_options',
                'value'      => 'SD,SMP,SMA/SMK,D1,D2,D3,S1,S2,S3,Paket C',
                'label'      => 'Pilihan Pendidikan Terakhir',
                'keterangan' => 'Pisahkan dengan koma.',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}