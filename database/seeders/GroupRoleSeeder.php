<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role_Group;

class GroupRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=2; $i <= 21; $i++) { 
            DB::table('role_group')->insert(
                [
                    "group_id" => 0, 
                    "role_id" => $i 
                    ]
                );
            }
    }
}
