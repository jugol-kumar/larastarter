<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
           'module_id' => $moduleAppDashboard->id,
           'name'      => 'Access Dashboard',
           'slug'      => 'app.dashboard'
        ]);
        //Start Role Management Section.
        $moduleAppRole = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name'      => 'Access Role',
            'slug'      => 'app.roles.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name'      => 'Create Role',
            'slug'      => 'app.roles.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name'      => 'Edit Role',
            'slug'      => 'app.roles.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name'      => 'Delete Role',
            'slug'      => 'app.roles.destroy'
        ]);
        //end role management section

        //start User Management Section
        $moduleAppUser = Module::updateOrCreate(['name' => 'User Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name'      => 'Access User',
            'slug'      => 'app.users.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name'      => 'Create User',
            'slug'      => 'app.users.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name'      => 'Edit User',
            'slug'      => 'app.users.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name'      => 'Delete User',
            'slug'      => 'app.users.destroy'
        ]);

        //end User Management Section

        //start Backup Management Section
        $moduleAppBackups = Module::updateOrCreate(['name' => 'Backup Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name'      => 'Access Backups',
            'slug'      => 'app.Backups.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name'      => 'Create Backups',
            'slug'      => 'app.Backups.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name'      => 'Download Backups',
            'slug'      => 'app.Backups.download'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name'      => 'Delete Backups',
            'slug'      => 'app.Backups.destroy'
        ]);
        //end Backup Management Sect

        //start Page Management Section
        $moduleAppPage = Module::updateOrCreate(['name' => 'Page Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name'      => 'Access Page',
            'slug'      => 'app.Pages.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name'      => 'Create Page',
            'slug'      => 'app.Pages.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name'      => 'Edit Page',
            'slug'      => 'app.Pages.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name'      => 'Delete Page',
            'slug'      => 'app.Pages.destroy'
        ]);
        //end Page Management Section

        //start Menus Management Section
        $moduleAppMenu = Module::updateOrCreate(['name' => 'Menu Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'Access menu',
            'slug'      => 'app.menus.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'Access menu builder',
            'slug'      => 'app.menus.builder'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'Create menu',
            'slug'      => 'app.menus.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'Edit menu',
            'slug'      => 'app.menus.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name'      => 'Delete menu',
            'slug'      => 'app.menus.destroy'
        ]);
    }
}
