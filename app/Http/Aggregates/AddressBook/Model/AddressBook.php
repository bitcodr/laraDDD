<?php namespace App\Http\Aggregates\AddressBook\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Services\Auth\Model\User;

class AddressBook extends Eloquent
{
  use SoftDeletes;

  protected $table = 'address_book';

  protected $primaryKey = 'id';

  protected $fillable = ['title', 'latitude', 'longitude', 'radius', 'address', 'user_id'];

  protected $dates = ['deleted_at'];

  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'deleted_at'=> 'datetime:Y-m-d H:i:s',
  ];



  public function user()
  {
      return $this->belongsTo(User::class,'user_id')->select(['id','name','last_name','user_type']);
  }


}
