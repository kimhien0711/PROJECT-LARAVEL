<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\TypeProduct;
use Illuminate\Support\Facades\View; // Import View
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Chia sẻ danh sách loại sản phẩm với view "header"
        View::composer('header', function ($view) {
            $loai_sp = TypeProduct::all();
            $view->with('loai_sp', $loai_sp);
        });

        // Chia sẻ danh sách sản phẩm mới với view "page.type_products"
        View::composer('page.loai_sanpham', function ($view) {
            $product_new = Product::where('new', 1)
                ->orderBy('id', 'DESC')
                ->skip(1)
                ->take(8)
                ->get();
                
            $view->with('product_new', $product_new);
        });
    }
}