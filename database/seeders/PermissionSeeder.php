<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Role SuperAdmin
        $superadminRole = Role::create(['name' => 'SuperAdmin']);

         $user = User::factory()->create([
            'name' => 'Example superadmin user',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin')           
        ]);    
        $user->assignRole($superadminRole);  
        
        //Role Sales 
        $salesRole = Role::create(['name' => 'Sales']);

         $user = User::factory()->create([
            'name' => 'Sales User',
            'email' => 'sales@fanatech.com',
            'password' => Hash::make('admin')           
        ]);    
        $user->assignRole($salesRole);  

        //Role Purchase 
        $purchaseRole = Role::create(['name' => 'Purchase']);

         $user = User::factory()->create([
            'name' => 'Purchase User',
            'email' => 'purchase@fanatech.com',
            'password' => Hash::make('admin')           
        ]);    
        $user->assignRole($purchaseRole);  

        //Role Manager 
        $managerRole = Role::create(['name' => 'Manager']);

         $user = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@fanatech.com',
            'password' => Hash::make('admin')           
        ]);    
        $user->assignRole($managerRole);  
    }
}
