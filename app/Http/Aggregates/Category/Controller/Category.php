<?php namespace App\Http\Aggregates\Category\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Aggregates\Category\Transformer\CategoryTransformer;
use App\Http\Aggregates\Category\Contract\CategoryRepostitoryInterface as Category;

class CategoryController extends BaseController
{

    private $Category;

    public function __construct(Category $Category)
    {
        $this->Category = $Category;
    }



    public function addCategory($user_id, CategoryRequest $request)
    {
        $Category = $this->Category->create($user_id, $request->only('title', 'description', 'user_id'));
        return $this->respond(['data' => $Category->id]);
    }



    public function updateCategory($user_id,$category_id, CategoryRequest $request)
    {
        $this->Category->update($category_id, $request->only('title', 'description', 'user_id'));
        return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }



    public function getCategories($user_id,$category_id, Request $request)
    {
        $Category = $this->Category->getAll($user_id, $request, ['title', 'description', 'user_id']);
        return $this->response->paginator($Category, new CategoryTransformer, ['key' => 'data']);
    }

    

    public function getCategory($user_id,$category_id)
    {
        $Category = $this->Category->getOne($category_id, ['title', 'description', 'user_id']);
        return $this->response->paginator($Category, new CategoryTransformer, ['key' => 'data']);
    }



    public function deleteCategory($user_id,$category_id)
    {
        $this->Category->delete($category_id);
        return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }

    
}
