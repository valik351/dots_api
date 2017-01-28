<?php

use App\TestingServer;
use Illuminate\Database\Seeder;

class TestingServersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TestingServer::create(['name' => 'test', 'login' => 'test', 'password' => 'test', 'api_token' => '']);
    }
}
