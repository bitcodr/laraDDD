<?php namespace App\Http\Services\Auth\Model;

use App\Http\Services\Auth\Model\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    
    protected $table ='roles';

    protected $fillable = ['name','display_name','description'];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
