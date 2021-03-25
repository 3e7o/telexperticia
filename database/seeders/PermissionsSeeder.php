<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list doctors', 'description' => 'Lista y navega todos los Médicos']);
        Permission::create(['name' => 'view doctors', 'description' => 'Ve en detalle cada Médico']);
        Permission::create(['name' => 'create doctors', 'description' => 'Podría crear a un Médico']);
        Permission::create(['name' => 'update doctors', 'description' => 'Podría editar cualquier dato de Médico']);
        Permission::create(['name' => 'delete doctors', 'description' => 'Podría eliminar cualquier Médico']);

        Permission::create(['name' => 'list specialties', 'description' => 'Lista y navega todas las especialidades']);
        Permission::create(['name' => 'view specialties', 'description' => 'Ve en detalle cada especialidad']);
        Permission::create(['name' => 'create specialties', 'description' => 'Podría crear una especialidad']);
        Permission::create(['name' => 'update specialties', 'description' => 'Podría editar cualquier especialidad']);
        Permission::create(['name' => 'delete specialties', 'description' => 'Podría eliminar cualquier especialidad']);

        Permission::create(['name' => 'list patients', 'description' => 'Lista y navega todos los asegurados']);
        Permission::create(['name' => 'view patients', 'description' => 'Ve en detalle cada asegurado']);
        Permission::create(['name' => 'create patients', 'description' => 'Podría crear a un asegurado']);
        Permission::create(['name' => 'update patients', 'description' => 'Podría editar cualquier dato de asegurado']);
        Permission::create(['name' => 'delete patients', 'description' => 'Podría eliminar cualquier asegurado']);

        Permission::create(['name' => 'list medicalboards', 'description' => 'Lista y navega todas las Juntas Medicas']);
        Permission::create(['name' => 'view medicalboards', 'description' => 'Ve en detalle cada  Junta Medica']);
        Permission::create(['name' => 'create medicalboards', 'description' => 'Podría crear una Junta Medica']);
        Permission::create(['name' => 'update medicalboards', 'description' => 'Podría editar cualquier Junta Medica']);
        Permission::create(['name' => 'delete medicalboards', 'description' => 'Podría eliminar cualquier Junta Medica']);

        Permission::create(['name' => 'list reports', 'description' => 'Lista y navega todos los informes']);
        Permission::create(['name' => 'view reports', 'description' => 'Ve en detalle cada  informe']);
        Permission::create(['name' => 'create reports', 'description' => 'Podría crear un informes']);
        Permission::create(['name' => 'update reports', 'description' => 'Podría editar cualquier dato de informe']);
        Permission::create(['name' => 'delete reports', 'description' => 'Podría eliminar cualquier informe']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles', 'description' => 'Lista y navega todos los roles']);
        Permission::create(['name' => 'view roles', 'description' => 'Ve en detalle cada rol']);
        Permission::create(['name' => 'create roles', 'description' => 'Podría crear un rol']);
        Permission::create(['name' => 'update roles', 'description' => 'Podría editar cualquier rol']);
        Permission::create(['name' => 'delete roles', 'description' => 'Podría eliminar cualquier rol']);

        Permission::create(['name' => 'list permissions', 'description' => 'Lista y navega todos los permisos']);
        Permission::create(['name' => 'view permissions', 'description' => 'Ve en detalle cada permiso']);
        Permission::create(['name' => 'create permissions', 'description' => 'Podría crear un permiso']);
        Permission::create(['name' => 'update permissions', 'description' => 'Podría editar cualquier permiso']);
        Permission::create(['name' => 'delete permissions', 'description' => 'Podría eliminar cualquier permiso']);

        Permission::create(['name' => 'list users', 'description' => 'Lista y navega todos los usuarios']);
        Permission::create(['name' => 'view users', 'description' => 'Ve en detalle cada  usuario']);
        Permission::create(['name' => 'create users', 'description' => 'Podría crear a un usuario']);
        Permission::create(['name' => 'update users', 'description' => 'Podría editar cualquier dato de usuario']);
        Permission::create(['name' => 'delete users', 'description' => 'Podría eliminar cualquier usuario']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }

        Role::create(['name' => 'doctor']);
        Role::create(['name' => 'patient']);
    }
}
