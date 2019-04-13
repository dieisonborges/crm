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
        

        //Administrador (Todas as Permissões)
        $total_permissions = 73;
        for ($i = 1; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('1');
    
		}

        //Diretoria e-Cardume
        $total_permissions = 73;
        for ($i = 1; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('4');
    
        }

        //Atendimento Geral ao Cliente
        $total_permissions = 32;
        for ($i = 29; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('2');
    
        }

        //Convidados a plataforma
        $total_permissions = 36;
        for ($i = 33; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('3');
    
        }

        //Financeiro - Atendimento ao Cliente
        $total_permissions = 40;
        for ($i = 37; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('5');
    
        }

        //Suporte Técnico - Atendimento ao Cliente
        $total_permissions = 44;
        for ($i = 41; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('6');
    
        }

        //Gerência Geral de Produtos
        $total_permissions = 48;
        for ($i = 45; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('7');
    
        }

        //Gerência de Franquias
        $total_permissions = 52;
        for ($i = 49; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('8');
    
        }

        //Franqueado e-Cardume
        $total_permissions = 56;
        for ($i = 53; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('9');
    
        }

        //Gerência de Score (Pontuação)
        $total_permissions = 60;
        for ($i = 57; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('10');
    
        }

        //Gerência de Conquistas do Usuário
        $total_permissions = 64;
        for ($i = 61; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('11');
    
        }

        //Gerência dos Franqueados VIP e VIP Líder
        $total_permissions = 68;
        for ($i = 65; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('12');
    
        }

        //Gerência de Fornecedores
        $total_permissions = 72;
        for ($i = 69; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('13');
    
        }

        //Gerência de Orçamentos
        $total_permissions = 76;
        for ($i = 73; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('14');
    
        } 

        /* ---------------- Exemplo ---------------- */
        /*
        //
        $total_permissions = ;
        for ($i = ; $i <= $total_permissions; $i++) {
            Permission::find($i)->permissionRole()->attach('');
    
        }
        */   

        
    }
}
