<?php namespace App\Http\Aggregates\Supplier\Repository;

use Illuminate\Support\Facades\DB;
use App\Http\Aggregates\Supplier\Model\Supplier;
use App\Http\Aggregates\Supplier\Enum\SupplierEnums;
use App\Http\Services\QueryBuilder\Service\QueryBuilder;
use App\Http\Aggregates\Supplier\Contract\SupplierRepositoryInterface;

class SupplierRepository implements SupplierRepositoryInterface
{
 
    public function getAll($request,$columns = [])
    {
        $suppliers = Supplier::where('user_type','=','Supplier');
        return QueryBuilder::pageinateBuilder($request,$suppliers,$columns);
    }

    public function getOne($id,$columns = [])
    {
        return Supplier::where('id',$id)->where('user_type',SupplierEnums::USERTYPE)->firstOrFail($columns);
    }

    public function register($data)
    {
        return Supplier::create($data);
    }

    public function update($id,$request)
    {
        $supplier = Supplier::where('id',$id)->where('status','=',SupplierEnums::ACTIVATE)->firstOrFail();
        return $supplier->fill($request)->save();
    }

    public function change_status($id,$request)
    {
        $supplier = Supplier::where('id',$id)->firstOrFail();
        return $supplier->fill($request)->save();
    }

    public function delete($id)
    {
        return Supplier::where('id', $id)->delete();
    }


}
