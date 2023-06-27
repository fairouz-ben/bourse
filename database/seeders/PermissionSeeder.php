<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissons = [
            [
                'name' => 'candidat@list',
                'display_name' => 'read candidats list',
                'description' => 'candidat@list'
            ],
            [
                'name' => 'candidat@listAll',
                'display_name' => 'read candidats all list',
                'description' => 'candidat@list all'
            ],
            [
                'name' => 'candidat@create',
                'display_name' => 'Create candidat',
                'description' => 'Create user candidat and'
            ],
            [
                'name' => 'candidat@update',
                'display_name' => 'Create and update some candidat data candidat',
                'description' => 'candidat update'
            ],
            [
                'name' => 'candidat@details',
                'display_name' => 'read candidat details',
                'description' => 'read candidat details'
            ],
            [
                'name' => 'candidat@etat',
                'display_name' => 'update candidat etat',
                'description' => 'update candidat etat'
            ],
            [
                'name' => 'candidat@IsfileValidat',
                'display_name' => 'update candidat IsfileValidat',
                'description' => 'update candidat IsfileValidat'
            ],
            [
                'name' => 'candidat@delete',
                'display_name' => 'Delete candidat ',
                'description' => 'Delete candidat'
            ],
            [
                'name' => 'admin@list',
                'display_name' => 'admins list',
                'description' => 'read admins list'
            ],
            [
                'name' => 'admin@create',
                'display_name' => 'create an admin user',
                'description' => 'create an admin user'
            ],
            [
                'name' => 'admin@update',
                'display_name' => 'admin@update',
                'description' => 'update admin'
            ],
            [
                'name' => 'user@list',
                'display_name' => 'user@list',
                'description' => 'show users list'
            ],
            [
                'name' => 'user@update',
                'display_name' => 'update user',
                'description' => 'update user'
            ],
            [
                'name' => 'user@delete',
                'display_name' => 'delete user',
                'description' => 'delete user'
            ],
        ];

        foreach ($permissons as $key => $value) {

            $permission = Permission::create([
                            'name' => $value['name'],
                            'display_name' => $value['display_name'],
                            'description' => $value['description']
                        ]);

            User::first()->givePermission($permission);
        }
    }
}
