<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SessionTherapy;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SessionTherapyPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {

        $hasPermission = $authUser->can('ViewAny:SessionTherapy');
        
        return $hasPermission;
    }

    public function view(AuthUser $authUser, SessionTherapy $sessionTherapy): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('View:SessionTherapy')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede ver sesiones de sus tratamientos
        if ($authUser->hasRole('Fisioterapeuta')) {
            $belongsToUser = $sessionTherapy->treatment && 
                           $sessionTherapy->treatment->fisioterapeuta_id === $authUser->id;
            
            return $belongsToUser
                ? Response::allow()
                : Response::deny('Solo puedes ver las sesiones de tus tratamientos.');
        }
        
        // Super admin y recepcionista pueden ver todas
        return true;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SessionTherapy');
    }

    public function update(AuthUser $authUser, SessionTherapy $sessionTherapy): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('Update:SessionTherapy')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede editar sesiones de sus tratamientos
        if ($authUser->hasRole('fisioterapeuta')) {
            $belongsToUser = $sessionTherapy->treatment && 
                           $sessionTherapy->treatment->fisioterapeuta_id === $authUser->id;
            
            return $belongsToUser
                ? Response::allow()
                : Response::deny('Solo puedes editar las sesiones de tus tratamientos.');
        }
        
        // Super admin y recepcionista pueden editar todas
        return true;
    }

    public function delete(AuthUser $authUser, SessionTherapy $sessionTherapy): Response|bool
    {
        // Verificar permiso básico
        if (!$authUser->can('Delete:SessionTherapy')) {
            return false;
        }
        
        // Si es fisioterapeuta, solo puede eliminar sesiones de sus tratamientos
        if ($authUser->hasRole('fisioterapeuta')) {
            $belongsToUser = $sessionTherapy->treatment && 
                           $sessionTherapy->treatment->fisioterapeuta_id === $authUser->id;
            
            return $belongsToUser
                ? Response::allow()
                : Response::deny('Solo puedes eliminar las sesiones de tus tratamientos.');
        }
        
        // Super admin y recepcionista pueden eliminar todas
        return true;
    }

    public function restore(AuthUser $authUser, SessionTherapy $sessionTherapy): bool
    {
        return $authUser->can('Restore:SessionTherapy');
    }

    public function forceDelete(AuthUser $authUser, SessionTherapy $sessionTherapy): bool
    {
        return $authUser->can('ForceDelete:SessionTherapy');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SessionTherapy');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SessionTherapy');
    }

    public function replicate(AuthUser $authUser, SessionTherapy $sessionTherapy): bool
    {
        return $authUser->can('Replicate:SessionTherapy');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SessionTherapy');
    }

}