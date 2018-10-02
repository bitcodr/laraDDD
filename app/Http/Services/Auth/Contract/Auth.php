<?php namespace App\Http\Services\Auth\Contract;

interface AuthRepositoryInterface
{
    public function assignRole($user_id,$rol_id);

    public function get_role_by($name);  
    
    public function get_user($username);
}

 
