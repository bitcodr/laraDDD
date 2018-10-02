<?php namespace App\Http\Aggregates\AddressBook\Repository;

use App\Http\Aggregates\AddressBook\Contract\AddressBookRepostitoryInterface;
use App\Http\Aggregates\AddressBook\Model\AddressBook;
use App\Http\Services\QueryBuilder\Service\QueryBuilder;

class AddressBookRepository implements AddressBookRepostitoryInterface
{

    public function getAll($user_id, $request, $columns = [])
    {
        $address = AddressBook::where('user_id', $user_id);
        return QueryBuilder::pageinateBuilder($request, $address, $columns);
    }

    public function getOne($address_id, $columns = [])
    {
        return AddressBook::findOrFial($address_id, $columns);
    }

    public function create($date)
    {
        return AddressBook::create($data);
    }

    public function delete($user_id, $address_id)
    {
        return AddressBook::where('id', $address_id)->delete();
    }

    public function update($address_id, $data)
    {
        return AddressBook::where('id', $address_id)->update($data);
    }

}
