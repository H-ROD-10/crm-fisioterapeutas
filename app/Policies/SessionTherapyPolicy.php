<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SessionTherapy;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionTherapyPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SessionTherapy');
    }

    public function view(AuthUser $authUser, SessionTherapy $sessionTherapy): bool
    {
        return $authUser->can('View:SessionTherapy');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SessionTherapy');
    }

    public function update(AuthUser $authUser, SessionTherapy $sessionTherapy): bool
    {
        return $authUser->can('Update:SessionTherapy');
    }

    public function delete(AuthUser $authUser, SessionTherapy $sessionTherapy): bool
    {
        return $authUser->can('Delete:SessionTherapy');
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