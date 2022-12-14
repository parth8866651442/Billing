<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'prefix_name_invoice',
        'bd_holdare_name',
        'bd_bank_name',
        'bd_ifsc_code',
        'bd_account_no',
        'terms_conditions',
        'notes',
        'sign_img',
        'address',
        'logo_img',
        'favicon_img',
        'create_by',
        'update_by'
    ];

}
