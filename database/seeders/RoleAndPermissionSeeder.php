<?php

namespace Database\Seeders;

use App\Enums\Auth\PermissionType;
use App\Enums\Auth\RoleType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar caché
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Crear permisos
        $allPermissions = [];
        foreach (PermissionType::cases() as $permission) {
            $allPermissions[] = Permission::findOrCreate($permission->value);
        }

        // 2. Crear roles y asignar

        // ADMIN
        $admin = Role::findOrCreate(RoleType::Admin->value);
        // Pasamos el array de modelos instanciados arriba para evitar errores de parseo de Enums
        $admin->syncPermissions($allPermissions);

        // TEACHER
        $teacher = Role::findOrCreate(RoleType::Teacher->value);
        $teacher->givePermissionTo([
            PermissionType::CreateCourses->value,
            PermissionType::EditCourses->value,
        ]);

        // STUDENT (Faltaba esto)
        $student = Role::findOrCreate(RoleType::Student->value);
        // (El estudiante no tiene permisos directos globales por ahora, solo autorizaciones contextuales)
    }
}
