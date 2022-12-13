<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'order_id','product_id','price','qty','amount'
    ];

    public function productDetail()
    {
        return $this->belongsTo('App\Models\Products', 'product_id', 'id');
    }
}
