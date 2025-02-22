<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(SetorsTableSeeder::class);
    }

    /*
    For rollback use:

    DELETE FROM logs;
    DELETE FROM role_user;
    DELETE FROM permission_role;    
    DELETE FROM roles;
    DELETE FROM permissions;    
    DELETE FROM setors;
    DELETE FROM users;

    */
}