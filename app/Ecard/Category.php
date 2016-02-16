<?php
namespace App\Ecard;

use Storage;
use DB;
use Illuminate\Http\Request;

class Category {
    public function __construct() {

    }

    static public function createParent(Request $request) {
        // determine parent id
        $parent_id = DB::table('category')
            ->max('parent');
        $parent_id = $parent_id + 1;

        $name = $request->input('name');
        $result = DB::table('category')
            ->insert([
                'parent'=>$parent_id,
                'child'=>0,
                'name'=>$name
            ]);

        return $result;
    }

    static public function updateParent($id, Request $request) {
        $name = $request->input('name');
        $result = DB::table('category')
            ->where('id', '=', $id)
            ->update([
                'name'=>$name
            ]);

        return $result;
    }

    static public function deleteParent($parent_id) {
        $result = DB::table('category')
            ->where('parent', '=', $parent_id)
            ->delete();

        return $result;
    }

    static public function createChild($parent_id, Request $request) {
        // determine child id
        $child_id = DB::table('category')
            ->where('parent', '=', $parent_id)
            ->max('child');
        $child = $child + 1;

        $name = $request->input('name');
        $result = DB::table('category')
            ->insert([
                'parent'=>$parent,
                'child'=>$child,
                'name'=>$name
            ]);

        return $result;
    }

    static public function updateChild($id, Request $request) {
        $name = $request->input('name');

        $result = DB::table('category')
            ->where('id', '=', $id)
            ->update(['name'=>$name]);

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
            ->where('child', '=', 0)
            ->get();

        return $result;
    }

    static public function getChild($parent_id) {
        $result = DB::table('category')
            ->where('parent', '=', $parent_id)
            ->where('child', '>', 0)
            ->get();

        return $result;
    }
}

?>
