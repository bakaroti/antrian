<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Poly;
use App\Models\User;
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
        DB::table('users')->truncate();
        DB::table('admins')->truncate();
        // DB::table('polies')->truncate();
        DB::table('doctors')->truncate();
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@argon.com',
            'password' => bcrypt('secret')
        ]);
        User::factory(10)->create();
        Poly::factory(7)->create();
        Doctor::create([
            'user_id' => 1,
            'poly_id' => 1,
        ]);
        Doctor::factory(5)->create();


    }
}
