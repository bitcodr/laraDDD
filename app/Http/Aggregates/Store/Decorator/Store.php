<?php namespace App\Http\Aggregates\Store\Decorator;

use App\Http\Aggregates\Address_book\Contract\StoreRepostitoryInterface;
use Cache;

class StoreDecorator implements StoreRepostitoryInterface
{
    private $store;

    public function __construct(StoreRepostitoryInterface $store)
    {
        $this->store = $store;
    }


    public function create($category_id, $data)
    {
        Cache::tags([$category_id.'Store'])->flush();
        return $this->store->create($category_id, $data);
    }


    public function getAll($category_id, $request, $columns = [])
    {
        $url = $request->fullUrl();
        $cacheKey = $category_id.'Store-'.md5($url);    
        return Cache::tags([$category_id.'Store'])->remember($cacheKey, 20,function() use($category_id, $request, $columns){
            return $this->store->getAll($category_id, $request, $columns);
        });
    }


    public function delete($category_id,$store_id)
    {
        Cache::tags([$category_id.'Store'])->flush();
        return $this->store->delete($store_id);
    }


    public function update($category_id,$store_id, $data)
    {
        Cache::tags([$category_id.'Store'])->flush();
        return $this->store->update($store_id, $data);
    }


    public function getOne($category_id,$store_id, $columns = [])
    {
        $url = $request->fullUrl();
        $cacheKey = $store_id.'Store-'.md5($url);    
        return Cache::tags([$category_id.'Store'])->remember($cacheKey, 10,function() use($category_id,$store_id, $columns){
            return $this->store->getOne($category_id,$store_id, $columns);
        });
    }


}