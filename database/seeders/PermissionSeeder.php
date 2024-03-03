<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Helpers\SeederHelper;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = new SeederHelper();
        $seeder->createPermission('Users','View','Create','Update','Delete');
        $seeder->createPermission('Roles','View','Create','Update','Delete');
    }
}
