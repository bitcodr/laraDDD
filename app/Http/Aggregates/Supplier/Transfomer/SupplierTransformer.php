<?php  namespace App\Http\Aggregates\Supplier\Transformer;

use App\Http\Aggregates\Supplier\Model\Supplier;
use App\Http\Services\Transformers\OverrideTransformerAbstract;
use App\Http\Aggregate\AddressBook\Transformer\AddressBookTransformer;
use App\Http\Aggregate\AddressBook\Transformer\CategoryTransformer;


class SupplierTransformer extends OverrideTransformerAbstract
{

    protected $availableIncludes = ['addressBook','categories'];


    public function transform(Supplier $supplier)
    {
      if ($supplier !== null)
      {
        return [
          "id" => $supplier->id,
          "name" => $supplier->name,
          "user_type" => $supplier->user_type,
          "last_name" => $supplier->last_name,
          "cell_phone" => $supplier->cell_phone,
          "credit" => $supplier->credit,
          "email" => $supplier->email,
          "status" => $supplier->status,
          "photo" => $supplier->photo,
          "created_at" => $supplier->created_at,
        ];
      }
    }

    public function includeAddressBook(Supplier $supplier)
    {
        if($supplier->addressBook !== null)
        {
          return $this->collection($supplier->addressBook, new AddressBookTransformer());
        }
    }


    public function includeCategories(Supplier $supplier)
    {
        if($supplier->categories !== null)
        {
          return $this->collection($supplier->categories, new CategoryTransformer());
        }
    }

}
