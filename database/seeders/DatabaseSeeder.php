<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SuperAdminsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
    }
}

class SuperAdminsSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'super-admin',
            'last_name' => 'super-admin',
            'middle_name' => 'super-admin',
            'active_status' => true,
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$RpZ48rbnwP8whJEYfivM.uSCK28hSmIl29pU4L/FOez.fyes2pauK', //admin@123
            'is_super_admin' => true,
            'remember_token' => ''
        ]);
    }
}

class RolesSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'Student',
            'description' => 'Student Role',
        ]);
    }
}

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'roles.view',
                'type' => 'roles',
                'description' => 'User Can View Roles'
            ],
            [
                'id' => 2,
                'name' => 'roles.add',
                'type' => 'roles',
                'description' => 'User Can Add Roles'
            ],
            [
                'id' => 3,
                'name' => 'roles.edit',
                'type' => 'roles',
                'description' => 'User Can Edit Roles'
            ],
            [
                'id' => 4,
                'name' => 'roles.delete',
                'type' => 'roles',
                'description' => 'User Can Delete Roles'
            ],
            [
                'id' => 5,
                'name' => 'users.view',
                'type' => 'users',
                'description' => 'User Can View Users'
            ],
            [
                'id' => 6,
                'name' => 'users.add',
                'type' => 'users',
                'description' => 'User Can Add Users'
            ],
            [
                'id' => 7,
                'name' => 'users.edit',
                'type' => 'users',
                'description' => 'User Can Edit Users'
            ],
            [
                'id' => 8,
                'name' => 'users.delete',
                'type' => 'users',
                'description' => 'User Can Delete Users'
            ],
            [
                'id' => 9,
                'name' => 'lessons.view',
                'type' => 'lessons',
                'description' => 'User Can View Lessons'
            ],
            [
                'id' => 10,
                'name' => 'lessons.add',
                'type' => 'lessons',
                'description' => 'User Can Add Lessons'
            ],
            [
                'id' => 11,
                'name' => 'lessons.edit',
                'type' => 'lessons',
                'description' => 'User Can Edit Lessons'
            ],
            [
                'id' => 12,
                'name' => 'lessons.delete',
                'type' => 'lessons',
                'description' => 'User Can Delete Lessons'
            ],
            [
                'id' => 13,
                'name' => 'courses.view',
                'type' => 'courses',
                'description' => 'User Can View Courses'
            ],
            [
                'id' => 14,
                'name' => 'courses.add',
                'type' => 'courses',
                'description' => 'User Can Add Courses'
            ],
            [
                'id' => 15,
                'name' => 'courses.edit',
                'type' => 'courses',
                'description' => 'User Can Edit Courses'
            ],
            [
                'id' => 16,
                'name' => 'courses.delete',
                'type' => 'courses',
                'description' => 'User Can Delete Courses'
            ],
            [
                'id' => 17,
                'name' => 'questions.view',
                'type' => 'questions',
                'description' => 'User Can View Questions'
            ],
            [
                'id' => 18,
                'name' => 'questions.add',
                'type' => 'questions',
                'description' => 'User Can Add Questions'
            ],
            [
                'id' => 19,
                'name' => 'questions.edit',
                'type' => 'questions',
                'description' => 'User Can Edit Questions'
            ],
            [
                'id' => 20,
                'name' => 'questions.delete',
                'type' => 'questions',
                'description' => 'User Can Delete Questions'
            ],
            [
                'id' => 21,
                'name' => 'tests.view',
                'type' => 'tests',
                'description' => 'User Can View Tests'
            ],
            [
                'id' => 22,
                'name' => 'tests.add',
                'type' => 'tests',
                'description' => 'User Can Add Tests'
            ],
            [
                'id' => 23,
                'name' => 'tests.edit',
                'type' => 'tests',
                'description' => 'User Can Edit Tests'
            ],
            [
                'id' => 24,
                'name' => 'tests.delete',
                'type' => 'tests',
                'description' => 'User Can Delete Tests'
            ],
            [
                'id' => 25,
                'name' => 'assign.course.view',
                'type' => 'assigned-courses',
                'description' => 'User Can View Assigned Course'
            ],
            [
                'id' => 26,
                'name' => 'assign.course.add',
                'type' => 'assigned-courses',
                'description' => 'User Can Assign Course'
            ],
            [
                'id' => 27,
                'name' => 'assign.course.edit',
                'type' => 'assigned-courses',
                'description' => 'User Can Edit Assigned Course'
            ],
            [
                'id' => 28,
                'name' => 'assign.course.delete',
                'type' => 'assigned-courses',
                'description' => 'User Can Delete Assigned Course'
            ],
            [
                'id' => 29,
                'name' => 'categories.view',
                'type' => 'categories',
                'description' => 'User Can View Categories'
            ],
            [
                'id' => 30,
                'name' => 'categories.add',
                'type' => 'categories',
                'description' => 'User Can Add Categories'
            ],
            [
                'id' => 31,
                'name' => 'categories.edit',
                'type' => 'categories',
                'description' => 'User Can Edit Categories'
            ],
            [
                'id' => 32,
                'name' => 'categories.delete',
                'type' => 'categories',
                'description' => 'User Can Delete Categories'
            ],
        ]);
    }
}
