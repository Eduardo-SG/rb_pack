<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SeederTablePermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //roles table
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',

            //user table
             'view-user',
             'create-user',
             'edit-user',
             'delete-user',

             //client table
             'view-client',
             'create-client',
             'edit-client',
             'delete-client',

             //part table
             'view-part',
             'create-part',
             'edit-part',
             'delete-part',

             //process table
             'view-process',
             'create-process',
             'edit-process',
             'delete-process',

             //order table
             'view-order',
             'create-order',
             'edit-order',
             'delete-order',
        ];

        foreach ($permissions as $permission) {
            # code...
            Permission::create(['name'=>$permission]);
        }
    }
}
