<?php  namespace App\Http\Aggregates\Auth\Provider;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\Auth\Contract\AuthRepositoryInterface;
use App\Http\Services\Auth\Service\AuthService;

class AuthServiceProvider extends ServiceProvider
{

    
    public function boot()
    {

    }


    public function register()
    {
    
        $this->app->bind(AuthRepositoryInterface::class, AuthService::class);

    }
}
