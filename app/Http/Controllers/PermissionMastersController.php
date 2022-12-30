<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PanelMasters;
use App\Models\ModuleMasters;
use App\Models\PermissionsMasters;
use Illuminate\Support\Facades\Cookie;

class PermissionMastersController extends Controller
{

    public function assignModule(Request $request) {
        
        $panelData = PanelMasters::where(['is_deleted'=>0])->get();
        if ($panelData) {
            foreach ($panelData as $pan) {
                $pan->sup_page = ModuleMasters::where(['is_deleted'=>0,'panel_id'=>$pan->id])->get();
            }
        }
        $permissionsData = PermissionsMasters::get()->groupBy('user_type');
        return view('permission.index', compact('panelData','permissionsData'));
    }

    public function saveAssignModule(Request $request){
        if ($request->ajax()) {
            $authUser = auth()->user();
            $deletedRows = PermissionsMasters::where('user_type', $request->user_type)->delete();
            
            foreach ($request->module as $module_id => $module_val) {
                $data = array(
                    'user_type' => $request->user_type,
                    'panel_id' => $module_val['panel_id'],
                    'module_id' => $module_val['module_id'],
                    'view' => (isset($module_val['view'])) ? 1 : 0,
                    'edit' => (isset($module_val['edit'])) ? 1 : 0,
                    'add' => (isset($module_val['add'])) ? 1 : 0,
                    'delete' => (isset($module_val['delete'])) ? 1 : 0,
                );

                $data['create_by'] = $authUser->id;
                if(isset($deletedRows) && !empty($deletedRows)){
                    $data['update_by'] = $authUser->id;
                }
                PermissionsMasters::create($data);
            }
            return response()->json(['status' => true, 'message' => 'Permission updated successfully'], 200);
            
        }
        return redirect()->route('home');
    }
}
