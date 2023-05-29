<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'superAdmin',
                'display_name' => 'SuperAdmin',
                'description' => 'Can access all features!'
            ],

            [
                'name' => 'supervisor',
                'display_name' => 'Supervisor',
                'description' => 'Can Read limited features!'
            ],
            
            [
                'name' => 'rector',
                'display_name' => 'Rector',
                'description' => 'Can manage all candidat features!'
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'description' => 'Can CRU limited features!'
            ],
            [
                'name' => 'editor',
                'display_name' => 'Editor',
                'description' => 'CRU candidat'
            ],
            [
                'name' => 'candidat',
                'display_name' => 'candidat',
                'description' => 'CRU his own profile'
            ],
        ];

        foreach ($roles as $key => $value) {
            $role = Role::create([
                'name' => $value['name'],
                'display_name' => $value['display_name'],
                'description' => $value['description']
            ]);

            //User::first()->addRole($role);
        }
        $adminRole = Role::where('name', 'superAdmin')->first();
       // $editUserPermission = Permission::where('name', 'edit-user')->first();
        $user = User::find(1);

        $user->addRole($adminRole);
        // Or
       // $user->addRole('superAdmin');
    }
    
}
