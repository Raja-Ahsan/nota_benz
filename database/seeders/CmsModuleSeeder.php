<?php

namespace Database\Seeders;

use App\Models\CmsModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dashboard = CmsModule::firstOrCreate([
            'route_name' => 'admin.dashboard',
        ], [
            'name' => 'Dashboard',
            'icon' => 'fa-regular fa-house',
            'sort_order' => 1,
            'status' => 'active',
            'parent_id' => 0,
        ]);

        $users = CmsModule::firstOrCreate([
            'route_name' => 'users-module',
        ], [
            'name' => 'Users',
            'icon' => 'fa-solid fa-users',
            'sort_order' => 2,
            'status' => 'active',
            'parent_id' => 0,
        ]);

        $packages = CmsModule::firstOrCreate([
            'route_name' => 'packages-module',
        ], [
            'name' => 'Packages',
            'icon' => 'fa-solid fa-box-open',
            'sort_order' => 3,
            'status' => 'active',
            'parent_id' => 0,
        ]);


        // submenus
        // users submenu start

        CmsModule::firstOrCreate([
            'route_name' => 'users.index',
        ], [
            'name' => 'All Users',
            'icon' => 'fa-solid fa-list-ul',
            'sort_order' => 1,
            'status' => 'active',
            'parent_id' => $users->id,
        ]);

        CmsModule::firstOrCreate([
            'route_name' => 'packages.index',
        ], [
            'name' => 'All Packages',
            'icon' => 'fa-solid fa-list-ul',
            'sort_order' => 1,
            'status' => 'active',
            'parent_id' => $packages->id,
        ]);

        CmsModule::firstOrCreate([
            'route_name' => 'packages.create',
        ], [
            'name' => 'Add Package',
            'icon' => 'fa-solid fa-circle-plus',
            'sort_order' => 2,
            'status' => 'active',
            'parent_id' => $packages->id,
        ]);

        // users submenu end
    }
}
