<?php namespace App\Http\Aggregates\AddressBook\Decorator;

use App\Http\Aggregates\Address_book\Contract\AddressBookRepostitoryInterface;
use Cache;

class AddressBookDecorator implements AddressBookRepostitoryInterface
{
    private $addressBook;

    public function __construct(AddressBookRepostitoryInterface $addressBook)
    {
        $this->addressBook = $addressBook;
    }


    public function create($user_id, $data)
    {
        Cache::tags([$user_id.'addressBook'])->flush();
        return $this->addressBook->create($user_id, $data);
    }


    public function getAll($user_id, $request, $columns = [])
    {
        $url = $request->fullUrl();
        $cacheKey = $user_id.'addressBook-'.md5($url);    
        return Cache::tags([$user_id.'addressBook'])->remember($cacheKey, 20,function() use($user_id, $request, $columns){
            return $this->addressBook->getAll($user_id, $request, $columns);
        });
    }


    public function delete($user_id, $address_id)
    {
        Cache::tags([$user_id.'addressBook'])->flush();
        return $this->addressBook->delete($user_id, $address_id);
    }


    public function update($user_id, $address_id, $data)
    {
        Cache::tags([$user_id.'addressBook'])->flush();
        return $this->addressBook->update($user_id, $address_id, $data);
    }


    public function getOne($user_id, $address_id, $columns = [])
    {
        $url = $request->fullUrl();
        $cacheKey = $user_id.'addressBook-'.md5($url);    
        return Cache::tags([$user_id.'addressBook'])->remember($cacheKey, 10,function() use($user_id, $address_id, $columns){
            return $this->addressBook->getOne($user_id, $address_id, $columns);
        });
    }


}