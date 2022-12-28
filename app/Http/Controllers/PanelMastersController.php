<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PanelMasters;
use Auth;

class PanelMastersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = PanelMasters::where('is_deleted',0);
            
            if ($search = $request->search) {
                $items->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            }

            $sortby = $request->sortby;
            if ($sortby) {
                $items->orderBy($sortby, 'asc');
            }else{
                $items->orderBy('seq', 'DESC');
            }

            $items = $items->paginate(PAGINATE);
            return view('panel_masters.datatableList', compact('items'));
        } else {
            return view('panel_masters.list');
        }
    }

    public function form(Request $request, $itemID='')
    {   
        if($itemID){
            $item = PanelMasters::findOrFail($itemID);
            return view('panel_masters.form', compact('item'));
        }
        return view('panel_masters.form');
    }

    public function store(Request $request)
    {
        $validator = [
            'name' => 'required|unique:panel_masters',
            'icon' => 'required'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('addPanelMaster')->with('error', join(", ",$validator->errors()->all()));
        } else {
            $authUser = auth()->user();

            $latest = PanelMasters::latest()->first();

            $string = preg_replace("/[^0-9\.]/", '', $latest->seq);

            $data = array(
                "name" => $request->name,
                "seq" => $string+1,
                "icon" => $request->icon,
                "create_by" => $authUser->id,
            );
            
            $item_add = PanelMasters::create($data);
            
            if (!is_null($item_add)) {
                return redirect()->route('panelMasterList')->with('success', 'Panel Masters created successfully');
            } else {
                return redirect()->route('panelMasterList')->with('error', 'Panel Masters created unsuccessfully');
            }
        }
    }

    public function update(Request $request, $itemID)
    {

        $validator = [
            'name' => 'required|unique:panel_masters,name,'.$request->id,
            'icon' => 'required'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('editPanelMaster',$request->id)->with('error', join(", ",$validator->errors()->all()));
        }else{
            $authUser = auth()->user();
            
            $items = PanelMasters::findOrFail($itemID);
            $items->name = $request->name;
            $items->icon = $request->icon;
            $items->update_by = $authUser->id;

            if ($items->save()) {
                return redirect()->route('panelMasterList')->with('success', 'Panel Masters updated successfully');
            } else {
                return redirect()->route('panelMasterList')->with('error', 'Panel Masters updated unsuccessfully');
            }
        }
    }

    public function destroy($itemID)
    {   
        $authUser = auth()->user();
        $items = PanelMasters::findOrFail($itemID);
        $items->is_deleted = 1;
        $items->update_by = $authUser->id;
        if ($items->save()) {
            return response()->json(['status' => true, 'message' => 'Panel Masters removed successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Panel Masters removed unsuccessfully'], 200);
        }
    }

    public function checkMenuNameRepeat(Request $request)
    {
        $name=$request->name;
        $id=$request->id;

        $items = PanelMasters::select('id');
        
        if (($request->action === 'edit') && ($id!=null || $id!='' || $id>0)) {
            $items->where('id', '!=', $id);
        } 

        $items->where('name', $name);
        $query = $items->get();
        if ($query->count() > 0) { echo 'false'; } else { echo 'true'; }
    }
}
