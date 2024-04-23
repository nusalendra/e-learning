<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call([
        //     UserSeeder::class
        // ]);

        DB::table('users')->insert([
            'username' => 'nusalendra',
            'password' => Hash::make('nusalendra'),
            'role' => 'Kepala Sekolah'
        ]);

        DB::table('users')->insert([
            'username' => 'budisetyo',
            'password' => Hash::make('password'),
            'role' => 'Wali Kelas'
        ]);

        DB::table('periode')->insert([
            'tahun_ajaran' => 'Tahun Ajaran 2021/2022',
        ]);

        DB::table('kelas')->insert([
            'nama' => 'Kelas 1',
        ]);

        DB::table('wali_kelas')->insert([
            'user_id' => 2,
            'kelas_id' => 1,
            'nama' => 'budisetyo'
        ]);
    }
}
