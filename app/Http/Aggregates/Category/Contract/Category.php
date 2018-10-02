<?php namespace App\Http\Aggregates\Category\Contract;

interface CategoryRepostitoryInterface
{
    public function create($user_id, $data);

    public function update($category_id, $data);

    public function delete($category_id);

    public function getOne($category_id, $columns = []);

    public function getAll($user_id, $request, $columns = []);
}
