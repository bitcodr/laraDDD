<?php namespace App\Http\Aggregates\AddressBook\Contract;

interface AddressBookRepostitoryInterface
{
    public function create($user_id, $data);

    public function update($user_id, $address_id, $data);

    public function delete($user_id, $address_id);

    public function getOne($user_id, $address_id, $columns = []);

    public function getAll($user_id, $request, $columns = []);
}
