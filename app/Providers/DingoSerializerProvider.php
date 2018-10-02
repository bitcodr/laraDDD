<?php namespace App\Providers;

use League\Fractal\Manager;
use Illuminate\Support\ServiceProvider;
use Dingo\Api\Transformer\Adapter\Fractal;
use App\Http\Services\Transformers\NoDataArraySerializer;

class DingoSerializerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->app['Dingo\Api\Transformer\Factory']->setAdapter(function ($app) {
          $fractal = new Manager;
          $fractal->setSerializer(new NoDataArraySerializer());
          return new Fractal($fractal);
      });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
