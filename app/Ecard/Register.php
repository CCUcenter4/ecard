<?php namespace App\Ecard;
use Validator;
use Illuminate\Http\Request;
use DB;
use Hash;

use App\Ecard\Person;

class Register{
    public static $rule = [
        'account'     => 'required|email',
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
                'account'   => $request->input('account'),
                'password'  => bcrypt($request->input('password')),
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
                'name'=>$request->input('name'),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ];
            // 建立個人資料
            Person::create($data);

            $result['status'] = 1;
        }

        return $result;
    }

    static public function createFromMultiLogin($person){
        $person['created_at'] = date('Y-m-d H:i:s');
        $person['updated_at'] = date('Y-m-d H:i:s');

        $query = DB::table('user');
        $id = $query->insertGetId($person);

        return $id;
    }
}
