<?php namespace App\Http\Aggregates\Customer\Repository;

use Illuminate\Support\Facades\DB;
use App\Http\Aggregates\Customer\Model\Customer;
use App\Http\Aggregates\Customer\Enum\CustomerEnums;
use App\Http\Services\QueryBuilder\Service\QueryBuilder;
use App\Http\Aggregates\Customer\Contract\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{
 
    public function getAll($request,$columns = [])
    {
        $customers = Customer::where('user_type','=','customer');
        return QueryBuilder::pageinateBuilder($request,$customers,$columns);
    }

    public function getOne($id,$columns = [])
    {
        return Customer::where('id',$id)->where('user_type',CustomerEnums::USERTYPE)->firstOrFail($columns);
    }

    public function register($data)
    {
        return Customer::create($data);
    }

    public function update($id,$request)
    {
        $customer = Customer::where('id',$id)->where('status','=',CustomerEnums::ACTIVATE)->firstOrFail();
        return $customer->fill($request)->save();
    }

    public function change_status($id,$request)
    {
        $customer = Customer::where('id',$id)->firstOrFail();
        return $customer->fill($request)->save();
    }

    public function delete($id)
    {
        return Customer::where('id', $id)->delete();
    }


}
