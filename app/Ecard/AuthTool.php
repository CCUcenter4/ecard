<?php
namespace App\Ecard;

use Validator;
use Storage;
use DB;
use Illuminate\Http\Request;

use Auth;
use App\Ecard\Register;

class AuthTool {
    private static $ecard_rule = [
        'account'   => 'required|email',
        'password'=> 'required'
    ];

    private static $academic_rule = [
        'account'   => 'required|numeric',
        'password'=> 'required'
    ];

    private static $academic_gra_rule = [
        'account'   => 'required|numeric',
        'password'=> 'required'
    ];

    private static $sso_rule = [
        'account'   => 'required|numeric',
        'password'=> 'required'
    ];


    public function __construct() {

    }

    static public function ecard(Request $request) {
        $valid = Validator::make($request->all(), self::$ecard_rule);

        if($valid->fails()) {
            return false;
        }

        $data = [
            'account' => $request->input('account'),
            'password'=> $request->input('password'),
            'type'=>'ecard',
            'status'=>'available'
        ];
        $result = [];

        if(Auth::attempt($data)){
            $result['status'] = 'success';
        }
        else{
            $result['status'] = 'fail';
        }

        return $result;
    }

    static public function sso(Request $request) {

    }

    static public function manager(Request $request) {
        $data = [
            'account' => $request->input('account'),
            'password' => $request->input('password'),
            'role' => 'manager'
        ];

        if(Auth::attempt($data)) {
            return redirect()->intended('manager/upload');
        }else {
            return redirect()->intended('manager/login');
        }
    }
}
?>
