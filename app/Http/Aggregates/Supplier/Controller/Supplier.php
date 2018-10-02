<?php namespace App\Http\Aggregate\Supplier\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Aggregate\Supplier\Enum\SupplierEnums;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Services\Auth\Adapter\AuthAdapter as Auth;
use App\Http\Aggregates\Supplier\Specification\SupplierIsActive;
use App\Http\Aggregate\Supplier\Adapter\SupplierAdapter as Supplier;
use App\Http\Requests\{SupplierRegisterRequest,SupplierStatusRequest};
use App\Http\Aggregate\Supplier\Transformer\{SupplierTransformer,SuppliersTransformer};

class SupplierController extends BaseController
{
    protected $supplier;
    protected $auth;


    public function __construct(Auth $auth,Supplier $supplier)
    {
        $this->supplier = $supplier;
        $this->auth = $auth;
    }

  
  
    public function suppliers(Request $request)
    {
        $suppliers = $this->supplier->getAll($request,['name','last_name','cell_phone','credit','photo','email','user_type','status','username']);
        return $this->response->paginator($suppliers, new SuppliersTransformer,['key'=>'data']);
    }


    public function supplier($supplier_id)
    {
        $supplier = $this->supplier->getOne($id,['name','last_name','cell_phone','credit','photo','email','user_type','status','username']);
        return $this->response->item($supplier, new SupplierTransformer);
    }

   

    public function categories($supplier_id,Request $request)
    {
        $orders = $this->order->supplierCategories($id,$request);
        return $this->response->paginator($orders, new SupplierCategoriesTransformer,['key'=>'data']);
    }




    public function register_supplier(SupplierRegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $request->merge([
              'user_type'            => SupplierEnums::USERTYPE,
              'status'               => SupplierEnums::ACTIVATE,
              'password' => app('hash')->make($request->input('password'))
            ]);            
            $register = $this->supplier->register($request->only( 'name','last_name','user_type','status' , 'cell_phone' , 'email', 'username' , 'password' ));
            $role = $this->auth->get_role_by(SupplierEnums::USERTYPE);
            $this->auth->assignRole($register->id,$role->id);
        });
        return $this->respondCreated(['data' => $request->input('username')]);
    }




    public function update_supplier($supplier_id,SupplierUpdateRequest $request)
    {
        $supplier = $this->supplier->getOne($id,['status']);
        $supplierIsActive = new SupplierIsActive();
        if($supplierIsActive->isSatisfiedBy($supplier->status))
        {
          return $this->respondUnprocessable(1123,'not_activate',trans('Supplier.supplier_status_is_not_activate'));
        }
        $this->supplier->update($id,$request->only('name','last_name','email'));
        return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }



    public function supplier_status($supplier_id,SupplierStatusRequest $request)
    {
      $this->supplier->changeStatus($id,$request);
      return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }



    public function delete($supplier_id)
    {
      $this->supplier->delete($id);
      return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }


}
