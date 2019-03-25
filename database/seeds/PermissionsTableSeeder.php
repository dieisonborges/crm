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
            'label'=>'Create - Gerência de Tickets de Manutenção',
        ]);
        //Read
        Permission::create([
            'id'=>'18',
            'name'=>'read_ticket',
            'label'=>'Read - Gerência de Tickets de Manutenção',
        ]);
        //Update
        Permission::create([
            'id'=>'19',
            'name'=>'update_ticket',
            'label'=>'Update - Gerência de Tickets de Manutenção',
        ]);
        //Delete
        Permission::create([
            'id'=>'20',
            'name'=>'delete_ticket',
            'label'=>'Delete - Gerência de Tickets de Manutenção',
        ]);        
        // ------------------------------------------------------------


    }
}
