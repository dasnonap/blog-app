<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    private $table = 'roles';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Role::where('type', '=', 'admin')->get()->isEmpty()) {
            DB::table($this->table)->insert(
                [
                    'name' => 'Admin',
                    'type' => 'admin'
                ],
            );
        }

        if (Role::where('type', '=', 'user')->get()->isEmpty()) {
            DB::table($this->table)->insert(
                [
                    'name' => 'User',
                    'type' => 'user'

                ]
            );
        }
    }
}
