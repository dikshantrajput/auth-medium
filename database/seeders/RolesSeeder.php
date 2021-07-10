<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name'=>'Super Admin Role',
                'slug'=>'SUPER_ADMIN',
                'desc'=>'Access to admin section',
            ],
            [
                'name'=>'Admin Role',
                'slug'=>'ADMIN',
                'desc'=>'Access to admin section',
            ],
            [
                'name'=>'User Role',
                'slug'=>'USER',
                'desc'=>'User role with access to user section',
            ],
        ]);
    }
}
