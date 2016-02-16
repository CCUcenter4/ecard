<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Socialite;
use Auth;

use App\Ecard\AuthTool;
use App\Ecard\Register;

class AuthController extends Controller
{
    public function register(Request $request) {
        $result = Register::create($request);

        return $result;
    }

    public function ecard(Request $request) {
        $result = AuthTool::ecard($request);

        return $result;
    }

    public function facebook(Request $request) {
        $accessToken = $request->input('accessToken');
        return Socialite::driver('facebook')
            ->with(['accessToken' => $accessToken])
            ->redirect();
    }

    public function facebookCallback(Request $request) {
        return var_dump(Socialite::driver('facebook')->user());
    }

    public function manager(Request $request) {
        $result = AuthTool::manager($request);

        return $result;
    }
}
