<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'root',
            'email'    => 'ag45root@gmail.com',
            'password' => 'geRayay8',
        ])->save();
    }
}
