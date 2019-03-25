<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'id'=>'1',
            'name'      => 'Administrador',
            'apelido'      => 'Administrador',
            'email'     => 'administrador@ecardume.com.br',
            'password'  => bcrypt('ecardume@123'),
        ]);
    }
}