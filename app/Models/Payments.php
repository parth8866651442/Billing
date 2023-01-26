<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'order_id','due_amount','paid_amount','date','amount','payment_type','cheque_no','cheque_date','transaction_no','note','create_by','update_by'
    ];

    public function orderDetail()
    {
        return $this->belongsTo('App\Models\Order', 'order_id', 'id')->select(['id','client_id','invoice_no','fullname','total','status','is_deleted']);
    }
}
