<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list = Permission::create(['name'=>'users.list']);
        $user_view = Permission::create(['name'=>'users.view']);
        $user_create = Permission::create(['name'=>'users.create']);
        $user_update = Permission::create(['name'=>'users.update']);
        $user_delete = Permission::create(['name'=>'users.delete']);
        // items
        $item_list = Permission::create(['name'=>'items.list']);
        $item_view = Permission::create(['name'=>'items.view']);
        $item_create = Permission::create(['name'=>'items.create']);
        $item_update = Permission::create(['name'=>'items.update']);
        $item_delete = Permission::create(['name'=>'items.delete']);


        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            $user_create,
            $user_list,
            $user_update,
            $user_view,
            $user_delete,
            $item_create,
            $item_list,
            $item_update,
            $item_view,
            $item_delete
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $user_create,
            $user_list,
            $user_update,
            $user_view,
            $user_delete,
            $item_create,
            $item_list,
            $item_update,
            $item_view,
            $item_delete
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);

        $user_role = Role::create(['name' => 'user']);

        $user->assignRole($user_role);
        $user->givePermissionTo([
            $user_list,
            $user_view,
            $item_list,
            $item_view,
        ]);

        $user_role->givePermissionTo([
            $user_list,
            $user_view,
            $item_list,
            $item_view,
        ]);



    }
}
