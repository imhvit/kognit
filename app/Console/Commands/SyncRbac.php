<?php

namespace App\Console\Commands;

use App\Enums\Auth\PermissionType;
use App\Enums\Auth\RoleType;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Signature('app:sync-rbac')]
#[Description('Synchronize roles and permissions from the settings to the database')]
class SyncRbac extends Command
{
    public function handle()
    {
        $this->info('Iniciando sincronización RBAC...');

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->info('Sincronizando Permisos:');
        foreach (PermissionType::cases() as $permissionEnum) {
            $permission = Permission::findOrCreate($permissionEnum->value);
            if ($permission->wasRecentlyCreated) {
                $this->line("- Permiso nuevo creado: <info>{$permissionEnum->value}</info>");
            }
        }

        $this->info('Sincronizando Roles:');
        foreach (RoleType::cases() as $roleEnum) {
            $role = Role::findOrCreate($roleEnum->value);
            if ($role->wasRecentlyCreated) {
                $this->line("- Rol nuevo creado: <info>{$roleEnum->value}</info>");
            }
        }

        $admin = Role::findByName(RoleType::Admin->value);
        $admin->syncPermissions(Permission::all());
        $this->line("- Permisos totales asignados al rol Admin.");

        $this->info('¡Sincronización completada!');
    }
}
