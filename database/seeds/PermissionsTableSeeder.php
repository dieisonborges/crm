<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        //Permissions --------------------------------------
        $permissions[] = array("name"=>"user", "label"=>"Gerência de Usuários");
        $permissions[] = array("name"=>"role", "label"=>"Gerência de Roles (Regras)");
        $permissions[] = array("name"=>"permission", "label"=>"Gerência de Permissions (Permissões)");
        $permissions[] = array("name"=>"categoria", "label"=>"Gerência de Categorias");
        $permissions[] = array("name"=>"ticket", "label"=>"Gerência de Tickets");
        $permissions[] = array("name"=>"setor", "label"=>"Gerência de Setores");
        $permissions[] = array("name"=>"log", "label"=>"Gerência de Logs de Sistema");
        $permissions[] = array("name"=>"atendimento", "label"=>"Gerência de Atendimentos");
        $permissions[] = array("name"=>"convite", "label"=>"Convidados a plataforma");
        $permissions[] = array("name"=>"financeiro", "label"=>"Financeiro - Atendimento ao Cliente");
        $permissions[] = array("name"=>"suporte_tecnico", "label"=>"Suporte Técnico - Atendimento ao Cliente");
        $permissions[] = array("name"=>"franquia", "label"=>"Gerência de Franquias");
        $permissions[] = array("name"=>"franqueado", "label"=>"Franqueado e-Cardume");
        $permissions[] = array("name"=>"score", "label"=>"Gerência de Score (Pontuação)");
        $permissions[] = array("name"=>"conquista", "label"=>"Gerência de Conquistas do Usuário");
        $permissions[] = array("name"=>"franqueado_vip", "label"=>"Gerência dos Franqueados VIP e VIP Líder");
        $permissions[] = array("name"=>"upload", "label"=>"Upload de Arquivos");
        $permissions[] = array("name"=>"marketing", "label"=>"Gerência de Marketing");
        
        //$permissions[] = array("name"=>"", "label"=>""); //Modelo

        //inicializa contagem de permissions
        $cont_permission = 1;
        foreach($permissions as $permission){
            //Create
            Permission::create([
                'id'=>$cont_permission,
                'name'=>'create_'.$permission['name'],
                'label'=>'Create - '.$permission['label'],                
            ]);
            $cont_permission++;
            //Read
            Permission::create([
                'id'=>$cont_permission,
                'name'=>'read_'.$permission['name'],
                'label'=>'Read - '.$permission['label'],                
            ]);
            $cont_permission++;
            //Update
            Permission::create([
                'id'=>$cont_permission,
                'name'=>'update_'.$permission['name'],
                'label'=>'Update - '.$permission['label'],                
            ]);
            $cont_permission++;
            //Delete
            Permission::create([
                'id'=>$cont_permission,
                'name'=>'delete_'.$permission['name'],
                'label'=>'Delete - '.$permission['label'],                
            ]);
            $cont_permission++;
        }        


    }
}
