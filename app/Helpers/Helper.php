<?php

namespace App\Helpers;
use Illuminate\Support\Arr;
use App\Models\PermissionsMasters;
use Session;

class Helper
{
    public static function ActionButton($data = null)
    {
        return '';
    }
    
    public static function getSession(){
        $authUser = auth()->user();
        return PermissionsMasters::select('user_type','panel_id','module_id','view','edit','add','delete')->where(['user_type' => $authUser->role])->get();
    }

    public static function check_user_assess($parmisone_type, $module, $resirect = TRUE){
        if(auth()->user()->role === 'superadmin'){
            return true;
        }
        $array = static::getSession();
        if(in_array($parmisone_type,['view','add','edit','delete'])){
            foreach ($array as $key => $value) {
                if($value->module_id == $module){
                    return $value[$parmisone_type];
                }
            }
            if ($resirect) {
                redirect('/');
            }
            return false;
        }
        return false;
    }
}