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
  

        //Administrador
        Role::create([
            'id'=>'1',
            'name'=>'adm',
            'label'=>'Administrador',
        ]);

        //Atendimento Geral ao Cliente
        Role::create([
            'id'=>'2',
            'name'=>'atendimento',
            'label'=>'Atendimento Geral ao Cliente',
        ]);

        //Convidados a plataforma
        Role::create([
            'id'=>'3',
            'name'=>'convite',
            'label'=>'Convidados a plataforma',
        ]);

        //Diretoria e-Cardume
        Role::create([
            'id'=>'4',
            'name'=>'diretoria',
            'label'=>'Diretoria e-Cardume',
        ]);

        //Financeiro - Atendimento ao Cliente
        Role::create([
            'id'=>'5',
            'name'=>'financeiro',
            'label'=>'Financeiro - Atendimento ao Cliente',
        ]);

        //Suporte Técnico - Atendimento ao Cliente
        Role::create([
            'id'=>'6',
            'name'=>'suporte_tecnico',
            'label'=>'Suporte Técnico - Atendimento ao Cliente',
        ]);

        //Gerência Geral de Produtos
        Role::create([
            'id'=>'7',
            'name'=>'produto',
            'label'=>'Gerência Geral de Produtos',
        ]);

        //Gerência de Franquias
        Role::create([
            'id'=>'8',
            'name'=>'franquia',
            'label'=>'Gerência de Franquias',
        ]);

        //Franqueado e-Cardume
        Role::create([
            'id'=>'9',
            'name'=>'franqueado',
            'label'=>'Franqueado e-Cardume',
        ]);

        //Gerência de Score (Pontuação)
        Role::create([
            'id'=>'10',
            'name'=>'score',
            'label'=>'Gerência de Score (Pontuação)',
        ]);

        //Gerência de Conquistas do Usuário
        Role::create([
            'id'=>'11',
            'name'=>'conquista',
            'label'=>'Gerência de Conquistas do Usuário',
        ]);

        //Gerência dos Franqueados VIP e VIP Líder
        Role::create([
            'id'=>'12',
            'name'=>'franqueado_vip',
            'label'=>'Gerência dos Franqueados VIP e VIP Líder',
        ]);

        //Gerência de Fornecedores
        Role::create([
            'id'=>'13',
            'name'=>'fornecedor',
            'label'=>'Gerência de Fornecedores',
        ]);

        //Gerência de Orçamentos
        Role::create([
            'id'=>'14',
            'name'=>'orcamento',
            'label'=>'Gerência de Orçamentos',
        ]);


        /* -------------------- Exemplo ---------------- */
        /*
        //        
        Role::create([
            'id'=>'',
            'name'=>'',
            'label'=>'',
        ]);
        */

        
    }
}
