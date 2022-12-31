<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use App\Models\Category;
use Auth;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Products::with('categoryDetail')->where('is_deleted',0);
            
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
            return view('products.datatableList', compact('items'));
        } else {
            return view('products.list');
        }
    }

    public function form(Request $request, $itemID='')
    {  
        $categories = Category::where(['is_deleted' => 0])->get();
        
        if($itemID){
            $item = Products::with(['categoryDetail'])->findOrFail($itemID);
            return view('products.form', compact('item','categories'));
        }
        return view('products.form',compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = [
            'category_id' => 'required',
            'name' => 'required|unique:products',
            'price' => 'required',
            'qty' => 'required'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('addProduct')->with('error', join(", ",$validator->errors()->all()));
        } else {
            $authUser = auth()->user();

            $data = array(
                "category_id" => $request->category_id,
                "name" => $request->name,
                "price" => $request->price,
                "qty" => $request->qty,
                "create_by" => $authUser->id,
            );
            
            $item_add = Products::create($data);
            
            if (!is_null($item_add)) {
                return redirect()->route('productList')->with('success', 'Product created successfully');
            } else {
                return redirect()->route('productList')->with('error', 'Product created unsuccessfully');
            }
        }
    }

    public function update(Request $request, $itemID)
    {

        $validator = [
            'category_id' => 'required',
            'name' => 'required|unique:products,name,'.$request->id,
            'price' => 'required',
            'qty' => 'required'
        ];

        $validator = Validator::make($request->all(), $validator);

        if ($validator->fails()) {
            return redirect()->route('editProduct',$request->id)->with('error', join(", ",$validator->errors()->all()));
        }else{
            $authUser = auth()->user();
            
            $items = Products::findOrFail($itemID);
            $items->category_id = $request->category_id;
            $items->name = $request->name;
            $items->price = $request->price;
            $items->qty = $request->qty;
            $items->update_by = $authUser->id;

            if ($items->save()) {
                return redirect()->route('productList')->with('success', 'Product updated successfully');
            } else {
                return redirect()->route('productList')->with('error', 'Product updated unsuccessfully');
            }
        }
    }

    public function destroy($itemID)
    {   
        $authUser = auth()->user();
        $items = Products::findOrFail($itemID);
        $items->is_deleted = 1;
        $items->update_by = $authUser->id;
        if ($items->save()) {
            return response()->json(['status' => true, 'message' => 'Product removed successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Product removed unsuccessfully'], 200);
        }
    }

    public function checkProductNameRepeat(Request $request)
    {
        $name=$request->name;
        $id=$request->id;

        $items = Products::select('id');
        
        if (($request->action === 'edit') && ($id!=null || $id!='' || $id>0)) {
            $items->where('id', '!=', $id);
        } 

        $items->where('name', $name);
        $query = $items->get();
        if ($query->count() > 0) { echo 'false'; } else { echo 'true'; }
    }
}
