<?php namespace App\Http\Aggregate\Customer\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Aggregate\Customer\Enum\CustomerEnums;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Services\Auth\Adapter\AuthAdapter as Auth;
use App\Http\Aggregates\Customer\Specification\CustomerIsActive;
use App\Http\Aggregate\Customer\Adapter\CustomerAdapter as Customer;
use App\Http\Requests\{CustomerRegisterRequest,CustomerStatusRequest};
use App\Http\Aggregate\Customer\Transformer\{CustomerTransformer,CustomersTransformer};

class CustomerController extends BaseController
{
    protected $customer;
    protected $auth;


    public function __construct(Auth $auth,Customer $customer)
    {
        $this->customer = $customer;
        $this->auth = $auth;
    }

  
  
    public function customers(Request $request)
    {
        $customers = $this->customer->getAll($request,['name','last_name','cell_phone','credit','photo','email','user_type','status','username']);
        return $this->response->paginator($customers, new CustomersTransformer,['key'=>'data']);
    }


    public function customer($customer_id)
    {
        $customer = $this->customer->getOne($id,['name','last_name','cell_phone','credit','photo','email','user_type','status','username']);
        return $this->response->item($customer, new CustomerTransformer);
    }

   

    public function orders($customer_id,Request $request)
    {
        $orders = $this->order->customerOrders($id,$request);
        return $this->response->paginator($orders, new CustomerOrdersTransformer,['key'=>'data']);
    }




    public function register_customer(CustomerRegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $request->merge([
              'user_type'            => CustomerEnums::USERTYPE,
              'status'               => CustomerEnums::ACTIVATE,
              'password' => app('hash')->make($request->input('password'))
            ]);            
            $register = $this->customer->register($request->only( 'name','last_name','user_type','status' , 'cell_phone' , 'email', 'username' , 'password' ));
            $role = $this->auth->get_role_by(CustomerEnums::USERTYPE);
            $this->auth->assignRole($register->id,$role->id);
        });
        return $this->respondCreated(['data' => $request->input('username')]);
    }




    public function update_customer($customer_id,CustomerUpdateRequest $request)
    {
        $customer = $this->customer->getOne($id,['status']);
        $customerIsActive = new CustomerIsActive();
        if($customerIsActive->isSatisfiedBy($customer->status))
        {
          return $this->respondUnprocessable(1123,'not_activate',trans('customer.customer_status_is_not_activate'));
        }
        $this->customer->update($id,$request->only('name','last_name','email'));
        return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }



    public function customer_status($customer_id,CustomerStatusRequest $request)
    {
      $this->customer->changeStatus($id,$request);
      return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }



    public function delete($customer_id)
    {
      $customer_active_orders = $this->order->customer_active_orders_count($id);
      $customerHasActiveOrder = new CustomerHasActiveOrder();
      if($customerHasActiveOrder->isSatisfiedBy($customer_active_orders))
      {
        return $this->respondUnprocessable(2445,'cannot',trans('customer.cannot_delete_customer_when_active_orders_exist'));
      }
      $this->customer->delete($id);
      return $this->respond(['meta' => ['title' => trans('general.core.ok'), 'code' => $this->getStatusCode()]]);
    }


}
