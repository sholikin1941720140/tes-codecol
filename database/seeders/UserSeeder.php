<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = DB::table('users')->insertGetId([
            'role_id' => 1,
            'name' => 'Venina',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email' => 'venina@gmail.com',
            'created_at' => '12-12-2012 00:00:00',
            'updated_at' => '12-12-2012 00:00:00',
        ]);

        $rendra = DB::table('users')->insertGetId([
            'role_id' => 2,
            'name' => 'Rendra',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email' => 'rendragituloh@gmail.com',
            'created_at' => '12-12-2012 00:00:00',
            'updated_at' => '12-12-2012 00:00:00',
        ]);

        $khariz = DB::table('users')->insertGetId([
            'role_id' => 2,
            'name' => 'Khariz',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email' => 'kharizajaah@gmail.com',
            'created_at' => '12-12-2012 00:00:00',
            'updated_at' => '12-12-2012 00:00:00',
        ]);

        $joko = DB::table('users')->insertGetId([
            'role_id' => 2,
            'name' => 'Joko',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email' => 'jokoterdepan@gmail.com',
            'created_at' => '12-12-2012 00:00:00',
            'updated_at' => '12-12-2012 00:00:00',
        ]);

        $mariyam = DB::table('users')->insertGetId([
            'role_id' => 2,
            'name' => 'Mariyam',
            'status' => 'active',
            'password' => Hash::make('password'),
            'email' => 'maiyamyuk@gmail.com',
            'created_at' => '12-12-2012 00:00:00',
            'updated_at' => '12-12-2012 00:00:00',
        ]);

        DB::table('employees')->insert([
            [
                'user_id' => $admin,
                'dob' => '1990-01-01',
                'city' => 'Jakarta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $rendra,
                'dob' => '11-11-2011',
                'city' => 'Jogja',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $khariz,
                'dob' => '12-12-2012',
                'city' => 'Bantul',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $joko,
                'dob' => '10-10-2010',
                'city' => 'Sleman',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $mariyam,
                'dob' => '09-09-2009',
                'city' => 'Gunung Kidul',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
