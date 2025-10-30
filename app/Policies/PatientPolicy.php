<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Patient;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PatientPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Patient');
    }

    public function view(AuthUser $authUser, Patient $patient): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('View:Patient')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede ver sus propios pacientes
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $patient->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes ver a los pacientes que te han sido asignados.');
        }
        
        // Super admin y recepcionista pueden ver todos
        return true;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Patient');
    }

    public function update(AuthUser $authUser, Patient $patient): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('Update:Patient')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede editar sus propios pacientes
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $patient->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes editar a los pacientes que te han sido asignados.');
        }
        
        // Super admin y recepcionista pueden editar todos
        return true;
    }

    public function delete(AuthUser $authUser, Patient $patient): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('Delete:Patient')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede eliminar sus propios pacientes
        if ($authUser->hasRole('Fisioterapeuta')) {
            return $authUser->id === $patient->fisioterapeuta_id
                ? Response::allow()
                : Response::deny('Solo puedes eliminar a los pacientes que te han sido asignados.');
        }
        
        // Super admin y recepcionista pueden eliminar todos
        return true;
    }

    public function restore(AuthUser $authUser, Patient $patient): bool
    {
        return $authUser->can('Restore:Patient');
    }

    public function forceDelete(AuthUser $authUser, Patient $patient): bool
    {
        return $authUser->can('ForceDelete:Patient');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Patient');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Patient');
    }

    public function replicate(AuthUser $authUser, Patient $patient): bool
    {
        return $authUser->can('Replicate:Patient');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Patient');
    }

}