<?php  namespace App\Http\Aggregates\Customer\Transformer;

use App\Http\Aggregates\Customer\Model\Customer;
use App\Http\Services\Transformers\OverrideTransformerAbstract;
use App\Http\Aggregates\AddressBook\Transformer\AddressBookTransformer;


class CustomerTransformer extends OverrideTransformerAbstract
{

    protected $availableIncludes = ['addressBook'];


    public function transform(Customer $customer)
    {
      if ($customer !== null)
      {
        return [
          "id" => $customer->id,
          "name" => $customer->name,
          "user_type" => $customer->user_type,
          "last_name" => $customer->last_name,
          "cell_phone" => $customer->cell_phone,
          "credit" => $customer->credit,
          "email" => $customer->email,
          "status" => $customer->status,
          "photo" => $customer->photo,
          "created_at" => $customer->created_at,
        ];
      }
    }

    public function includeAddressBook(Customer $customer)
    {
        if($customer->addressBook !== null)
        {
          return $this->collection($customer->addressBook, new AddressBookTransformer());
        }
    }

}
