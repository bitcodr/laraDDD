<?php namespace App\Http\Services\Auth\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class RoleUser extends Eloquent
{
    use SoftDeletes;
    
    protected $table ='role_user';

    protected $fillable = ['user_id','role_id'];

    public $timestamps = false;
}
