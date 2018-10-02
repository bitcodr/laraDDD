<?php  namespace App\Http\Aggregates\Store\Provider;

use Illuminate\Support\ServiceProvider;
use App\Http\Aggregates\Store\Decorator\StoreDecorator;
use App\Http\Aggregates\Store\Repository\StoreRepository;
use App\Http\Aggregates\Store\Contract\StoreRepostitoryInterface;

class StoreServiceProvider extends ServiceProvider
{

    
    public function boot()
    {

    }


    public function register()
    {
    

        $this->app->singleton(StoreRepostitoryInterface::class,function(){
            return new StoreDecorator(
                new StoreRepository()
            );
        });
    }
}
