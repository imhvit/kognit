<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserAccessRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserAccessController extends Controller
{
    public function edit(User $user)
    {
        // Evitamos N+1 cargando las relaciones pivot en memoria
        $user->load(['roles', 'permissions']);


        return inertia('admin/users/access/Edit', [
            'user' => $user,
            // Pluck optimiza la carga de red enviando solo un array simple ['admin', 'teacher']
            'userRoles' => $user->roles->pluck('name'),
            'userDirectPermissions' => $user->permissions->pluck('name'),

            // Diccionarios completos para renderizar los checkboxes en la UI
            'availableRoles' => Role::select('id', 'name')->get(),
            'availablePermissions' => Permission::select('id', 'name')->get(),
        ]);
    }

    public function update(UpdateUserAccessRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $user->syncRoles($validated['roles']);

        $user->syncPermissions($validated['permissions']);

        return back()->with('success', 'Accesos del usuario actualizados correctamente.');
    }
}
