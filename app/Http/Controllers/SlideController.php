<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class SlideController extends Controller
{
    public function index()
    {
        // Lấy tất cả dữ liệu từ bảng slides
        $slide = Slide::all();

        // Trả về view và truyền dữ liệu slide
        return view('slide', compact('slide'));
    }
}
