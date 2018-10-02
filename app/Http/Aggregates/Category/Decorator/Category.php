<?php namespace App\Http\Aggregates\Category\Decorator;

use App\Http\Aggregates\Address_book\Contract\CategoryRepostitoryInterface;
use Cache;

class CategoryDecorator implements CategoryRepostitoryInterface
{
    private $category;

    public function __construct(CategoryRepostitoryInterface $category)
    {
        $this->category = $category;
    }


    public function create($category_id, $data)
    {
        Cache::tags([$category_id.'Category'])->flush();
        return $this->Category->create($category_id, $data);
    }


    public function getAll($category_id, $request, $columns = [])
    {
        $url = $request->fullUrl();
        $cacheKey = $category_id.'Category-'.md5($url);    
        return Cache::tags([$category_id.'Category'])->remember($cacheKey, 20,function() use($category_id, $request, $columns){
            return $this->Category->getAll($category_id, $request, $columns);
        });
    }


    public function delete($category_id)
    {
        Cache::tags([$category_id.'Category'])->flush();
        return $this->Category->delete($category_id);
    }


    public function update($category_id, $data)
    {
        Cache::tags([$category_id.'Category'])->flush();
        return $this->Category->update($category_id, $data);
    }


    public function getOne($category_id, $columns = [])
    {
        $url = $request->fullUrl();
        $cacheKey = $category_id.'Category-'.md5($url);    
        return Cache::tags([$category_id.'Category'])->remember($cacheKey, 10,function() use($category_id, $columns){
            return $this->Category->getOne($category_id, $columns);
        });
    }


}