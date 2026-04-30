<?php

namespace Database\Seeders;

use App\Models\CmsModule;
use Illuminate\Database\Seeder;

class CmsModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Uses updateOrCreate (not only firstOrCreate) so re-seeding repairs wrong parent_id
     * from old data where child route_names were left as top-level rows.
     */
    public function run(): void
    {
        $dashboard = CmsModule::updateOrCreate(
            ['route_name' => 'admin.dashboard'],
            [
                'name' => 'Dashboard',
                'icon' => 'fa-regular fa-house',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $users = CmsModule::updateOrCreate(
            ['route_name' => 'users-module'],
            [
                'name' => 'Users',
                'icon' => 'fa-solid fa-users',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $products = CmsModule::updateOrCreate(
            ['route_name' => 'products-module'],
            [
                'name' => 'Products',
                'icon' => 'fa-solid fa-box-open',
                'sort_order' => 3,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        $packages = CmsModule::updateOrCreate(
            ['route_name' => 'packages-module'],
            [
                'name' => 'Packages',
                'icon' => 'fa-solid fa-box-open',
                'sort_order' => 4,
                'status' => 'active',
                'parent_id' => 0,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'users.index'],
            [
                'name' => 'All Users',
                'icon' => 'fa-solid fa-list-ul',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => $users->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'products.index'],
            [
                'name' => 'All Products',
                'icon' => 'fa-solid fa-list-ul',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => $products->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'products.create'],
            [
                'name' => 'Create Product',
                'icon' => 'fa-solid fa-circle-plus',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => $products->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'variations.index'],
            [
                'name' => 'All Variations',
                'icon' => 'fa-solid fa-list-ul',
                'sort_order' => 3,
                'status' => 'active',
                'parent_id' => $products->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'packages.index'],
            [
                'name' => 'All Packages',
                'icon' => 'fa-solid fa-list-ul',
                'sort_order' => 1,
                'status' => 'active',
                'parent_id' => $packages->id,
            ]
        );

        CmsModule::updateOrCreate(
            ['route_name' => 'packages.create'],
            [
                'name' => 'Add Package',
                'icon' => 'fa-solid fa-circle-plus',
                'sort_order' => 2,
                'status' => 'active',
                'parent_id' => $packages->id,
            ]
        );

        $allowed = [
            'admin.dashboard',
            'users-module', 'users.index',
            'products-module', 'products.index', 'variations.index', 
            'packages-module', 'packages.index', 'packages.create',
        ];

        CmsModule::query()
            ->where(function ($q) use ($allowed) {
                $q->whereNotIn('route_name', $allowed)
                    ->orWhereNull('route_name');
            })
            ->delete();
    }
}
