<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('users')->insert([
        'name' => 'Super Admin',
        'email' => 'superadmin@example.com',
        'password' => bcrypt('123123'),
        'group_id' => 0,
    ]);
}

}
