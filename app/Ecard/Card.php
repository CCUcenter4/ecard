<?php
namespace App\Ecard;

use Storage;
use DB;
use Illuminate\Http\Request;

class Card {
    static public function create(Request $request) {
        $data   = [
            'name'      => $request->input('name'),
            'parent'  => $request->input('parent'),
            'child'     => $request->input('child'),
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')
        ];

        $id = $query->insertGetid($data);

        return $id;
    }

    static public function update($id, Request $request) {
        $data   = [
            'name'      => $request->input('name'),
            'updated_at'=> date('Y-m-d H:i:s')
        ];
        $result = DB::table('card')
            ->where('id', '=', $id)
            ->update($data);

        return $result;
    }

    static public function delete($id) {
        $data = DB::table('card')
            ->where('id', '=', $id)
            ->first();

        if($data->thumbfile_format!=null){
            $path = public_path().'card/thumb/'.$id;
            unlink($path);
        }

        if($data->webfile_format!=null){
            $path = public_path().'card/web/'.$id;
            unlink($path);
        }

        $result = DB::table('card')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }
}

?>
