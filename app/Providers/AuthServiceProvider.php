<?php

namespace App\Providers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function (Request $request) {
            if ($request->bearerToken()) {
                return UserModel::where('api_token', $request->bearerToken())->first();
            }
        });
    }
}
