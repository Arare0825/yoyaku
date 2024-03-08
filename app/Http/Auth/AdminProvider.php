<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\EloquentUserProvider;

class AdminProvider extends EloquentUserProvider
{
    /**
     * 与えられた credentials からユーザーのインスタンスを探す
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        return parent::retrieveByCredentials($credentials);
    }
}