<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
     
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $user_admin = DB::table('users')->insert([
            'firstName' => 'admin',
            'lastName' => 'adminLastName',
            'username' => 'admin',
            'avatar' => 'noimage.jpg',
            'email' => 'admin'.'@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $user_client = DB::table('users')->insert([
            'firstName' => 'client',
            'lastName' => 'clientLastName',
            'username' => 'client',
            'avatar' => 'noimage.jpg',
            'email' => 'client'.'@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'client']);
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\User',
            'model_id' => 1
        ]);
        User::find(1)->assignRole([$role1->name]);
        User::find(2)->assignRole([$role2->name]);
    }
}
