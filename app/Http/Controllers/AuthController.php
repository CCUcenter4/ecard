<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Socialite;
use App\Ecard\AuthTool;
use Auth;

class AuthController extends Controller
{
  public function ecard() {

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
    AuthTool::manager($request);

    if(Auth::check()) {
        return view('manager.manage');
    } else {
        return view('manager.login');
    }
  }
}
