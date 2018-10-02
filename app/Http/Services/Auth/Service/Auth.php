<?php namespace App\Http\Services\Auth\Service;

use App\Http\Services\Auth\Model\{Role,User,RoleUser};
use App\Http\Services\Auth\Adapter\AuthAdapter;

class AuthService implements AuthAdapter
{


    public function assignRole($user_id,$rol_id)
    {
        $user_role =  RoleUser::where('user_id',$user_id)->where('role_id',$rol_id)->firstOrFail(['user_id']);
        if($user_role ==null)
        {
            $user = User::where('id',$user_id)->firstOrFail(['id']);
            $role = Role::where('id', $rol_id)->firstOrFail(['id']);
            $data = [
                'user_id'=> $user->id,
                'role_id'=> $role->id
            ];
            return RoleUser::create($data);
        }
    }



    public function get_role_by($name)
    {
        return Role::where('name','=',$name)->firstOrFail();
    }
    

    public function get_user($username)
    {
       return User::where('username',$request->input('username'))->where('status','=','activate')->whereNull('deleted_at')->firstOrFail(['id','user_type']);
    }

    

}
