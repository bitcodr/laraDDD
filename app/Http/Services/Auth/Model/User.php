<?php namespace App\Http\Services\Auth\Model;

use App\Http\Services\Auth\Model\Role;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $primaryKey = 'id';

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'cell_phone'];

    protected $hidden = ['password'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    public function hasAnyRole($roles)
	{
        if(is_array($roles) && $user_role = $this->roles()->whereIn('name', $roles)->first())
        {
            return $user_role->name;
        }
        return false;
    }
 
}
