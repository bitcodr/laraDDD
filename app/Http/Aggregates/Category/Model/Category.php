<?php namespace App\Http\Aggregates\Category\Model;

use App\Http\Services\Auth\Model\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Aggregates\Category\Model\Category;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
  use SoftDeletes;

  protected $table = 'suppliers_category';

  protected $primaryKey = 'id';

  protected $fillable = ['title', 'description', 'user_id'];

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

  public function store()
  {
      return $this->hasMany(Store::class,'category_id','id')->select(['id','title','description','category_id']);
  }


}
