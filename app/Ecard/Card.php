<?php
namespace App\Ecard;

use Storage;
use DB;
use Illuminate\Http\Request;
use Auth;

class Card {
    static public function create(Request $request) {
        $author = DB::table('person')
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        $data   = [
            'name'          => $request->input('name'),
            'parent'        => $request->input('parent'),
            'child'         => $request->input('child'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'webfile_format'=> $request->input('file_extension'),
            'description'   => $request->input('description'),
            'author'        => $author->name
        ];

        $id = DB::table('card')
            ->insertGetid($data);

        return $id;
    }

    static public function update($id, Request $request) {
        $author = DB::table('person')
            ->where('user_id', '=', Auth::user()->id)
            ->first();

        $exist = $request->input('webFileExist');
        if($exist) {
            $data   = [
                'name'      => $request->input('name'),
                'webfile_format'=>$request->input('file_extension'),
                'description'   => $request->input('description'),
                'author'        => $author->name,
                'updated_at'=> date('Y-m-d H:i:s')
            ];
        }else {
            $data   = [
                'name'      => $request->input('name'),
                'description'   => $request->input('description'),
                'author'        => $author->name,
                'updated_at'=> date('Y-m-d H:i:s')
            ];
        }
        $result = DB::table('card')
            ->where('id', '=', $id)
            ->update($data);

        return $result;
    }

    static public function delete($id) {
        $data = DB::table('card')
            ->where('id', '=', $id)
            ->first();

        if($data->webfile_format!=null){
            $path = public_path().'/card/web/'.$id;
            unlink($path);
        }

        $result = DB::table('card')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }

    static public function selectCardInsert($card_id, Request $request) {
        $result = DB::table('special_selection')
            ->select(['id', 'card_id', 'date',]);
    }

    static public function cardList($parent_id, $child_id) {
        $result = DB::table('card')
            ->select(['id', 'name', 'mail_times', 'share_times'])
            ->where('parent', '=', $parent_id)
            ->where('child', '=', $child_id)
            ->get();

        return $result;
    }

    static public function detail($id) {
        $result = DB::table('card')
            ->where('id','=', $id)
            ->first();

        return $result;
    }

    static public function popularDetail() {
        $result = DB::table('card')
            ->orderBy('share_times', 'desc')
            ->take(10)
            ->get();

        return $result;
    }

    static public function likeDetail($id) {
        $result = DB::table('like')
            ->where('card_id','=', $id)
            ->count();

        return $result;
    }

    static public function collectDetail($id) {
        $result = DB::table('collect')
            ->where('card_id','=', $id)
            ->count();

        return $result;
    }

    static public function fb_share_increment($id) {
        $card = DB::table('card')
            ->where('id', '=', $id)
            ->first();

        $currentTimes = $card->share_times;
        $currentTimes++;

        $result = DB::table('card')
            ->where('id', '=', $id)
            ->update(['share_times'=>$currentTimes]);

        return $result;
    }

    static public function like_increment($id) {
        $exist = DB::table('like')
            ->where('card_id', '=', $id)
            ->count();

        if (!$exist) {
            $result = DB::table('like')
                ->insert([
                    'user_id' => Auth::user()->id,
                    'card_id' => $id,
                    'updated_at'=> date('Y-m-d H:i:s')
                ]);
        } else {
            $result = DB::table('like')
                ->where('user_id', Auth::user()->id)
                ->where('card_id', $id)
                ->delete();
        }

        return (string)$result;
    }

    static public function return_visitor_recording($id, $type, $refer_email) {

        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }
        
        if ($type === "FB" || $type === "SEARCH_ENG"){
            $refer = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : "none";
        }elseif ($type === "MAIL") {
            $refer = $refer_email;
        }

        if (($type === "FB" || $type === "MAIL" || $type === "SEARCH_ENG")) {
            $result = DB::table('return_visitor')
                ->insert([
                    'user_id' => (isset(Auth::user()->id))?Auth::user()->id:-1,
                    'card_id' => $id,
                    'original' => $type,
                    'ip' => $ipAddress,
                    'refer' => $refer,
                    'updated_at'=> date('Y-m-d H:i:s')
                ]);
        }

        return;
    }

    static public function collect_increment($id) {
        $exist = DB::table('collect')
            ->where('card_id', '=', $id)
            ->count();

        if (!$exist) {
            $result = DB::table('collect')
                ->insert([
                    'user_id' => Auth::user()->id,
                    'card_id' => $id,
                    'updated_at'=> date('Y-m-d H:i:s')
                ]);
        } else {
            $result = DB::table('collect')
                ->where('user_id', Auth::user()->id)
                ->where('card_id', $id)
                ->delete();
        }

        return (string)$result;
    }

    static public function name() {
        $database = DB::table('card')->get();
        $result = [];

        foreach($database as $card) {
            $result[$card->id] = $card->name;
        }

        return $result;
    }
}
?>
