<?php namespace App\Ecard;
use Validator;
use Illuminate\Http\Request;
use DB;
use Hash;

class Register{
  public static $rule = [
    'email'     => 'required|email',
    'password'  => 'required|max:16',
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
        'password'  => bcrypt($request->input('password')),
        'type'      => '1',
        'status'    => '0',
        'created_at'=> date('Y-m-d H:i:s'),
        'updated_at'=> date('Y-m-d H:i:s')
      ];

      $query = DB::table('users');
      $id = $query->insertGetId($data);

      self::createPersonInfo($id, $request->all());

      $result['status'] = 1;
    }

    return $result;
  }

  static public function createFromMultiLogin($person){
    // prepare person_info data
    $data = [
      'email' => $person['email'],
      'name'  => $person['name'],
    ];

    unset($person['email']);
    unset($person['birth']);

    $person['created_at'] = date('Y-m-d H:i:s');
    $person['updated_at'] = date('Y-m-d H:i:s');

    $query = DB::table('users');
    $id = $query->insertGetId($person);
    self::createPersonInfo($id, $data);

    return $id;
  }
}
