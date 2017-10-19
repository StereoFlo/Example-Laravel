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

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@recycle.lan';
        $admin->password = \bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $manager = new User();
        $manager->name = 'moderator';
        $manager->email = 'moderator@recycle.lan';
        $manager->password = \bcrypt('moderator');
        $manager->save();
        $manager->roles()->attach($role_moderator);

        $author = new User();
        $author->name = 'author';
        $author->email = 'author@recycle.lan';
        $author->password = \bcrypt('author');
        $author->save();
        $author->roles()->attach($role_author);
    }
}
