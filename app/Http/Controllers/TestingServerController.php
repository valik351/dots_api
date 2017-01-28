<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatableController;
use App\TestingServer;

class TestingServerController extends AuthenticatableController
{
    protected function getModel()
    {
        return TestingServer::class;
    }
}
 