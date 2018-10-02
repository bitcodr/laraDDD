<?php  namespace App\Http\Aggregate\Store\Transformer;

use App\Http\Services\Transformers\OverrideTransformerAbstract;
use App\Http\Aggregates\Store\Model\Store;
use App\Http\Aggregate\Category\Transformer\CategoryTransformer;

class StoreTransformer extends OverrideTransformerAbstract
{

    protected $availableIncludes = ['category'];

    public function transform(Store $store)
    {
      if ($store !== null)
      {
        return [  
          "id" => $store->id,
          "title" => $store->title,
          "description" => $store->description,
          "category_id" => $store->category_id,
          "created_at" => $store->created_at,
        ];
      }
    }

    public function includeCategory(Store $store)
    {
        if($store->category !== null)
        {
          return $this->item($store->category, new CategoryTransformer());
        }
    }


}
