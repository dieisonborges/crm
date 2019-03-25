<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TOTAL DE PERMISSIONs
        $total_permissions = 20;
        for ($i = 1; $i <= $total_permissions; $i++) {

        	PermissionRole::create([
	            'id'=> $i,
	            'permission_id'	=> $i,
	            'role_id'	=> '1',
	            
	        ]);
    
		}
        
    }
}
