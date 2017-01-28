<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create(['name' => 'test', 'login' => 'test', 'password' => 'test', 'api_token' => '']);
    }
}
