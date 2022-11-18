<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Auth;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Category::where('is_deleted',0);
            
            if ($search = $request->search) {
                $items->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            }

            if ($request->status != '') {
                $items->where('is_active', $request->status);
            }

            $sortby = $request->sortby;
            if ($sortby) {
                $items->orderBy($sortby, 'asc');
            }else{
                $items->orderBy('created_at', 'DESC');
            }

            $items = $items->paginate(PAGINATE);
            return view('categories.datatableList', compact('items'));
        } else {
            return view('categories.list');
        }
    }

    public function form(Request $request, $itemID='')
    {   
        if($itemID){
            $item = Category::findOrFail($itemID);
            return view('categories.form', compact('item'));
        }
        return view('categories.form');
    }

    public function store(Request $request)
    {
        $validator = [
            'name' => 'required|unique:categories'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('addCategory')->with('error', join(", ",$validator->errors()->all()));
        } else {
            $authUser = auth()->user();

            $data = array(
                "name" => $request->name,
                "create_by" => $authUser->id,
            );
            
            $item_add = Category::create($data);
            
            if (!is_null($item_add)) {
                return redirect()->route('categoryList')->with('success', 'Category created successfully');
            } else {
                return redirect()->route('categoryList')->with('error', 'Category created unsuccessfully');
            }
        }
    }

    public function update(Request $request, $itemID)
    {

        $validator = [
            'name' => 'required|unique:categories,name,'.$request->id
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('editCategory',$request->id)->with('error', join(", ",$validator->errors()->all()));
        }else{
            $authUser = auth()->user();
            
            $items = Category::findOrFail($itemID);
            $items->name = $request->name;
            $items->update_by = $authUser->id;

            if ($items->save()) {
                return redirect()->route('categoryList')->with('success', 'Category updated successfully');
            } else {
                return redirect()->route('categoryList')->with('error', 'Category updated unsuccessfully');
            }
        }
    }

    public function destroy($itemID)
    {   
        $authUser = auth()->user();
        $items = Category::findOrFail($itemID);
        $items->is_deleted = 1;
        $items->update_by = $authUser->id;
        if ($items->save()) {
            return response()->json(['status' => true, 'message' => 'Category removed successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Category removed unsuccessfully'], 200);
        }
    }

    public function checkCategoryNameRepeat(Request $request)
    {
        $name=$request->name;
        $id=$request->id;

        $items = Category::select('id');
        
        if (($request->action === 'edit') && ($id!=null || $id!='' || $id>0)) {
            $items->where('id', '!=', $id);
        } 

        $items->where('name', $name);
        $query = $items->get();
        if ($query->count() > 0) { echo 'false'; } else { echo 'true'; }
    }
}
