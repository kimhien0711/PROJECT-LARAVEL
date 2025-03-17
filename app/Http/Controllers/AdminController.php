<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use Illuminate\Http\Request;
use App\Models\Product;
class AdminController extends Controller
{

    public function getIndexAdmin(){
        $products = Product::all();
        return view('pageAdmin.admin')->with(['products' => $products, 'sumSold' => count(BillDetail::all())]);
    }
    
    public function postAdminDelete(Request $request){
        $product = Product::find($request->id);
        
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
    
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
    

    public  function getAdminEdit($id){
        $product = Product::find($id);
        return view ('pageAdmin.formEdit')->with('product',$product);
    }

  

}
