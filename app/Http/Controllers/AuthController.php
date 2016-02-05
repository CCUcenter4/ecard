<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Socialite;
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
}
