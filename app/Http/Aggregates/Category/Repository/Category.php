<?php namespace App\Http\Aggregates\Category\Repository;

use App\Http\Aggregates\Category\Model\Category;
use App\Http\Services\QueryBuilder\Service\QueryBuilder;
use App\Http\Aggregates\Category\Contract\CategoryRepostitoryInterface;

class CategoryRepository implements CategoryRepostitoryInterface
{

    public function getAll($user_id, $request, $columns = [])
    {
        $category = Category::where('user_id', $user_id);
        return QueryBuilder::pageinateBuilder($request, $category, $columns);
    }

    public function getOne($category_id, $columns = [])
    {
        return Category::findOrFial($category_id, $columns);
    }

    public function create($user_id,$date)
    {
        return Category::create($data);
    }

    public function delete($category_id)
    {
        return Category::where('id', $category_id)->delete();
    }

    public function update($category_id, $data)
    {
        return Category::where('id', $category_id)->update($data);
    }

}
