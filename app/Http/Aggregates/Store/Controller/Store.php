<?php namespace App\Http\Aggregates\Store\Controller;

use App\Http\Aggregates\Store\Contract\StoreRepostitoryInterface as Store;
use App\Http\Aggregates\Store\Transformer\StoreTransformer;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;

class StoreController extends BaseController
{

    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }



    public function addStore($category_id, StoreRequest $request)
    {
        $store = $this->store->create($category_id, $request->only('title', 'description', 'category_id'));
        return $this->respond(['data' => $store->id]);
    }



    public function updateStore($category_id,$store_id, StoreRequest $request)
    {
        $this->store->update($category_id,$store_id, $request->only('title', 'description', 'category_id'));
        return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }



    public function getStores($category_id, Request $request)
    {
        $store = $this->store->getAll($category_id, $request, ['title', 'description', 'category_id']);
        return $this->response->paginator($store, new StoreTransformer, ['key' => 'data']);
    }

    

    public function getStore($category_id,$store_id)
    {
        $store = $this->store->getOne($category_id,$store_id, ['title', 'description', 'category_id']);
        return $this->response->paginator($store, new StoreTransformer, ['key' => 'data']);
    }



    public function deleteStore($category_id,$store_id)
    {
        $this->store->delete($category_id,$store_id);
        return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }

    
}
