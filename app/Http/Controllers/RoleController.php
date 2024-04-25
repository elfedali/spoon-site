<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public  function index()
    {
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
    }
}
