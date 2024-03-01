<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
include_once(app_path('Helpers/SeederHelper.php'));

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        createPermission('Users','View','Create','Update','Delete');
        createPermission('Roles','View','Create','Update','Delete');
    }
}
