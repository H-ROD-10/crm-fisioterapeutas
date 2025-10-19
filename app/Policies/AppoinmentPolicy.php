<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Appoinment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppoinmentPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Appoinment');
    }

    public function view(AuthUser $authUser, Appoinment $appoinment): bool
    {
        return $authUser->can('View:Appoinment');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Appoinment');
    }

    public function update(AuthUser $authUser, Appoinment $appoinment): bool
    {
        return $authUser->can('Update:Appoinment');
    }

    public function delete(AuthUser $authUser, Appoinment $appoinment): bool
    {
        return $authUser->can('Delete:Appoinment');
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