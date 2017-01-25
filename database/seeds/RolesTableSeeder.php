<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Role();
        $admin->name         = \App\Role::ROLE_SLUG_ADMIN;
        $admin->display_name = 'Адмiнiстратор';
        $admin->save();

        $user = \App\User::where('email', 'reedwalter24@gmail.com')->first();
        $user->attachRole($admin);
    }
}
