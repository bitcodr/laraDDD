<?php namespace App\Http\Aggregates\AddressBook\Controller;

use App\Http\Aggregates\AddressBook\Contract\AddressBookRepostitoryInterface as AddressBook;
use App\Http\Aggregates\AddressBook\Transformer\AddressBookTransformer;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\AddressBookRequest;
use Illuminate\Http\Request;

class AddressBookController extends BaseController
{

    private $addressBook;

    public function __construct(AddressBook $addressBook)
    {
        $this->addressBook = $addressBook;
    }



    public function addAddressBook($user_id, AddressBookRequest $request)
    {
        $request->merge([
            'user_id' => $user_id,
        ]);
        $addressBook = $this->addressBook->create($user_id, $request->only('title', 'latitude', 'longitude', 'radius', 'address', 'user_id'));
        return $this->respond(['data' => $addressBook->id]);
    }



    public function updateAddressBook($user_id, $address_id, AddressBookRequest $request)
    {
        $this->addressBook->update($user_id, $address_id, $request->only('title', 'latitude', 'longitude', 'radius', 'address'));
        return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }



    public function getAddressBooks($user_id, Request $request)
    {
        $address_book = $this->addressBook->getAll($user_id, $request, ['title', 'latitude', 'longitude', 'radius', 'address']);
        return $this->response->paginator($address_book, new AddressBookTransformer, ['key' => 'data']);
    }



    public function getAddressBook($user_id, $address_id)
    {
        $address_book = $this->addressBook->getOne($user_id, $address_id, ['title', 'latitude', 'longitude', 'radius', 'address']);
        return $this->response->paginator($address_book, new AddressBookTransformer, ['key' => 'data']);
    }



    public function deleteAddressBook($user_id, $address_id)
    {
        $this->addressBook->delete($user_id, $address_id);
        return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }

    
}
