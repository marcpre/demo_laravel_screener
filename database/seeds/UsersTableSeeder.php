<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
               
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@user.com';
        $user->password = bcrypt('user');
        $user->save();
        
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('admin');
        $admin->save();
    }
}
