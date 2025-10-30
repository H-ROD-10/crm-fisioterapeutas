<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Appoinment;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AppoinmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Appoinment');
    }

    public function view(AuthUser $authUser, Appoinment $appoinment): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('View:Appoinment')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede ver sus propias citas
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $appoinment->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes ver las citas que te han sido asignadas.');
        }
        
        // Super admin y recepcionista pueden ver todas
        return true;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Appoinment');
    }

    public function update(AuthUser $authUser, Appoinment $appoinment): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('Update:Appoinment')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede editar sus propias citas
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $appoinment->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes editar las citas que te han sido asignadas.');
        }
        
        // Super admin y recepcionista pueden editar todas
        return true;
    }

    public function delete(AuthUser $authUser, Appoinment $appoinment): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('Delete:Appoinment')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede eliminar sus propias citas
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $appoinment->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes eliminar las citas que te han sido asignadas.');
        }
        
        // Super admin y recepcionista pueden eliminar todas
        return true;
    }

    public function restore(AuthUser $authUser, Appoinment $appoinment): bool
    {
        return $authUser->can('Restore:Appoinment');
    }

    public function forceDelete(AuthUser $authUser, Appoinment $appoinment): bool
    {
        return $authUser->can('ForceDelete:Appoinment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Appoinment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Appoinment');
    }

    public function replicate(AuthUser $authUser, Appoinment $appoinment): bool
    {
        return $authUser->can('Replicate:Appoinment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Appoinment');
    }

}