<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'admin';
        $role_employee->description = 'admin';
        $role_employee->save();
        $role_manager = new Role();
        $role_manager->name = 'moderator';
        $role_manager->description = 'moderator';
        $role_manager->save();
        $role_manager = new Role();
        $role_manager->name = 'author';
        $role_manager->description = 'author';
        $role_manager->save();
  }
}
