<?php

use Illuminate\Database\Seeder;

class MoedasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   
        //Real
        Permission::create([
            'id'=>'1',
            'codigo_alpha'=>'BRL',
            'codigo_num'=>'986',
            'codigo_simbolo'=>'R$',
            'descricao'=>'Real Brasileiro',
        ]);

        //US Dollar
        Permission::create([
            'id'=>'2',
            'codigo_alpha'=>'USD',
            'codigo_num'=>'840',
            'codigo_simbolo'=>'US$',
            'descricao'=>'US Dollar',
        ]);

        //Euro
        Permission::create([
            'id'=>'3',
            'codigo_alpha'=>'EUR',
            'codigo_num'=>'978',
            'codigo_simbolo'=>'€',
            'descricao'=>'Euro',
        ]);

    }
}
