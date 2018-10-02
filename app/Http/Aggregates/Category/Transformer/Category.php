<?php  namespace App\Http\Aggregate\Category\Transformer;

use App\Http\Aggregates\Category\Model\Category;
use App\Http\Aggregate\Store\Transformer\StoreTransformer;
use App\Http\Aggregates\Customer\Model\CustomerTransformer;
use App\Http\Services\Transformers\OverrideTransformerAbstract;

class CategoryTransformer extends OverrideTransformerAbstract
{

   protected $availableIncludes = ['user','store'];
 

    public function transform(Category $category)
    {
      if ($category !== null)
      {
        return [  
          "id" => $category->id,
          "title" => $category->title,
          "description" => $category->description,
          "user_id" => $category->category_id,
          "created_at" => $category->created_at,
        ];
      }
    }


    public function includeUser(Category $category)
    {
        if($category->user !== null)
        {
          return $this->item($category->user, new CustomerTransformer());
        }
    }

    public function includeStore(Category $category)
    {
        if($category->store !== null)
        {
          return $this->collection($category->store, new StoreTransformer());
        }
    }

}
