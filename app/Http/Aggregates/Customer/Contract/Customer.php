<?php namespace App\Http\Aggregates\Customer\Contract;

interface CustomerRepositoryInterface
{
    public function getAll($request,$columns = []);

    public function getOne($id,$columns = []);
    
    public function register($data);  

    public function update($id,$request);

    public function change_status($id,$request);

    public function delete($id);  
}
