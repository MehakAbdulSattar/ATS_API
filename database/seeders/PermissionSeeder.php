<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Candidate_permissions = [];
        $HR_permissions = [
            // 'create_job',
            // 'update_job',
            // 'show_job',
            // 'show_specific_job',
            // 'delete_job',

        ];

        foreach ( $Candidate_permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        foreach ( $HR_permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }

        $role =Role::create(['name'=>'Candidate']);
        $role->givePermissionTo($Candidate_permissions);

        $role =Role::create(['name'=>'HR']);
        $role->givePermissionTo($HR_permissions);
    }
}
