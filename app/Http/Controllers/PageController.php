<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Slide;
use App\Models\TypeProduct;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $slide = Slide::all();
        $new_product = Product::where('new', 1)->paginate(8);
        $promotion_product = Product::where('promotion_price', '>', 0)->paginate(8);

        return view('page.trangchu', compact('slide', 'new_product', 'promotion_product'));
    }

    public function getLienheSp()
    {
        return view('page.lienhe_sanpham');
    }
    public function themgiohang()
    {
        return view('page.themgiohang');
    }
    public function getLoaiSp($type)
    {
        $sp_theoloai = Product::where('id_type', $type)->get();
        $type_product = TypeProduct::all();
        $sp_khac = Product::where('id_type', '<>', $type)->paginate(3);

        return view('page.loai_sanpham', compact('sp_theoloai', 'type_product', 'sp_khac'));
    }
    public function chitietsanpham($id)
    {
        $product_detail = Product::findOrFail($id);
        return view('page.chitiet_sanpham', compact('product_detail'));
    }

    public function about()
    {
        return view('page.about');
    }

    public function getDetail(Request $request)
    {
        $sanpham = Product::where('id', $request->id)->first();
        $splienquan = Product::where('id', '<>', $sanpham->id)
            ->where('id_type', '=', $sanpham->id_type)
            ->paginate(3);
        $comments = Comment::where('id_product', $sanpham->id)->get();
        return view('page.chitiet_sanpham', compact('sanpham', 'splienquan', 'comments'));
    }

    // ///////////////////////
    public function getIndexAdmin()
    {
        $products = Product::all();
        return view('pageAdmin.admin')->with(['products' => $products, 'sumSold' => count(BillDetail::all())]);
    }

    // //////////////
    public function getAdminAdd()
    {
        return view('pageAdmin.formAdd');
    }

    public function postAdminAdd(Request $request)
    {
        $product = new Product();

        if ($request->hasFile('inputImage')) {
            $file = $request->file('inputImage');
            $fileName = $file->getClientOriginalName('inputImage');
            $file->move('source/image/product/', $fileName);
        }

        $file_name = null;
        if ($request->file('inputImage') != null) {
            $file_name = $request->file('inputImage')->getClientOriginalName();
        }

        $product->name = $request->inputName;
        $product->image = $file_name;
        $product->description = $request->inputDescription;
        $product->unit_price = $request->inputPrice;
        $product->promotion_price = $request->inputPromotionPrice;
        $product->unit = $request->inputUnit;
        $product->new = $request->inputNew;
        $product->id_type = $request->inputType;

        $product->save();

        return $this->getIndexAdmin();
    }

    public function getAdminEdit($id)
    {
        $product = Product::find($id);
        return view('pageAdmin.formEdit')->with('product', $product);
    }

    public function postAdminEdit(Request $request)
    {
        $id = $request->editId;
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        // Xử lý ảnh nếu có
        if ($request->hasFile('editImage')) {
            $file = $request->file('editImage');
            $fileName = $file->getClientOriginalName();
            $file->move('source/image/product/', $fileName);
            $product->image = $fileName; // Cập nhật ảnh mới
        }

        // Cập nhật thông tin sản phẩm
        $product->name = $request->editName;
        $product->description = $request->editDescription;
        $product->unit_price = $request->editPrice;
        $product->promotion_price = $request->editPromotionPrice;
        $product->unit = $request->editUnit;
        $product->new = $request->editNew;
        $product->id_type = $request->editType;

        $product->save();

        return $this->getIndexAdmin();
    }

    public function postAdinDelete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $this->getIndexAdmin();
    }

    public function showAddProductForm() {
        return view('pageAdmin.formAdd'); // Đảm bảo file view này tồn tại
    }
    
    
}


