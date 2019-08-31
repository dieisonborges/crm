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
  
        $roles[] = array("name"=>"adm", "label"=>"Administrador");
        $roles[] = array("name"=>"diretoria", "label"=>"Diretoria e-Cardume");
        $roles[] = array("name"=>"atendimento", "label"=>"Atendimento Geral ao Cliente");
        $roles[] = array("name"=>"convite", "label"=>"Convidados a plataforma");
        $roles[] = array("name"=>"financeiro", "label"=>"Financeiro - Atendimento ao Cliente");
        $roles[] = array("name"=>"suporte_tecnico", "label"=>"Suporte Técnico - Atendimento ao Cliente");
        $roles[] = array("name"=>"franquia", "label"=>"Gerência de Franquias");
        $roles[] = array("name"=>"franqueado", "label"=>"Franqueado e-Cardume");
        $roles[] = array("name"=>"score", "label"=>"Gerência de Score (Pontuação)");
        $roles[] = array("name"=>"conquista", "label"=>"Gerência de Conquistas do Usuário");
        $roles[] = array("name"=>"franqueado_vip", "label"=>"Gerência dos Franqueados VIP e VIP Líder");
        $roles[] = array("name"=>"upload", "label"=>"Upload de Arquivos");
        $roles[] = array("name"=>"marketing", "label"=>"Gerência de Marketing");

        //$roles[] = array("name"=>"", "label"=>""); //Modelo
      
        //inicializa contagem de permissions
        $cont_roles = 1;
        foreach($roles as $role){
            Role::create([
                'id'=>$cont_roles,
                'name'=>$role['name'],
                'label'=>$role['label']
            ]);
            $cont_roles++;
        }

    }
    
}
