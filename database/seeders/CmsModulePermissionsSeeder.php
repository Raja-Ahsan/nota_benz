<?php

namespace Database\Seeders;

use App\Models\CmsModule;
use App\Models\CmsModulePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CmsModulePermission::truncate();

        $permissions = [
            'admin' => [
                'admin.dashboard' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],
                'users-module' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],
                'users.index' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],
                'packages-module' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],
                'packages.index' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],
                'products-module' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],
                'product-categories.index' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],
                'products.index' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],
                'product-variations.index' => ['is_view' => 1, 'is_add' => 1, 'is_update' => 1, 'is_delete' => 1],

            ],

            'user' => [
                'admin.dashboard' => ['is_view' => 1, 'is_add' => 0, 'is_update' => 0, 'is_delete' => 0],
                'users-module' => ['is_view' => 0, 'is_add' => 0, 'is_update' => 0, 'is_delete' => 0],
                'packages-module' => ['is_view' => 1, 'is_add' => 0, 'is_update' => 0, 'is_delete' => 0],
                'packages.index' => ['is_view' => 1, 'is_add' => 0, 'is_update' => 0, 'is_delete' => 0],
            ],
        ];

        foreach ($permissions as $role => $modules) {
            foreach ($modules as $route => $perm) {

                $module = CmsModule::where('route_name', $route)->first();
                if (!$module) continue;

                CmsModulePermission::create([
                    'role' => $role,
                    'module_id' => $module->id,
                    'is_view' => $perm['is_view'],
                    'is_add' => $perm['is_add'],
                    'is_update' => $perm['is_update'],
                    'is_delete' => $perm['is_delete'],
                    'status' => 'active',
                ]);
            }
        }
    }
}
