<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        // Lấy thông tin từ form đăng nhập
        $login = [
            'email' => $request->input('email'),
            'password' => $request->input('pw'),
        ];
        // dd($login);

        // Thử xác thực thông tin đăng nhập
        if (Auth::attempt($login)) {
            // Xác thực thành công, lấy thông tin người dùng
            $user = Auth::user();

            // Lưu thông tin người dùng vào session
            Session::put('user', $user);

            // Thông báo và chuyển hướng đến trang chủ
            echo '<script>alert("Đăng nhập thành công.");window.location.assign("/");</script>';
        } else {
            // Thông báo lỗi và chuyển hướng đến trang đăng nhập
            echo '<script>alert("Đăng nhập thất bại.");window.location.assign("login");</script>';
        }
    }

    public function Logout()
    {
        // Xóa session của người dùng và giỏ hàng
        Session::forget('user');
        Session::forget('cart');

        // Chuyển hướng về trang chủ
        return redirect('/trangchu');
    }

    public function Register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        // Mã hóa mật khẩu
        $input['password'] = bcrypt($input['password']);

        // Tạo người dùng mới
        User::create($input);

        // Thông báo đăng ký thành công
        echo '
    <script>
        alert("Đăng ký thành công. Vui lòng đăng nhập.");
        window.location.assign("login");
    </script>
    ';
    }
}
