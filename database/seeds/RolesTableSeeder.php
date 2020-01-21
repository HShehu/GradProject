<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit blog posts']);
        Permission::create(['name' => 'Administer roles & permissions']);
        Permission::create(['name' => 'Administer users']);
        Permission::create(['name' => 'edit comment']);

        // create roles and assign created permissions

        $role = Role::create(['name' => 'user']);
        //   $role->givePermissionTo('edit articles');

        $role = Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());
    }
}
