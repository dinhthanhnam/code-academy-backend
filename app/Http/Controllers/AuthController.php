<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private function makeCookie($token)
    {
        return Cookie::make('token', $token, 60 * 24 * 7, '/', null, false, true, false, 'Strict');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email',
            'password' => 'required|string|max:255|min:8|confirmed',
        ],
        [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
        ]);

        $user = User::create($data);

        $cookie = $this->makeCookie($user->createToken("auth_token_$user->email")->plainTextToken);

        return response()->json(['message' => 'Đăng ký thành công!'], 200, [], JSON_UNESCAPED_UNICODE)->cookie($cookie);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255|email',
            'password' => 'required|string|max:255|min:8',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => "Thông tin đăng nhập sai!"], 401, [], JSON_UNESCAPED_UNICODE);
        }

        $cookie = $this->makeCookie($user->createToken("auth_token_$user->email")->plainTextToken);

        return response()->json(['message' => 'Đăng nhập thành công!'], 200, [], JSON_UNESCAPED_UNICODE)->cookie($cookie);
    }

    public function logout(Request $request)
    {
        // Xóa token của thiết bị hiện tại
        $request->user()->currentAccessToken()->delete();

        // Xóa cookie bằng cách đặt lại với thời gian hết hạn ngay lập tức
        return response()->json(['message' => 'Đăng xuất thành công'], 200, [], JSON_UNESCAPED_UNICODE)
            ->cookie(Cookie::forget('token')); // Xóa cookie
    }
}
