<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Menambahkan user baru dengan username 'admin' dan password 'admin'
        DB::table('users')->insert([
            'user_id' => '1',
            'username' => 'admin',
            'role_id' => 1,
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'user_id' => '2',
            'username' => 'krisna',
            'role_id' => 2,
            'password' => Hash::make('krisna'),
        ]);
        DB::table('users')->insert([
            'user_id' => '3',
            'username' => 'zahro',
            'role_id' => 3,
            'password' => Hash::make('zahro'),
        ]);
        DB::table('role')->insert([
            'role_id' => 1,
            'role_name' => 'admin',
        ]);
        DB::table('poliklinik')->insert([
            'regristasi_baru' => 20000,
            'regristasi_lama' => 10000,
            'nama_poliklinik' => 'laboratorium',
        ]);
        DB::table('role')->insert([
            'role_id' => 2,
            'role_name' => 'dokter',
        ]);
        DB::table('role')->insert([
            'role_id' => 3,
            'role_name' => 'pasien',
        ]);
        DB::table('departemen')->insert([
            'nama_departemen' => 'utama',
        ]);
        DB::table('pegawai')->insert([
            'user_id' => 2,
            'nik' => '1234567890',
            'nama_pegawai' => 'Krisna',
            'jenis_kelamin' => 'Pria',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1990-05-15',
            'alamat' => 'Jl. Contoh Alamat No. 123',
            'photo' => 'photo.jpg',
            'golongan_darah' => 'A',
            'agama' => 'Islam',
            'no_telp' => '081234567890',
            'email' => 'krisna@gmail.com',
            'status_nikah' => 'MENIKAH',
            'pendidikan_terakhir' => 'S1 Teknik Informatika',
            'alumni' => 'Universitas ABC',
            'bank' => 'Bank XYZ',
            'rekening' => '1234567890',
            'status_wajib_pajak' => 'Ya',
            'status_kerja' => 'TET',
            'status_aktif' => 'AKTIF',
            'npwp' => '123456789012345',
            'gaji_pokok' => 10000000,
            'departemen_id' => '1',
            'bidang' => 'Pengembangan',
            'jabatan' => 'Programmer',
            'jenjang_jabatan' => '1',
            'kode_kelompok' => 'K01',
            'kode_resiko' => 'R01',
            'kode_emergency' => 'E01',
            'mulai_kontrak' => null,
            'mulai_kerja' => '2022-01-15',
            'masa_kerja' => 'PT',
            'indexins' => 'IN01',
            'wajibmasuk' => 22,
            'pengurang' => 0,
            'indek' => 0,
            'cuti_diambil' => 0,
            'dankes' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('pasien')->insert([
            'user_id' => 1,
            'nama_pasien' => 'zahro',
            'nik' => '12345678901234567890',
            'jk' => 'P',
            'tmp_lahir' => 'Surabaya',
            'tgl_lahir' => '1995-08-20',
            'nm_ibu' => 'Mary Doe',
            'alamat' => 'Jl. Contoh Alamat No. 456',
            'gol_darah' => 'B',
            'pekerjaan' => 'Pegawai Swasta',
            'status_nikah' => 'menikah',
            'agama' => 'Kristen',
            'tgl_daftar' => '2022-03-10',
            'no_tlp' => '081234567890',
            'umur' => '28 tahun',
            'pnd' => 'S1',
            'keluarga' => 'SUAMI',
            'namakeluarga' => 'John Doe',
            'penjamin' => 'BPJS',
            'no_peserta' => 'P12345678',
            'kd_kelurahan' => 12345,
            'kd_kec' => 678,
            'kd_kab' => 9012,
            'pekerjaanpj' => 'Pegawai Negeri',
            'alamatpj' => 'Jl. Alamat Penanggung Jawab No. 789',
            'kelurahanpj' => 'Kelurahan PJ',
            'kecamatanpj' => 'Kecamatan PJ',
            'kabupatenpj' => 'Kabupaten PJ',
            'perusahaan_pasien' => 'PRSH01',
            'suku_bangsa' => 1,
            'bahasa_pasien' => 2,
            'cacat_fisik' => 0,
            'email' => 'zahro@gmail.com',
            'nip' => '9876543210',
            'kd_prop' => 34,
            'propinsipj' => 'Propinsi PJ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('perawatan')->insert([
            'poliklinik_id' => 1,
            'nama_perawatan' => 'Nama Perawatan 1',
            'bagian_rs' => 100.00,
            'bhp' => 50.00,
            'tarif_perujuk' => 200.00,
            'tarif_tindakan_dokter' => 300.00,
            'tarif_tindakan_petugas' => 150.00,
            'kso' => 50.00,
            'menejemen' => 25.00,
            'total_biaya' => 875.00,
            'kode_pj' => 'XYZ',
            'status' => '1',
            'kelas' => 'Rawat Jalan',
            'kategori' => 'PK',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
