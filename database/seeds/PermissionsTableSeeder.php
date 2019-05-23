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

        //Área - Gerência de Usuários
        //Create
        Permission::create([
            'id'=>'1',
            'name'=>'create_user',
            'label'=>'Create - Gerência de Usuários',
        ]);
        //Read
        Permission::create([
            'id'=>'2',
            'name'=>'read_user',
            'label'=>'Read - Gerência de Usuários',
        ]);
        //Update
        Permission::create([
            'id'=>'3',
            'name'=>'update_user',
            'label'=>'Update - Gerência de Usuários',
        ]);
        //Delete
        Permission::create([
            'id'=>'4',
            'name'=>'delete_user',
            'label'=>'Delete - Gerência de Usuários',
        ]);
        // ------------------------------------------------------------

        //Área - Gerência de Roles (Regras)
        //Create
        Permission::create([
            'id'=>'5',
            'name'=>'create_role',
            'label'=>'Create - Gerência de Roles (Regras)',
        ]);
        //Read
        Permission::create([
            'id'=>'6',
            'name'=>'read_role',
            'label'=>'Read - Gerência de Roles (Regras)',
        ]);
        //Update
        Permission::create([
            'id'=>'7',
            'name'=>'update_role',
            'label'=>'Update - Gerência de Roles (Regras)',
        ]);
        //Delete
        Permission::create([
            'id'=>'8',
            'name'=>'delete_role',
            'label'=>'Delete - Gerência de Roles (Regras)',
        ]);        
        // ------------------------------------------------------------

        //Área - Gerência de Permissions (Permissões)
        //Create
        Permission::create([
            'id'=>'9',
            'name'=>'create_permission',
            'label'=>'Create - Gerência de Permissions (Permissões)',
        ]);
        //Read
        Permission::create([
            'id'=>'10',
            'name'=>'read_permission',
            'label'=>'Read - Gerência de Permissions (Permissões)',
        ]);
        //Update
        Permission::create([
            'id'=>'11',
            'name'=>'update_permission',
            'label'=>'Update - Gerência de Permissions (Permissões)',
        ]);
        //Delete
        Permission::create([
            'id'=>'12',
            'name'=>'delete_permission',
            'label'=>'Delete - Gerência de Permissions (Permissões)',
        ]);        
        // ------------------------------------------------------------

        //Área - Gerência de Categorias
        //Create
        Permission::create([
            'id'=>'13',
            'name'=>'create_categoria',
            'label'=>'Create - Gerência de Categorias',
        ]);
        //Read
        Permission::create([
            'id'=>'14',
            'name'=>'read_categoria',
            'label'=>'Read - Gerência de Categorias',
        ]);
        //Update
        Permission::create([
            'id'=>'15',
            'name'=>'update_categoria',
            'label'=>'Update - Gerência de Categorias',
        ]);
        //Delete
        Permission::create([
            'id'=>'16',
            'name'=>'delete_categoria',
            'label'=>'Delete - Gerência de Categorias',
        ]);        
        // ------------------------------------------------------------

        //Área - Gerência de Tickets
        //Create
        Permission::create([
            'id'=>'17',
            'name'=>'create_ticket',
            'label'=>'Create - Gerência de Tickets',
        ]);
        //Read
        Permission::create([
            'id'=>'18',
            'name'=>'read_ticket',
            'label'=>'Read - Gerência de Tickets',
        ]);
        //Update
        Permission::create([
            'id'=>'19',
            'name'=>'update_ticket',
            'label'=>'Update - Gerência de Tickets',
        ]);
        //Delete
        Permission::create([
            'id'=>'20',
            'name'=>'delete_ticket',
            'label'=>'Delete - Gerência de Tickets',
        ]);        
        // ------------------------------------------------------------

        //Área - Gerência de Setors
        //Create
        Permission::create([
            'id'=>'21',
            'name'=>'create_setor',
            'label'=>'Create - Gerência de Setores',
        ]);
        //Read
        Permission::create([
            'id'=>'22',
            'name'=>'read_setor',
            'label'=>'Read - Gerência de Setores',
        ]);
        //Update
        Permission::create([
            'id'=>'23',
            'name'=>'update_setor',
            'label'=>'Update - Gerência de Setores',
        ]);
        //Delete
        Permission::create([
            'id'=>'24',
            'name'=>'delete_setor',
            'label'=>'Delete - Gerência de Setores',
        ]);        
        // ------------------------------------------------------------

        //Área - Gerência de Logs
        //Create
        Permission::create([
            'id'=>'25',
            'name'=>'create_log',
            'label'=>'Create - Gerência de Logs de Sistema',
        ]);
        //Read
        Permission::create([
            'id'=>'26',
            'name'=>'read_log',
            'label'=>'Read - Gerência de Logs de Sistema',
        ]);
        //Update
        Permission::create([
            'id'=>'27',
            'name'=>'update_log',
            'label'=>'Update - Gerência de Logs de Sistema',
        ]);
        //Delete
        Permission::create([
            'id'=>'28',
            'name'=>'delete_log',
            'label'=>'Delete - Gerência de Logs de Sistema',
        ]);        
        // ------------------------------------------------------------

        //Área - Gerência de Atendimentos
        //Create
        Permission::create([
            'id'=>'29',
            'name'=>'create_atendimento',
            'label'=>'Create - Gerência de Atendimentos',
        ]);
        //Read
        Permission::create([
            'id'=>'30',
            'name'=>'read_atendimento',
            'label'=>'Read - Gerência de Atendimentos',
        ]);
        //Update
        Permission::create([
            'id'=>'31',
            'name'=>'update_atendimento',
            'label'=>'Update - Gerência de Atendimentos',
        ]);
        //Delete
        Permission::create([
            'id'=>'32',
            'name'=>'delete_atendimento',
            'label'=>'Delete - Gerência de Atendimentos',
        ]);        
        // ------------------------------------------------------------

        //Área - Convidados a plataforma 
        //Create        
        Permission::create([
            'id'=>'33',
            'name'=>'create_convite',
            'label'=>'Create -  Convidados a plataforma',
        ]);
        //Read
        Permission::create([
            'id'=>'34',
            'name'=>'read_convite',
            'label'=>'Read -  Convidados a plataforma',
        ]);
        //Update
        Permission::create([
            'id'=>'35',
            'name'=>'update_convite',
            'label'=>'Update -  Convidados a plataforma',
        ]);
        //Delete
        Permission::create([
            'id'=>'36',
            'name'=>'delete_convite',
            'label'=>'Delete -  Convidados a plataforma',
        ]); 
            
        // ------------------------------------------------------------

        //Área - Financeiro 
        //Create
        Permission::create([
            'id'=>'37',
            'name'=>'create_financeiro',
            'label'=>'Create - Financeiro - Atendimento ao Cliente',
        ]);
        //Read
        Permission::create([
            'id'=>'38',
            'name'=>'read_financeiro',
            'label'=>'Read - Financeiro - Atendimento ao Cliente',
        ]);
        //Update
        Permission::create([
            'id'=>'39',
            'name'=>'update_financeiro',
            'label'=>'Update - Financeiro - Atendimento ao Cliente',
        ]);
        //Delete
        Permission::create([
            'id'=>'40',
            'name'=>'delete_financeiro',
            'label'=>'Delete - Financeiro - Atendimento ao Cliente',
        ]); 
           
        // ------------------------------------------------------------

        //Área - Suporte Técnico
        //Create        
        Permission::create([
            'id'=>'41',
            'name'=>'create_suporte_tecnico',
            'label'=>'Create - Suporte Técnico - Atendimento ao Cliente ',
        ]);
        //Read
        Permission::create([
            'id'=>'42',
            'name'=>'read_suporte_tecnico',
            'label'=>'Read - Suporte Técnico - Atendimento ao Cliente ',
        ]);
        //Update
        Permission::create([
            'id'=>'43',
            'name'=>'update_suporte_tecnico',
            'label'=>'Update - Suporte Técnico - Atendimento ao Cliente ',
        ]);
        //Delete
        Permission::create([
            'id'=>'44',
            'name'=>'delete_suporte_tecnico',
            'label'=>'Delete - Suporte Técnico - Atendimento ao Cliente ',
        ]); 
            
        // ------------------------------------------------------------

         //Área - Gerência Geral de Produtos 
        //Create        
        Permission::create([
            'id'=>'45',
            'name'=>'create_produto',
            'label'=>'Create - Gerência Geral de Produtos',
        ]);
        //Read
        Permission::create([
            'id'=>'46',
            'name'=>'read_produto',
            'label'=>'Read - Gerência Geral de Produtos ',
        ]);
        //Update
        Permission::create([
            'id'=>'47',
            'name'=>'update_produto',
            'label'=>'Update - Gerência Geral de Produtos ',
        ]);
        //Delete
        Permission::create([
            'id'=>'48',
            'name'=>'delete_produto',
            'label'=>'Delete - Gerência Geral de Produtos ',
        ]);      
        // ------------------------------------------------------------

        //Área - Gerência de 
        //Create
        Permission::create([
            'id'=>'49',
            'name'=>'create_franquia',
            'label'=>'Create - Gerência de Franquias',
        ]);
        //Read
        Permission::create([
            'id'=>'50',
            'name'=>'read_franquia',
            'label'=>'Read - Gerência de Franquias',
        ]);
        //Update
        Permission::create([
            'id'=>'51',
            'name'=>'update_franquia',
            'label'=>'Update - Gerência de Franquias',
        ]);
        //Delete
        Permission::create([
            'id'=>'52',
            'name'=>'delete_franquia',
            'label'=>'Delete - Gerência de Franquias',
        ]); 
     
        // ------------------------------------------------------------

        //Área - Franqueado e-Cardume 
        //Create
        Permission::create([
            'id'=>'53',
            'name'=>'create_franqueado',
            'label'=>'Create - Franqueado e-Cardume',
        ]);
        //Read
        Permission::create([
            'id'=>'54',
            'name'=>'read_franqueado',
            'label'=>'Read - Franqueado e-Cardume',
        ]);
        //Update
        Permission::create([
            'id'=>'55',
            'name'=>'update_franqueado',
            'label'=>'Update - Franqueado e-Cardume',
        ]);
        //Delete
        Permission::create([
            'id'=>'56',
            'name'=>'delete_franqueado',
            'label'=>'Delete - Franqueado e-Cardume',
        ]); 
   
        // ------------------------------------------------------------

        //Área - Gerência de Score (Pontuação)
        //Create
        Permission::create([
            'id'=>'57',
            'name'=>'create_score',
            'label'=>'Create - Gerência de Score (Pontuação)',
        ]);
        //Read
        Permission::create([
            'id'=>'58',
            'name'=>'read_score',
            'label'=>'Read - Gerência de Score (Pontuação)',
        ]);
        //Update
        Permission::create([
            'id'=>'59',
            'name'=>'update_score',
            'label'=>'Update - Gerência de Score (Pontuação)',
        ]);
        //Delete
        Permission::create([
            'id'=>'60',
            'name'=>'delete_score',
            'label'=>'Delete - Gerência de Score (Pontuação)',
        ]); 
          
        // ------------------------------------------------------------

        //Área - Gerência de Conquistas do Usuário
        //Create
        Permission::create([
            'id'=>'61',
            'name'=>'create_conquista',
            'label'=>'Create - Gerência de Conquistas do Usuário',
        ]);
        //Read
        Permission::create([
            'id'=>'62',
            'name'=>'read_conquista',
            'label'=>'Read - Gerência de Conquistas do Usuário',
        ]);
        //Update
        Permission::create([
            'id'=>'63',
            'name'=>'update_conquista',
            'label'=>'Update - Gerência de Conquistas do Usuário',
        ]);
        //Delete
        Permission::create([
            'id'=>'64',
            'name'=>'delete_conquista',
            'label'=>'Delete - Gerência de Conquistas do Usuário',
        ]); 
     
        // ------------------------------------------------------------

        //Área - Gerência dos Franqueados VIP e VIP Líder
        //Create
        Permission::create([
            'id'=>'65',
            'name'=>'create_franqueado_vip',
            'label'=>'Create - Gerência dos Franqueados VIP e VIP Líder',
        ]);
        //Read
        Permission::create([
            'id'=>'66',
            'name'=>'read_franqueado_vip',
            'label'=>'Read - Gerência dos Franqueados VIP e VIP Líder',
        ]);
        //Update
        Permission::create([
            'id'=>'67',
            'name'=>'update_franqueado_vip',
            'label'=>'Update - Gerência dos Franqueados VIP e VIP Líder',
        ]);
        //Delete
        Permission::create([
            'id'=>'68',
            'name'=>'delete_franqueado_vip',
            'label'=>'Delete - Gerência dos Franqueados VIP e VIP Líder',
        ]); 
              
        // ------------------------------------------------------------

        //Área - Gerência de Fornecedores
        //Create
        Permission::create([
            'id'=>'69',
            'name'=>'create_fornecedor',
            'label'=>'Create - Gerência de Fornecedores',
        ]);
        //Read
        Permission::create([
            'id'=>'70',
            'name'=>'read_fornecedor',
            'label'=>'Read - Gerência de Fornecedores',
        ]);
        //Update
        Permission::create([
            'id'=>'71',
            'name'=>'update_fornecedor',
            'label'=>'Update - Gerência de Fornecedores',
        ]);
        //Delete
        Permission::create([
            'id'=>'72',
            'name'=>'delete_fornecedor',
            'label'=>'Delete - Gerência de Fornecedores',
        ]);      
        // ------------------------------------------------------------

        //Área - Gerência de Orçamentos
        //Create
        Permission::create([
            'id'=>'73',
            'name'=>'create_orcamento',
            'label'=>'Create - Gerência de Orçamentos',
        ]);
        //Read
        Permission::create([
            'id'=>'74',
            'name'=>'read_orcamento',
            'label'=>'Read - Gerência de Orçamentos',
        ]);
        //Update
        Permission::create([
            'id'=>'75',
            'name'=>'update_orcamento',
            'label'=>'Update - Gerência de Orçamentos',
        ]);
        //Delete
        Permission::create([
            'id'=>'76',
            'name'=>'delete_orcamento',
            'label'=>'Delete - Gerência de Orçamentos',
        ]);

        // ------------------------------------------------------------

        //Área - Upload de Arquivos
        //Create        
        Permission::create([
            'id'=>'77',
            'name'=>'create_upload',
            'label'=>'Create - Upload de Arquivos',
        ]);
        //Read
        Permission::create([
            'id'=>'78',
            'name'=>'read_upload',
            'label'=>'Read - Upload de Arquivos',
        ]);
        //Update
        Permission::create([
            'id'=>'79',
            'name'=>'update_upload',
            'label'=>'Update - Upload de Arquivos',
        ]);
        //Delete
        Permission::create([
            'id'=>'80',
            'name'=>'delete_upload',
            'label'=>'Delete - Upload de Arquivos',
        ]);


        // ------------------------------------------------------------

        //Área - Gerência de Preços de Produtos
        //Create
        Permission::create([
            'id'=>'81',
            'name'=>'create_produto_preco',
            'label'=>'Create - Gerência de Preços de Produtos',
        ]);
        //Read
        Permission::create([
            'id'=>'82',
            'name'=>'read_produto_preco',
            'label'=>'Read - Gerência de Preços de Produtos',
        ]);
        //Update
        Permission::create([
            'id'=>'83',
            'name'=>'update_produto_preco',
            'label'=>'Update - Gerência de Preços de Produtos',
        ]);
        //Delete
        Permission::create([
            'id'=>'84',
            'name'=>'delete_produto_preco',
            'label'=>'Delete - Gerência de Preços de Produtos',
        ]);     
        // ------------------------------------------------------------

        //Área - Sincronizar Lojas
        //Create        
        Permission::create([
            'id'=>'85',
            'name'=>'create_sincronizar',
            'label'=>'Create - Sincronizar Lojas',
        ]);
        //Read
        Permission::create([
            'id'=>'86',
            'name'=>'read_sincronizar',
            'label'=>'Read - Sincronizar Lojas',
        ]);
        //Update
        Permission::create([
            'id'=>'87',
            'name'=>'update_sincronizar',
            'label'=>'Update - Sincronizar Lojas',
        ]);
        //Delete
        Permission::create([
            'id'=>'88',
            'name'=>'delete_sincronizar',
            'label'=>'Delete - Sincronizar Lojas',
        ]); 

        //Área - Gerência de Lista de Prospectos
        //Create
        Permission::create([
            'id'=>'89',
            'name'=>'create_lista_prospecto',
            'label'=>'Create - Gerência de Lista de Prospectos',
        ]);
        //Read
        Permission::create([
            'id'=>'90',
            'name'=>'read_lista_prospecto',
            'label'=>'Read - Gerência de Lista de Prospectos',
        ]);
        //Update
        Permission::create([
            'id'=>'91',
            'name'=>'update_lista_prospecto',
            'label'=>'Update - Gerência de Lista de Prospectos',
        ]);
        //Delete
        Permission::create([
            'id'=>'92',
            'name'=>'delete_lista_prospecto',
            'label'=>'Delete - Gerência de Lista de Prospectos',
        ]);         
        

        //Área - 
        //Create
        /*
        Permission::create([
            'id'=>'',
            'name'=>'create_',
            'label'=>'Create - ',
        ]);
        //Read
        Permission::create([
            'id'=>'',
            'name'=>'read_',
            'label'=>'Read - ',
        ]);
        //Update
        Permission::create([
            'id'=>'',
            'name'=>'update_',
            'label'=>'Update - ',
        ]);
        //Delete
        Permission::create([
            'id'=>'',
            'name'=>'delete_',
            'label'=>'Delete - ',
        ]); 
        */       
        // ------------------------------------------------------------


    }
}
