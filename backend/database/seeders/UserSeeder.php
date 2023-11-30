<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list = Permission::create(['name' => 'users.list']);
        $user_view = Permission::create(['name' => 'users.view']);
        $user_create = Permission::create(['name' => 'users.create']);
        $user_update = Permission::create(['name' => 'users.update']);
        $user_delete = Permission::create(['name' => 'users.delete']);
        $user_change_password = Permission::create(['name' => 'users.changePassword']);
        // items
        $item_list = Permission::create(['name' => 'items.list']);
        $item_view = Permission::create(['name' => 'items.view']);
        $item_create = Permission::create(['name' => 'items.create']);
        $item_update = Permission::create(['name' => 'items.update']);
        $item_delete = Permission::create(['name' => 'items.delete']);

        // todays menu
        $todayMenu_create = Permission::create(['name' => 'today_menus.create']);
        $todayMenu_list = Permission::create(['name' => 'today_menus.list']);
        $todayMenu_view = Permission::create(['name' => 'today_menus.view']);

        $todayMenu_update = Permission::create(['name' => 'today_menus.update']);
        $todayMenu_delete = Permission::create(['name' => 'today_menus.delete']);

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            $user_create,
            $user_list,
            $user_update,
            $user_view,
            $user_delete,
            $user_change_password,
            $item_create,
            $item_list,
            $item_update,
            $item_view,
            $item_delete,
            $todayMenu_create,
            $todayMenu_list,
            $todayMenu_view,
            $todayMenu_delete,
            $todayMenu_update,
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'studentId' => '123456789',
            'cardNumber' => '123456789',
        ]);

        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $user_create,
            $user_list,
            $user_update,
            $user_view,
            $user_delete,
            $user_change_password,
            $item_create,
            $item_list,
            $item_update,
            $item_view,
            $item_delete,
            $todayMenu_create,
            $todayMenu_list,
            $todayMenu_view,
            $todayMenu_delete,
            $todayMenu_update,

        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'studentId' => '1234567890',
            'cardNumber' => '1234567890',
        ]);

        $user_role = Role::create(['name' => 'user']);

        $user->assignRole($user_role);
        $user->givePermissionTo([
            $user_view,
            $item_list,
            $item_view,
            $user_change_password,
            $todayMenu_list,
            $todayMenu_view,
        ]);

        $user_role->givePermissionTo([
            $user_view,
            $item_list,
            $item_view,
            $user_change_password,
            $todayMenu_list,
            $todayMenu_view,
        ]);

    }
}
