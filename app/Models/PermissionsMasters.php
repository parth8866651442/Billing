<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionsMasters extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $fillable = [
        'user_type','panel_id','module_id','view','edit','add','delete','create_by','update_by'
    ];
}
