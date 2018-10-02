<?php  namespace App\Http\Aggregates\Category\Provider;

use Illuminate\Support\ServiceProvider;
use App\Http\Aggregates\Category\Decorator\CategoryDecorator;
use App\Http\Aggregates\Category\Repository\CategoryRepository;
use App\Http\Aggregates\Category\Contract\CategoryRepostitoryInterface;

class CategoryServiceProvider extends ServiceProvider
{

    
    public function boot()
    {

    }


    public function register()
    {
    

        $this->app->singleton(CategoryRepostitoryInterface::class,function(){
            return new CategoryDecorator(
                new CategoryRepository()
            );
        });
    }
}
