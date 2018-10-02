<?php  namespace App\Http\Aggregate\AddressBook\Transformer;

use App\Http\Services\Transformers\OverrideTransformerAbstract;
use App\Http\Aggregates\AddressBook\Model\AddressBook;
use App\Http\Aggregates\Customer\Model\CustomerTransformer;

class AddressBookTransformer extends OverrideTransformerAbstract
{
    protected $availableIncludes = ['user'];

    public function transform(AddressBook $address_book)
    {
      if ($address_book !== null)
      {
        return [  
          "id" => $address_book->id,
          "title" => $address_book->title,
          "radius" => $address_book->radius,
          "address" => $address_book->address,
          "latitude" => $address_book->latitude,
          "longitude" => $address_book->longitude,
          "created_at" => $address_book->created_at,
        ];
      }
    }

    public function includeAddressBook(AddressBook $address_book)
    {
        if($address_book->user !== null)
        {
          return $this->item($address_book->user, new CustomerTransformer());
        }
    }
}
