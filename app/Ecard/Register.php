<?php namespace App\Ecard;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use DB;
use Hash;
use Mail;

use App\Jobs\SendRegisterAuth;

class Register{
  use DispatchesJobs;

  public static $rule = [
    'email'     => 'required|email',
    'password'  => 'required|max:16',
    'birth'     => 'required|date',
  ];

  static public function create(Request $request){
    $validator  = Validator::make($request->all(), self::$rule);
    $result     = [];

    if($validator->fails()){
      $result['status'] = 0;
      $result['reason'] = $validator->errors();
    }else{
      $data = [
        'account'   => $request->input('email'),
        'password'  => md5($request->input('password')),
        'type'      => '1',
        'status'    => '0',
        'created_at'=> date('Y-m-d H:i:s'),
        'updated_at'=> date('Y-m-d H:i:s')
      ];

      $query = DB::table('users');
      $id = $query->insertGetId($data);

      self::createPersonInfo($id, $request->all());
      self::sendRegisterMail($id);

      $result['status'] = 1;
    }

    return $result;
  }

  static public function createFromMultiLogin($person){
    // prepare person_info data
    $data = [
      'email' => $person['email'],
      'birth' => $person['birth'],
      'name'  => $person['name'],
      'cname' => $person['cname']
    ];

    unset($person['email']);
    unset($person['birth']);
    unset($person['name']);
    unset($person['cname']);

    $person['created_at'] = date('Y-m-d H:i:s');
    $person['updated_at'] = date('Y-m-d H:i:s');

    $query = DB::table('users');
    $id = $query->insertGetId($person);
    self::createPersonInfo($id, $data);

    return $id;
  }
}
