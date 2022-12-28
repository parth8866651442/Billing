<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ModuleMasters;
use App\Models\PanelMasters;
use Auth;

class ModuleMastersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = ModuleMasters::where('is_deleted',0);
            
            if ($search = $request->search) {
                $items->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            }

            $sortby = $request->sortby;
            if ($sortby) {
                $items->orderBy($sortby, 'asc');
            }else{
                $items->orderBy('created_at', 'DESC');
            }

            $items = $items->paginate(PAGINATE);
            return view('module_masters.datatableList', compact('items'));
        } else {
            return view('module_masters.list');
        }
    }

    public function form(Request $request, $itemID='')
    {   $panels = PanelMasters::get();
        if($itemID){
            $item = ModuleMasters::with('panelDetail')->findOrFail($itemID);
            return view('module_masters.form', compact('item','panels'));
        }
        return view('module_masters.form',compact('panels'));
    }

    public function store(Request $request)
    {
        $validator = [
            'panel_id' => 'required',
            'name' => 'required|unique:module_masters',
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('addModuleMaster')->with('error', join(", ",$validator->errors()->all()));
        } else {
            $authUser = auth()->user();
            
            $data = array(
                "panel_id" => $request->panel_id,
                "name" => $request->name,
                "url" => $request->url,
                "create_by" => $authUser->id,
            );
            
            $item_add = ModuleMasters::create($data);
            
            if (!is_null($item_add)) {
                return redirect()->route('moduleMasterList')->with('success', 'Module Masters created successfully');
            } else {
                return redirect()->route('moduleMasterList')->with('error', 'Module Masters created unsuccessfully');
            }
        }
    }

    public function update(Request $request, $itemID)
    {

        $validator = [
            'panel_id' => 'required',
            'name' => 'required|unique:module_masters,name,'.$request->id,
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('editModuleMaster',$request->id)->with('error', join(", ",$validator->errors()->all()));
        }else{
            $authUser = auth()->user();
            
            $items = ModuleMasters::findOrFail($itemID);
            $items->panel_id = $request->panel_id;
            $items->name = $request->name;
            $items->url = $request->url;
            $items->update_by = $authUser->id;

            if ($items->save()) {
                return redirect()->route('moduleMasterList')->with('success', 'Module Masters updated successfully');
            } else {
                return redirect()->route('moduleMasterList')->with('error', 'Module Masters updated unsuccessfully');
            }
        }
    }

    public function destroy($itemID)
    {   
        $authUser = auth()->user();
        $items = ModuleMasters::findOrFail($itemID);
        $items->is_deleted = 1;
        $items->update_by = $authUser->id;
        if ($items->save()) {
            return response()->json(['status' => true, 'message' => 'Module Masters removed successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Module Masters removed unsuccessfully'], 200);
        }
    }

    public function checkSubMenuNameRepeat(Request $request)
    {
        $name=$request->name;
        $id=$request->id;

        $items = ModuleMasters::select('id');
        
        if (($request->action === 'edit') && ($id!=null || $id!='' || $id>0)) {
            $items->where('id', '!=', $id);
        } 

        $items->where('name', $name);
        $query = $items->get();
        if ($query->count() > 0) { echo 'false'; } else { echo 'true'; }
    }
}
