<?php namespace App\Http\Aggregates\Customer\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Http\Aggregates\AddressBook\Model\AddressBook;

class Customer extends Eloquent
{
    use SoftDeletes;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = ['name','last_name','cell_phone','credit','photo','email','user_type','status','username','password'];

    protected $dates = ['deleted_at'];

    protected $touches = [];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at'=> 'datetime:Y-m-d H:i:s',
    ];


    public function addressBook()
    {
      return $this->hasMany(AddressBook::class,'user_id','id')->select(['id','user_id','title', 'latitude', 'longitude', 'radius', 'address']);
    }

    public function carts()
    {
      return $this->hasMany(Carts::class,'user_id','id')->select(['id','user_id','product_id']);
    }

}
