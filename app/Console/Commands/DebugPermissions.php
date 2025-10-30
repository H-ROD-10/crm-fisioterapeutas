<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DebugPermissions extends Command
{
    protected $signature = 'debug:permissions {user_id?}';
    protected $description = 'Debug permissions for a specific user or show all permissions';

    public function handle()
    {
        $userId = $this->argument('user_id');

        if ($userId) {
            $this->debugUserPermissions($userId);
        } else {
            $this->showAllPermissions();
        }
    }

    private function debugUserPermissions($userId)
    {
        $user = User::find($userId);
        
        if (!$user) {
            $this->error("Usuario con ID {$userId} no encontrado");
            return;
        }

        $this->info("=== DEBUG PERMISOS USUARIO ===");
        $this->info("Usuario: {$user->name} (ID: {$user->id})");
        $this->info("Email: {$user->email}");
        
        $this->info("\n--- ROLES ---");
        $roles = $user->getRoleNames();
        foreach ($roles as $role) {
            $this->line("- {$role}");
        }

        $this->info("\n--- PERMISOS DIRECTOS ---");
        $directPermissions = $user->getDirectPermissions();
        foreach ($directPermissions as $permission) {
            $this->line("- {$permission->name}");
        }

        $this->info("\n--- PERMISOS VÍA ROLES ---");
        $rolePermissions = $user->getPermissionsViaRoles();
        foreach ($rolePermissions as $permission) {
            $this->line("- {$permission->name}");
        }

        $this->info("\n--- TODOS LOS PERMISOS ---");
        $allPermissions = $user->getAllPermissions();
        foreach ($allPermissions as $permission) {
            $this->line("- {$permission->name}");
        }

        // Test specific permissions
        $this->info("\n--- TEST PERMISOS ESPECÍFICOS ---");
        $testPermissions = [
            'view_any_appoinment',
            'view_appoinment', 
            'create_appoinment',
            'view_any_patient',
            'view_patient',
            'create_patient'
        ];

        foreach ($testPermissions as $permission) {
            $hasPermission = $user->can($permission);
            $status = $hasPermission ? '✓' : '✗';
            $this->line("{$status} {$permission}");
        }
    }

    private function showAllPermissions()
    {
        $this->info("=== TODOS LOS PERMISOS EN EL SISTEMA ===");
        
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $this->line("- {$permission->name} (guard: {$permission->guard_name})");
        }

        $this->info("\n=== TODOS LOS ROLES ===");
        $roles = Role::with('permissions')->get();
        foreach ($roles as $role) {
            $this->info("\nRol: {$role->name}");
            foreach ($role->permissions as $permission) {
                $this->line("  - {$permission->name}");
            }
        }
    }
}
