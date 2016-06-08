<?php
namespace App\Ecard;

use Carbon\Carbon;
use Storage;
use DB;
use Illuminate\Http\Request;

use App\Ecard\Card;

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
        $result = [];
        $allChild = DB::table('category')
            ->where('parent', '=', $id)
            ->get();

        $result['delete_child'] = [];
        if($allChild) {
            for($i=0; $i<count($allChild); $i++) {
                $result['delete_child'][$i] = self::deleteChild($allChild[$i]->id);
            }
        }

        $result['delete_category'] = DB::table('category')
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
        $result = [];
        $current = DB::table('category')
            ->where('id', '=', $id)
            ->first();
        $i = 0;
        if($current) {
            $parent = $current->parent;
            $child = $current->child;

            $wait_delete = DB::table('card')
                ->where('parent', '=', $parent)
                ->where('child', '=', $child)
                ->get();

            for($i=0; $i<count($wait_delete); $i++) {
                Card::delete($wait_delete[$i]->id);
            }
        }

        $result['delete_card_counts'] = $i;
        $result['child'] = DB::table('category')
            ->where('id', '=', $id)
            ->delete();
        return $result;
    }

    static public function getParent() {
        $result = DB::table('category')
            ->whereNull('parent')
            ->get();

        return $result;
    }

    static public function getChild($parent_id) {
        $result = DB::table('category')
            ->select(DB::raw('id, parent, child, name, festDate, ABS(DATEDIFF(festDate,NOW())) as remainDay'))
            ->where('parent', '=', $parent_id)
            ->orderBy('remainDay', 'ASC')
            ->get();
        return $result;
    }
}

?>
