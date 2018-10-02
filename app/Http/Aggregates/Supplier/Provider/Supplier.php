<?php  namespace App\Http\Aggregates\Supplier\Provider;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\Supplier\Contract\SupplierRepositoryInterface;
use App\Http\Aggregates\Supplier\Repository\SupplierRepository;

class SupplierServiceProvider extends ServiceProvider
{

    
    public function boot()
    {

    }


    public function register()
    {
    
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);

    }
}
