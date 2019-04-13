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
            'id'            =>  '1',
            'status'        =>  '1',
            'name'          => 'Administrador',
            'apelido'       => 'Administrador',
            'phone_number'  => '+55 00 00000-0000',
            'country'       => 'BR',
            'email'         => 'administrador@ecardume.com.br',
            'password'      => bcrypt('admcardume@123'),
        ]);
    }
}