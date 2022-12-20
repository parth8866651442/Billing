<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'category_id','name','price','qty','create_by','update_by','is_deleted','is_active'
    ];

    public function categoryDetail()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id')->select(['id', 'name','is_deleted']);
    }
}
