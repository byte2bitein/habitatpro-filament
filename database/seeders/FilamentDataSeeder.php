<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class FilamentDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['name' => 'Tenant 1', 'slug' => 'tenant-1'],
            ['name' => 'Tenant 2', 'slug' => 'tenant-2'],
        ];
        foreach ($tenants as $tenant) {
            Tenant::create($tenant);
        }

        foreach (Tenant::all() as $tenant) {
            static::SeedTenantDefaultRolesAndPermissions($tenant);
        }

        $super_admin = User::create([
            'name' => 'Jatin Prajapati',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'is_super_admin' => true,
        ]);

        foreach ($tenants as $tenant) {
            $tenantModel = Tenant::where('slug', $tenant['slug'])->first();
            $tenantModel->users()->attach($super_admin->id);
        }
    }

    public static function SeedTenantDefaultRolesAndPermissions(Tenant $tenantModel)
    {
        // $tenantModel = Tenant::where('slug', $tenant['slug'])->first();
        // Create permissions
        foreach (static::default_permissions() as $permission) {
            \App\Models\Permission::create(array_merge($permission, ['tenant_id' => $tenantModel->id])); // Associate each permission with the tenant
        }
        // Create roles
        foreach (static::default_roles() as $role) {
            \App\Models\Role::create(array_merge($role, ['tenant_id' => $tenantModel->id])); // Associate each role with the tenant
        }

        // Create role permissions mapping
        foreach (static::default_role_permission_maping() as $mapping) {
            $role = \App\Models\Role::where('code', $mapping['role'])->where('tenant_id', $tenantModel->id)->first();
            if ($role) {
                $permissions = \App\Models\Permission::whereIn('code', $mapping['permissions'])->where('tenant_id', $tenantModel->id)->get();
                $role->permissions()->attach($permissions);
            }
        }
    }

    public static function default_roles()
    {
        return [
            ['name' => 'Admin', 'code' => 'admin'],
            ['name' => 'Editor', 'code' => 'editor'],
            ['name' => 'Viewer', 'code' => 'viewer'],
        ];
    }

    public static function default_permissions()
    {
        // Seed permissions
        return [
            ['name' => 'Create User', 'code' => 'create_user'],
            ['name' => 'Edit User', 'code' => 'update_user'],
            ['name' => 'Delete User', 'code' => 'delete_user'],
            ['name' => 'View User', 'code' => 'view_user'],
            ['name' => 'Reset user password', 'code' => 'reset_user_password'],

            ['name' => 'Attach role', 'code' => 'attach_role'],
            ['name' => 'Detach role', 'code' => 'detach_role'],

            ['name' => 'Create Role', 'code' => 'create_role'],
            ['name' => 'Edit Role', 'code' => 'update_role'],
            ['name' => 'Delete Role', 'code' => 'delete_role'],
            ['name' => 'View Role', 'code' => 'view_role'],

            ['name' => 'Create Permission', 'code' => 'create_permission'],
            ['name' => 'Edit Permission', 'code' => 'update_permission'],
            ['name' => 'Delete Permission', 'code' => 'delete_permission'],
            ['name' => 'View Permission', 'code' => 'view_permission'],
        ];
    }

    public static function default_role_permission_maping()
    {
        return [
            [
                'role' => 'admin',
                'permissions' => [
                    'create_user',
                    'update_user',
                    'delete_user',
                    'view_user',
                    'reset_user_password',
                    'view_role',
                    'attach_role',
                    'detach_role',
                ],
            ],
            [
                'role' => 'editor',
                'permissions' => [
                    // TODO
                ],
            ],
            [
                'role' => 'viewer',
                'permissions' => [
                    'view_user',
                ],
            ],
        ];
    }
}
