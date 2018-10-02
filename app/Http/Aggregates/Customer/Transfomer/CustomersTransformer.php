<?php  namespace App\Http\Aggregates\Customer\Transformer;

use App\Http\Services\Transformers\OverrideTransformerAbstract;
use App\Http\Aggregates\Customer\Model\Customer;

class CustomersTransformer extends OverrideTransformerAbstract
{

    public function transform(Customer $customer)
    {
      if ($customer !== null)
      {
        return [
          "id" => $customer->id,
          "name" => $customer->name,
          "last_name" => $customer->last_name,
          "cell_phone" => $customer->cell_phone,
          "credit" => $customer->credit,
          "email" => $customer->email,
          "status" => $customer->status,
          "created_at" => $customer->created_at,
          "photo" => $customer->photo
        ];
      }
    }
}
