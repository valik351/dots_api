<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\TestingServer
 *
 * @property integer $id
 * @property string $name
 * @property string $api_token
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $token_created_at
 * @property string $login
 * @property string $password
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer whereApiToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer whereTokenCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer whereLogin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TestingServer wherePassword($value)
 * @mixin \Eloquent
 */
class TestingServer extends AuthenticatableModel
{
    use SoftDeletes;
    use Sortable;

    protected static $sortable_columns = [
        'id', 'name', 'login', 'token_created_at', 'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'api_token', 'password', 'token_created_at'
    ];
}
