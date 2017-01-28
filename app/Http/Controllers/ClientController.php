<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Controllers\Auth\AuthenticatableController;

class ClientController extends AuthenticatableController
{
    protected function getModel()
    {
        return Client::class;
    }
}
 