<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private $apiUrl = "https://656ca88ee1e03bfd572e9c16.mockapi.io/products";

    // Lấy danh sách sản phẩm
    public function index()
    {
        $response = Http::get($this->apiUrl);

        if ($response->successful()) {
            $products = $response->json();
            return view('products.index', compact('products'));
        }

        return back()->withErrors(['message' => 'Không thể tải danh sách sản phẩm']);
    }

    // Hiển thị form tạo sản phẩm
    public function create()
    {
        return view('products.create');
    }

    // Lưu sản phẩm mới
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        // Ghi log dữ liệu gửi đến API để debug
        Log::info('Dữ liệu gửi đến API:', ['data' => $validatedData]);

        $response = Http::post($this->apiUrl, $validatedData);

        // Ghi log phản hồi từ API để kiểm tra lỗi nếu có
        Log::info('Dữ liệu gửi đến API:', $validatedData);


        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo!');
        }

        return back()->withErrors(['message' => 'Lỗi khi tạo sản phẩm: ' . $response->body()]);
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        $response = Http::get(sprintf("%s/%s", $this->apiUrl, $id));

        if ($response->successful()) {
            $product = json_decode(json_encode($response->json())); // Chuyển array thành object

            // Debug: Kiểm tra dữ liệu API trả về
            dd($product);

            return view('products.edit', compact('product'));
        }

        return redirect()->route('products.index')->withErrors(['message' => 'Không tìm thấy sản phẩm']);
    }

    // Cập nhật sản phẩm
    public function update(StoreProductRequest $request, $id)
    {
        $response = Http::put(sprintf("%s/%s", $this->apiUrl, $id), $request->validated());

        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật!');
        }

        return back()->withErrors(['message' => 'Lỗi khi cập nhật sản phẩm: ' . $response->body()]);
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $response = Http::delete(sprintf("%s/%s", $this->apiUrl, $id));

        if ($response->successful()) {
            return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa!');
        }
        return back()->withErrors(['message' => 'Lỗi khi xóa sản phẩm: ' . $response->body()]);
    }
}