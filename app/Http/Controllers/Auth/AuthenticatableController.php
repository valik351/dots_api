<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

abstract class AuthenticatableController extends Controller
{
    abstract protected function getModel();

    public function getToken(Request $request)
    {
        $model = forward_static_call([$this->getModel(), 'where'], 'login', $request->getUser())->first();
        if (!Hash::check($request->getPassword(), $model->password)) {
            return response('Unauthorized', 401);
        }

        if (!$model->isTokenValid()) {
            $model->api_token = forward_static_call([static::getModel(), 'generateApiToken']);
            $model->save();
        }
        return ['api_token' => $model->api_token];
    }
}
