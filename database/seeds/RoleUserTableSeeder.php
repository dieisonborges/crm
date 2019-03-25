<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        RoleUser::create([
            'id'=>'1',
            'role_id'      => '1',
            'user_id'      => '1',
        ]);

        
        
    }
}
