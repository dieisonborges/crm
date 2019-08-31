<?php

use Illuminate\Database\Seeder;

use App\Permission;
use App\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        /* --------------------------------------------------------------------*/
        //"name"=>"adm", "label"=>"Administrador" | Todas as permissoes
        $role = Role::where('name','adm')->first();
        $permissions = Permission::all();        
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }

        /* --------------------------------------------------------------------*/
        //"name"=>"diretoria", "label"=>"Diretoria e-Cardume" | Todas as permissoes
        $role = Role::where('name','diretoria')->first();
        $permissions = Permission::all();        
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }

        /* --------------------------------------------------------------------*/
        //"name"=>"atendimento", "label"=>"Atendimento Geral ao Cliente"
        $role = Role::where('name','atendimento')->first();
        //atendimento
        $permissions = Permission::where('name', 'like','%'.'atendimento');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }
        //upload
        $permissions = Permission::where('name', 'like','%'.'upload');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }

        /* --------------------------------------------------------------------*/
        //"name"=>"convite", "label"=>"Convidados a plataforma"
        $role = Role::where('name','convite')->first();
        //convite
        $permissions = Permission::where('name', 'like','%'.'convite');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }

        /* --------------------------------------------------------------------*/
        //"name"=>"financeiro", "label"=>"Financeiro - Atendimento ao Cliente"
        $role = Role::where('name','financeiro')->first();
        //financeiro
        $permissions = Permission::where('name', 'like','%'.'financeiro');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }
        //upload
        $permissions = Permission::where('name', 'like','%'.'upload');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }

        /* --------------------------------------------------------------------*/
        //"name"=>"suporte_tecnico", "label"=>"Suporte Técnico - Atendimento ao Cliente"
        $role = Role::where('name','suporte_tecnico')->first();
        //suporte_tecnico
        $permissions = Permission::where('name', 'like','%'.'suporte_tecnico');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }
        //upload
        $permissions = Permission::where('name', 'like','%'.'upload');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }

        /* --------------------------------------------------------------------*/
        //"name"=>"franquia", "label"=>"Gerência de Franquias"
        $role = Role::where('name','franquia')->first();
        //franquia
        $permissions = Permission::where('name', 'like','%'.'franquia');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }

        /* --------------------------------------------------------------------*/
        //"name"=>"franqueado", "label"=>"Franqueado e-Cardume"
        $role = Role::where('name','franqueado')->first();
        //franqueado
        $permissions = Permission::where('name', 'like','%'.'franqueado');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }
        //upload
        $permissions = Permission::where('name', 'like','%'.'upload');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }

        /* --------------------------------------------------------------------*/
        //"name"=>"score", "label"=>"Gerência de Score (Pontuação)"
        $role = Role::where('name','score')->first();
        //score
        $permissions = Permission::where('name', 'like','%'.'score');       
        foreach ($permissions as $permission) {
            $permission->permissionRole()->attach($role->id);
        }


        
    }
}
