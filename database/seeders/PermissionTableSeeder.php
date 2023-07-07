<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'ticket-list',
            'ticket-create',
            'ticket-edit',
            'ticket-delete',
            'ticket-message',
            'status-list',
            'status-create',
            'status-edit',
            'status-delete',
            'important-list',
            'important-create',
            'important-edit',
            'important-delete',
            'setings',
            'ticket-status',
            'ticket-important',
            'edit-ticket',
            'delete-btn',
        ];

        foreach ($data as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
