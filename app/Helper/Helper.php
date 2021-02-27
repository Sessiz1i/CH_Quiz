<?php


namespace App\Helper;


use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Helper
{
    public static function getRoles()
    {
        $defaultSystemVars = getVar('system');
        $users = User::all()->pluck('email')->all();
        foreach ($defaultSystemVars as $key => $values) {
            foreach ($values as $value) {
                if ($key == 'default_users') {
                    if (!in_array($value['email'], $users)) {
                        User::create([
                            'name' => $value['name'],
                            'email' => $value['email'],
                            'password' => bcrypt($value['password'])
                        ]);
                    }
                }
            }
        }

        Permission::create(['name' => 'super-admin']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'show-user']);

        $superAdminRole=    Role::create(['name' => 'super_admin']);
        $adminRole =        Role::create(['name' => 'admin']);
        $editorRole=        Role::create(['name' => 'editor']);
        $userRole=          Role::create(['name' => 'user']);

        $superAdminRole->   syncPermissions(Permission::all());
        $adminRole->        syncPermissions('show-user','delete-user','edit-user','create-user');
        $editorRole->       syncPermissions('show-user','edit-user');
        $userRole->         syncPermissions('show-user');

        $super_admin        =   User::whereEmail('superadmin@dingo.com')->first();
        $admin              =   User::whereEmail('admin@dingo.com')->first();
        $editor             =   User::whereEmail('editor@dingo.com')->first();
        $user               =   User::whereEmail('user@dingo.com')->first();

        $super_admin->syncRoles($superAdminRole);
        $admin->syncRoles($adminRole);
        $editor->syncRoles($editorRole);
        $user->syncRoles($userRole);

    }
}

