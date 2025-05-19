<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Manager (role_id 2)
        $managerPermissions = Permission::whereIn('name', [
            'view_barang', 'view_any_barang', 'create_barang', 'update_barang',
            'view_barang::masuk', 'view_any_barang::masuk', 'create_barang::masuk', 'update_barang::masuk',
            'view_barang::keluar', 'view_any_barang::keluar', 'create_barang::keluar', 'update_barang::keluar',
            'view_activity', 'view_any_activity',
            'widget_OverlookWidget', 'widget_LatestAccessLogs'
        ])->get();

        $managerRole = Role::find(2);
        $managerRole->syncPermissions($managerPermissions);

        // Petugas Gudang (role_id 3)
        $petugasPermissions = Permission::whereIn('name', [
            'view_barang', 'view_any_barang',
            'view_barang::masuk', 'view_any_barang::masuk', 'create_barang::masuk',
            'view_barang::keluar', 'view_any_barang::keluar', 'create_barang::keluar'
        ])->get();

        $petugasRole = Role::find(3);
        $petugasRole->syncPermissions($petugasPermissions);

        // Viewer (role_id 4)
        $viewerPermissions = Permission::whereIn('name', [
            'view_barang', 'view_any_barang',
            'view_barang::masuk', 'view_any_barang::masuk',
            'view_barang::keluar', 'view_any_barang::keluar'
        ])->get();

        $viewerRole = Role::find(4);
        $viewerRole->syncPermissions($viewerPermissions);
    }
}