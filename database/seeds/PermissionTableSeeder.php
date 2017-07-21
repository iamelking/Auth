<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'role-list',
                'display_name' => 'Display Role Listing',
                'description' => 'See only Listing Of Role'
            ],
            [
                'name' => 'role-create',
                'display_name' => 'Create Role',
                'description' => 'Create New Role'
            ],
            [
                'name' => 'role-edit',
                'display_name' => 'Edit Role',
                'description' => 'Edit Role'
            ],
            [
                'name' => 'role-delete',
                'display_name' => 'Delete Role',
                'description' => 'Delete Role'
            ],
            [
                'name' => 'student-list',
                'display_name' => 'Display student Listing',
                'description' => 'See only Listing Of student'
            ],
            [
                'name' => 'student-create',
                'display_name' => 'Create student',
                'description' => 'Create New student'
            ],
            [
                'name' => 'student-edit',
                'display_name' => 'Edit student',
                'description' => 'Edit student'
            ],
            [
                'name' => 'student-delete',
                'display_name' => 'Delete student',
                'description' => 'Delete student'
            ]
        ];
        foreach ($permissions as $key => $value) {
        	Permission::create($value);
        }
    }
}
