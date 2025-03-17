<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ShowController extends Controller
{
    private $apiUrl = "https://656ca88ee1e03bfd572e9c16.mockapi.io/products";
    // Lấy danh sách sản phẩm từ Mock API
    public function index()
    {
        $response = Http::get($this->apiUrl);
        if ($response->successful()) {
            $products = $response->json();
            return view('productss.index', compact('products'));
        } else {
            return back()->withErrors(['message' => 'Không thể lấy dữ liệu từ Mock API']);
        }
    }
}
