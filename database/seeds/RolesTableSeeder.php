<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
		
		Administrador

        */

        //
        Role::create([
            'id'=>'1',
            'name'=>'adm',
            'label'=>'Administrador',
        ]);

        
    }
}
