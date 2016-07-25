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
      'account'   => 'required',
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


    $admin_auto_sys_usr_exist = DB::connection('sso')
        ->table("x00tpseudo_uid_")
        ->select(DB::raw(
            "convert_from(decrypt(decode(password,'hex'),'bsofafrfktr','aes'), 'utf-8') as rp, staff_cd"))
        ->where("staff_cd", $request->input('account'))
        ->first();

    //var_dump($admin_auto_sys_usr_exist);

    if(Auth::attempt($data)){
      $result['status'] = 1;
    } else if ($admin_auto_sys_usr_exist->rp == $request->input('password')) {
      if(DB::table('user')->select('account')->where('account', $admin_auto_sys_usr_exist->staff_cd)->count() == 0) {
        
        $data = [
            'account'   => $admin_auto_sys_usr_exist->staff_cd,
            'password'  => 'AdminAutomaticSystemLogin',
            'type'      => 'ecard',
            'status'    => 'available',
            'role'      => 'user',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ];

        $query = DB::table('user');
        $user_id = $query->insertGetId($data);

        $data = [];
        $data = [
            'user_id'=>$user_id,
            'name'=>$request->input('name'), // THIS ONE WOULD CONNECT TO ADMIN AUTOMATIC SYS FOR QUERYING THE REAL NAME
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ];
        // 建立個人資料
        Person::create($data);

      }
      $admin_auto_sys_usr_exist = DB::table('user')->select('id')->whereAccount($admin_auto_sys_usr_exist->staff_cd)->first();
      Auth::loginUsingId($admin_auto_sys_usr_exist->id);
      $result['status'] = 1;
    } else {
      $result['status'] = 0;
    }

    return $result;
  }

  /*static public function sso(Request $request) {
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

  }*/


  static public function manager(Request $request) {
    $managerData = [
        'account' => $request->input('account'),
        'password' => $request->input('password'),
        'role' => 'manager'
    ];
    $designerData = [
        'account' => $request->input('account'),
        'password' => $request->input('password'),
        'role' => 'designer'
    ];


    if(Auth::attempt($managerData) || Auth::attempt($designerData)) {
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
