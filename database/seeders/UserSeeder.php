<?php

namespace Database\Seeders;

use App\Enums\Auth\PermissionType;
use App\Enums\Auth\RoleType;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Kognit',
            'email' => 'admin@kognit.com',
        ]);
        $admin->assignRole(RoleType::Admin->value);

        // CASO 2: Profesor Estándar (Hereda permisos de CreateCourses, EditCourses)
        $teacher = User::factory()->create([
            'name' => 'Profesor Roberto',
            'email' => 'roberto@kognit.com',
        ]);
        $teacher->assignRole(RoleType::Teacher->value);

        // CASO 3: Estudiante Básico
        $student = User::factory()->create([
            'name' => 'Alumno Juan',
            'email' => 'juan@kognit.com',
        ]);
        $student->assignRole(RoleType::Student->value);

        // CASO 4: Híbrido (Profesor con un permiso extra que normalmente no tiene)
        // Útil cuando delegas tareas sin tener que crear un rol nuevo (Ej. "Co-Administrador")
        $hybrid = User::factory()->create([
            'name' => 'Profesor Coordinador',
            'email' => 'coordinador@kognit.com',
        ]);
        $hybrid->assignRole(RoleType::Teacher->value);
        $hybrid->givePermissionTo(PermissionType::ManageUsers->value); // Permiso Directo

        // Generar 50 estudiantes masivos de relleno
        User::factory(10)->create()->each(function (User $user) {
            $user->assignRole(RoleType::Student->value);
        });
    }
}
