<?php namespace App\Http\Aggregates\Store\Repository;

use App\Http\Aggregates\Store\Model\Store;
use App\Http\Services\QueryBuilder\Service\QueryBuilder;
use App\Http\Aggregates\Store\Contract\StoreRepostitoryInterface;

class StoreRepository implements StoreRepostitoryInterface
{

    public function getAll($category_id, $request, $columns = [])
    {
        $store = Store::where('user_id', $user_id);
        return QueryBuilder::pageinateBuilder($request, $store, $columns);
    }

    public function getOne($category_id,$store_id, $columns = [])
    {
        return Store::findOrFial($store_id, $columns);
    }

    public function create($category_id,$date)
    {
        return Store::create($data);
    }

    public function delete($category_id,$store_id)
    {
        return Store::where('id', $store_id)->delete();
    }

    public function update($category_id,$store_id, $data)
    {
        return Store::where('id', $store_id)->update($data);
    }

}
