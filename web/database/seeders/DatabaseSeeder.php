<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin'],
            ['name' => 'Developer'],
            ['name' => 'Tester']            
        ]);

        DB::table('users')->insert([
            ['name' => 'HOP NV1', 'email' => 'hopnv1@vmodev.com', 'password' => bcrypt('123456'), 'role_ids' => '[1,2,3]'],
            ['name' => 'HOP NV2', 'email' => 'hopnv2@vmodev.com', 'password' => bcrypt('123456'), 'role_ids' => '[1,2]'],
            ['name' => 'HOP NV3', 'email' => 'hopnv3@vmodev.com', 'password' => bcrypt('123456'), 'role_ids' => '[2]']
        ]);

        DB::table('routes')->insert([            
            ['name_frontend' => 'social.userFromTokenApi', 'name_backend' => 'social.userFromTokenApi', 'title' => 'Auth Social'],
            ['name_frontend' => 'admin-list', 'name_backend' => 'admin-list', 'title' => 'Admin list'],
            ['name_frontend' => 'admin-create', 'name_backend' => 'admin-create', 'title' => 'create new admin'],
            ['name_frontend' => 'admin-update', 'name_backend' => 'admin-update', 'title' => 'update admin'],
            ['name_frontend' => 'admin-delete', 'name_backend' => 'admin-delete', 'title' => 'delete admin'],
            ['name_frontend' => 'user-list', 'name_backend' => 'user-list', 'title' => 'User list'],
            ['name_frontend' => 'user-create', 'name_backend' => 'user-create', 'title' => 'Create new user'],
            ['name_frontend' => 'user-update', 'name_backend' => 'user-update', 'title' => 'Update user'],
            ['name_frontend' => 'user-delete', 'name_backend' => 'user-delete', 'title' => 'Delete user'],
            ['name_frontend' => 'send-email', 'name_backend' => 'send-email', 'title' => 'Send email'],
            ['name_frontend' => 'multi-upload-images', 'name_backend' => 'multi-upload-images', 'title' => 'Multi upload images'],
        ]);

        DB::table('role_route')->insert([
            ['role_id' => 1, 'route_id' => 1],
            ['role_id' => 1, 'route_id' => 2],
            ['role_id' => 1, 'route_id' => 3],
            ['role_id' => 1, 'route_id' => 3],
            ['role_id' => 1, 'route_id' => 4],
            ['role_id' => 2, 'route_id' => 5],
            ['role_id' => 2, 'route_id' => 9],
            ['role_id' => 2, 'route_id' => 10],
            ['role_id' => 3, 'route_id' => 6],
            ['role_id' => 3, 'route_id' => 7],
            ['role_id' => 3, 'route_id' => 8]
        ]);
    }
}
