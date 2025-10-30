<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Treatment;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TreatmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Treatment');
    }

    public function view(AuthUser $authUser, Treatment $treatment): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('View:Treatment')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede ver sus propios tratamientos
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $treatment->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes ver los tratamientos que te han sido asignados.');
        }
        
        // Super admin y recepcionista pueden ver todos
        return true;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Treatment');
    }

    public function update(AuthUser $authUser, Treatment $treatment): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('Update:Treatment')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede editar sus propios tratamientos
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $treatment->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes editar los tratamientos que te han sido asignados.');
        }
        
        // Super admin y recepcionista pueden editar todos
        return true;
    }

    public function delete(AuthUser $authUser, Treatment $treatment): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('Delete:Treatment')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede eliminar sus propios tratamientos
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $treatment->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes eliminar los tratamientos que te han sido asignados.');
        }
        
        // Super admin y recepcionista pueden eliminar todos
        return true;
    }

    public function restore(AuthUser $authUser, Treatment $treatment): bool
    {
        return $authUser->can('Restore:Treatment');
    }

    public function forceDelete(AuthUser $authUser, Treatment $treatment): bool
    {
        return $authUser->can('ForceDelete:Treatment');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Treatment');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Treatment');
    }

    public function replicate(AuthUser $authUser, Treatment $treatment): bool
    {
        return $authUser->can('Replicate:Treatment');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Treatment');
    }

}