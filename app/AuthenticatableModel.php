<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class AuthenticatableModel extends Authenticatable
{
    const TOKEN_TTL = 60 * 60; //seconds

    public function isTokenValid()
    {
        if ($this->api_token && Carbon::parse($this->attributes['token_created_at'])->diffInSeconds(Carbon::now()) < self::TOKEN_TTL) {
            return true;
        }
        return false;
    }

    public static function getValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);

        return $this;
    }

    public function setApiTokenAttribute($value)
    {
        $this->attributes['api_token'] = $value;
        $this->token_created_at = Carbon::now();
    }

    public static function generateApiToken()
    {
        return str_random(60);
    }
}
