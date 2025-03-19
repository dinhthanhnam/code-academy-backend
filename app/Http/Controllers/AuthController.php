<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
//    private function makeCookie($token, $name)
//    {
//        return Cookie::make($name, $token, 60 * 24 * 7, '/', null, false, true, false, 'Strict');
//    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|email|unique:users,email',
            'password' => 'required|string|max:255|min:8|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.confirmed' => 'Mật khẩu không trùng khớp',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Đăng nhập tự động sau khi đăng ký
        Auth::login($user);
        // Regenerate session để phòng chống session fixation
        $request->session()->regenerate();

//        $accessToken = $user->createToken('accessToken', ['*'], now()->addMinutes(60))->plainTextToken;
//
//        // Tạo Refresh Token (Hết hạn sau 7 ngày)
//        $refreshToken = $user->createToken('refreshToken', ['refresh'], now()->addDays(7))->plainTextToken;
//
//        // Lưu vào cookie
//        $accessCookie = cookie('accessToken', $accessToken, 60, '/', null, false, true, false, 'Lax');
//        $refreshCookie = cookie('refreshToken', $refreshToken, 60 * 24 * 7, '/', null, false, true, false, 'Lax');

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công!'
        ]);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|max:255|email',
            'password' => 'required|string|max:255|min:8',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
        ]);

        if (Auth::attempt($credentials)) {
            // Nếu đăng nhập thành công, regenerate session
            $request->session()->regenerate();
            $user = Auth::user();
//            $accessToken = $user->createToken('accessToken', ['*'], now()->addMinutes(60))->plainTextToken;
//            // Tạo Refresh Token (Hết hạn sau 7 ngày)
//            $refreshToken = $user->createToken('refreshToken', ['refresh'], now()->addDays(7))->plainTextToken;
//            // Lưu vào cookie
//            $accessCookie = cookie('accessToken', $accessToken, 60, '/', null, false, true, false, 'Lax');
//            $refreshCookie = cookie('refreshToken', $refreshToken, 60 * 24 * 7, '/', null, false, true, false, 'Lax');

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công!'
            ],200, [],JSON_UNESCAPED_UNICODE);
        }

        return response()->json([
            'success' => false,
            'message' => 'Thông tin đăng nhập sai!'
        ], 401, [],JSON_UNESCAPED_UNICODE);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Xóa cookie
//        $deleteAccessCookie = cookie()->forget('accessToken');
//        $deleteRefreshCookie = cookie()->forget('refreshToken');

        return response()->json(['message' => 'Đăng xuất thành công'],
            200 , [],JSON_UNESCAPED_UNICODE);
    }

}
