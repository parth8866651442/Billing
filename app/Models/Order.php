<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'client_id','invoice_no','fullname','sip_vehicle_no','moblie_no','type','date','total','create_by','update_by','is_deleted','is_active'
    ];

    public function clientDetail()
    {
        return $this->belongsTo('App\Models\Client', 'client_id', 'id')->select(['id','name','email','phone_no','address','is_deleted']);
    }

    public function orderItemsDetail()
    {
        return $this->hasMany('App\Models\OrderItems', 'order_id', 'id');
    }

    public function paidAmountSum()
    {
        return $this->hasMany('App\Models\Payments', 'order_id', 'id');
    }
}
