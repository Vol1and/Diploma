<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Перезагрузка ролей и пермишнов в кеше
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'income access']);
        Permission::create(['name' => 'income create']);
        Permission::create(['name' => 'income edit']);
        Permission::create(['name' => 'outcome access']);
        Permission::create(['name' => 'outcome create']);
        Permission::create(['name' => 'outcome edit']);
        Permission::create(['name' => 'wares access']);
        Permission::create(['name' => 'admin panel access']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'pharmacist']);
        $role1->givePermissionTo('income access');
        $role1->givePermissionTo('income create');
        $role1->givePermissionTo('income edit');
        $role1->givePermissionTo('wares access');

        // create roles and assign existing permissions
        $role2 = Role::create(['name' => 'manager']);
        $role2->givePermissionTo('income access');
        $role2->givePermissionTo('income create');
        $role2->givePermissionTo('income edit');
        $role2->givePermissionTo('outcome access');
        $role2->givePermissionTo('outcome create');
        $role2->givePermissionTo('wares access');

        $role3 = Role::create(['name' => 'admin']);
        $role3->givePermissionTo('income access');
        $role3->givePermissionTo('income create');
        $role3->givePermissionTo('income edit');
        $role3->givePermissionTo('outcome access');
        $role3->givePermissionTo('outcome create');
        $role3->givePermissionTo('outcome edit');
        $role3->givePermissionTo('wares access');
        $role3->givePermissionTo('admin panel access');


        // create demo users
        $user = User::factory()->create([
            'name' => 'Pharmacist1',
            'email' => 'pharmacist1@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($role1);

        // create demo users
        $user = User::factory()->create([
            'name' => 'Pharmacist2',
            'email' => 'pharmacist2@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($role1);

        // create demo users
        $user = User::factory()->create([
            'name' => 'Pharmacist3',
            'email' => 'pharmacist3@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($role1);

        // create demo users
        $user = User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole($role3);
    }
}
