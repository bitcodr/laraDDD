<?php  namespace App\Http\Aggregates\Supplier\Transformer;

use App\Http\Aggregates\Supplier\Model\Supplier;
use App\Http\Services\Transformers\OverrideTransformerAbstract;
use App\Http\Aggregate\AddressBook\Transformer\CategoryTransformer;

class SuppliersTransformer extends OverrideTransformerAbstract
{

    public function transform(Supplier $supplier)
    {
      if ($supplier !== null)
      {
        return [
          "id" => $supplier->id,
          "name" => $supplier->name,
          "last_name" => $supplier->last_name,
          "cell_phone" => $supplier->cell_phone,
          "credit" => $supplier->credit,
          "email" => $supplier->email,
          "status" => $supplier->status,
          "created_at" => $supplier->created_at,
          "photo" => $supplier->photo
        ];
      }
    }
}
