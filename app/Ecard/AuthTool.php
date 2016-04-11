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
    $valid = Validator::make($request->all(), self::$sso_rule);

    if($valid->fails()) {
      return false;
    }

    $data = DB::connection('sso')
      ->table('h0btcomm')
      ->where('st_id', '=', $request->input('email'))
      ->first();

    $result = [];

    if($data){
      $id = self::checkExist('sso', $request->input('email'), $data);
      Auth::loginUsingId($id);

      $result['status'] = 1;
    }
    else{
      $result['status'] = 0;
      $result['reason'] = '無此帳號密碼';
    }

    return $result;

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

  static public function checkExist($type, $account, $data) {
    $account = DB::table('user')
      ->where('type', '=', $type)
      ->where('account', '=', $account)
      ->first();

    if($account) {//
      return $account->id;
    }else {
      $person = [];
      $person['account'] = $data;
//      $id = Register::createFromMultiLogin($person);
    }
  }
}
?>
