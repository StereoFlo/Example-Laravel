<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', User::ROLE_ADMIN)->first();
        $role_moderator  = Role::where('name', User::ROLE_MODERATOR)->first();
        $role_author  = Role::where('name', User::ROLE_AUTHOR)->first();

        $employee = new User();
        $employee->name = 'admin';
        $employee->email = 'admin@recycle.lan';
        $employee->password = bcrypt('admin');
        $employee->save();
        $employee->roles()->attach($role_admin);
        $manager = new User();

        $manager->name = 'moderator';
        $manager->email = 'moderator@recycle.lan';
        $manager->password = bcrypt('moderator');
        $manager->save();
        $manager->roles()->attach($role_moderator);

        $manager->name = 'author';
        $manager->email = 'author@recycle.lan';
        $manager->password = bcrypt('author');
        $manager->save();
        $manager->roles()->attach($role_author);
    }
}
