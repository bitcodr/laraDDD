<?php namespace App\Http\Aggregates\Store\Contract;

interface StoreRepostitoryInterface
{
    public function create($category_id, $data);

    public function update($category_id,$store_id, $data);

    public function delete($category_id,$store_id);

    public function getOne($category_id,$store_id, $columns = []);

    public function getAll($category_id, $request, $columns = []);
}
