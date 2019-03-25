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
        //
        Setor::create([
            'id'=>'1',
            'name'      => 'atendimento',
            'label'      => 'Atendimento ao Cliente',
        ]);
    }
}
