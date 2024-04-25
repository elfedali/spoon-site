<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Créer le rôle SuperAdmin
        $superAdminRole = Role::create(['name' => 'SuperAdmin']);

        // Créer les permissions
        $editRestaurantPermission = Permission::create(['name' => 'Modifier Restaurant']);
        $storeRestaurantPermission = Permission::create(['name' => 'Ajouter Restaurant']);
        $updateRestaurantPermission = Permission::create(['name' => 'Mettre à jour Restaurant']);
        $deleteRestaurantPermission = Permission::create(['name' => 'Supprimer Restaurant']);

        // Assigner les permissions au rôle SuperAdmin
        $superAdminRole->syncPermissions([
            $editRestaurantPermission,
            $storeRestaurantPermission,
            $updateRestaurantPermission,
            $deleteRestaurantPermission
        ]);

        // Créer le rôle Manager
        $managerRole = Role::create(['name' => 'Manager']);

        // Assigner les permissions au rôle Manager
        $managerRole->syncPermissions([
            $editRestaurantPermission,
            $storeRestaurantPermission,
            $updateRestaurantPermission,
            $deleteRestaurantPermission
        ]);

        // Create a user
        $user = User::factory()->create([
            'name' => 'Webmaster',
            'email' => 'webmaster@spoon.ma',
        ]);

        // Assign SuperAdmin role to the user
        $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        $user->assignRole($superAdminRole);

        // create tree manager role users
        // Create 3 manager role users
        $managerRole = Role::where('name', 'Manager')->first();

        $userM1 = User::factory()->create([
            'name' => 'Manager1',
            'email' => 'manager1@spoon.ma',
        ]);
        $userM2 = User::factory()->create([
            'name' => 'Manager2',
            'email' => 'manager2@spoon.ma',
        ]);

        $userM3 = User::factory()->create([
            'name' => 'Manager3',
            'email' => 'manager3@spoon.ma',
        ]);
        $userM1->assignRole($managerRole);
        $userM2->assignRole($managerRole);
        $userM3->assignRole($managerRole);





        // place
        // \App\Models\Place::factory(10)->create();
    }
}
