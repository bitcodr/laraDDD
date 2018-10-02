<?php  namespace App\Http\Aggregates\AddressBook\Provider;

use Illuminate\Support\ServiceProvider;
use App\Http\Aggregates\AddressBook\Decorator\AddressBookDecorator;
use App\Http\Aggregates\AddressBook\Repository\AddressBookRepository;
use App\Http\Aggregates\AddressBook\Contract\AddressBookRepostitoryInterface;

class AddressBookServiceProvider extends ServiceProvider
{

    
    public function boot()
    {

    }


    public function register()
    {
    

        $this->app->singleton(AddressBookRepostitoryInterface::class,function(){
            return new AddressBookDecorator(
                new AddressBookRepository()
            );
        });
    }
}
