<?php namespace App\Http\Aggregates\AddressBook\Model;

use App\Http\Services\Auth\Model\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Aggregates\Category\Model\Category;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Store extends Eloquent
{
  use SoftDeletes;

  protected $table = 'suppliers_stores';

  protected $primaryKey = 'id';

  protected $fillable = ['title', 'description', 'category_id'];

  protected $dates = ['deleted_at'];

  protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'deleted_at'=> 'datetime:Y-m-d H:i:s',
  ];


  public function category()
  {
      return $this->belongsTo(Category::class,'category_id')->select(['id','user_id','title','description']);
  }



}
