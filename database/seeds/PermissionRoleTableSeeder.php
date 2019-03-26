<?php

use Illuminate\Database\Seeder;

use App\Permission;

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
        $total_permissions = 28;
        for ($i = 1; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('1');
    
		}
        
    }
}
