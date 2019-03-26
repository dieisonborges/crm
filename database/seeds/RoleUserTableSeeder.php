<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        

        Role::find('1')->roleUser()->attach('1');  
        
    }
}
