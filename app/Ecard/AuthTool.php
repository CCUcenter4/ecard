<?php
namespace App\Ecard;

use Storage;
use DB;
use Illuminate\Http\Request;

use Person;

class AuthTool {
    public function __construct() {

    }

    static public function ecard(Request $request) {

    }

    static public function sso(Request $request) {

    }

    static public function manager(Request $request) {
        $account = $request->input('account');
        $password = bcrypt($request->input('password'));


    }
}
?>
