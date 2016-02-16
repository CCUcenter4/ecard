<?php
namespace App\Ecard;

use Storage;
use DB;
use Illuminate\Http\Request;

class Category {
    public function __construct() {

    }

    static public function createParent(Request $request) {
        $result = DB::table('category')
            ->insert([
                'name'=>$request->input('name')
            ]);

        return $result;
    }

    static public function updateParent($id, Request $request) {
        $name = $request->input('name');
        $result = DB::table('category')
            ->where('id', '=', $id)
            ->update([
                'name'=>$request->input('name')
            ]);

        return $result;
    }

    static public function deleteParent($id) {
        $result = DB::table('category')
            ->where('parent', '=', $id)
            ->orWhere('id', '=', $id)
            ->delete();

        return $result;
    }

    static public function createChild($parent_id, Request $request) {
        // determine child id
        $child_id = DB::table('category')
            ->where('parent', '=', $parent_id)
            ->max('child');
        $child_id = $child_id + 1;

        $name = $request->input('name');
        $result = DB::table('category')
            ->insert([
                'parent'=>$parent_id,
                'child'=>$child_id,
                'name'=>$request->input('name')
            ]);

        return $result;
    }

    static public function updateChild($id, Request $request) {
        $name = $request->input('name');

        $result = DB::table('category')
            ->where('id', '=', $id)
            ->update([
                'name'=>$request->input('name')
            ]);

        return $result;
    }

    static public function deleteChild($id) {
        $result = DB::table('category')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }

    static public function getParent() {
        $result = DB::table('category')
            ->where('parent', '=', 0)
            ->get();

        return $result;
    }

    static public function getChild($parent_id) {
        $result = DB::table('category')
            ->where('parent', '=', $parent_id)
            ->get();

        return $result;
    }
}

?>
