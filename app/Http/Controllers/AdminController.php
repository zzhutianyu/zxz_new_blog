<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request) {
        $username = $request->get('username');
        $passwd = $request->get('password');

        if (!$token = Auth::attempt(['email' => $username, 'password' => $passwd])) {
            return RJM(null, -1, '认证失败');
        }

        return RJM(['token' => $token], 1, '认证成功');
    }



}
