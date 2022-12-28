<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleMasters extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'panel_id','name','url','create_by','update_by','is_deleted'
    ];

    public function panelDetail()
    {
        return $this->belongsTo('App\Models\PanelMasters', 'panel_id', 'id');
    }
}
