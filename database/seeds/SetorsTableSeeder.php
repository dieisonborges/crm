<?php

use Illuminate\Database\Seeder;
use App\Setor;

class SetorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Atendimento Geral ao Cliente
        Setor::create([
            'id'=>'1',
            'name'      => 'atendimento',
            'label'      => 'Atendimento Geral ao Cliente',
        ]);

        //Financeiro - Atendimento ao Cliente
        Setor::create([
            'id'=>'2',
            'name'      => 'financeiro',
            'label'      => 'Financeiro - Atendimento ao Cliente',
        ]);

        //Suporte Técnico - Atendimento ao Cliente
        Setor::create([
            'id'=>'3',
            'name'      => 'suporte_tecnico',
            'label'      => 'Suporte Técnico - Atendimento ao Cliente',
        ]);
    }
}
