<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create system Roles
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'receptionist']);
        Role::create(['name' => 'client']);
    }
}
