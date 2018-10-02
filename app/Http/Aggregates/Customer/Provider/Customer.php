<?php  namespace App\Http\Aggregates\Customer\Provider;

use Illuminate\Support\ServiceProvider;
use App\Http\Services\Customer\Contract\CustomerRepositoryInterface;
use App\Http\Aggregates\Customer\Repository\CustomerRepository;

class CustomerServiceProvider extends ServiceProvider
{

    
    public function boot()
    {

    }


    public function register()
    {
    
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);

    }
}
