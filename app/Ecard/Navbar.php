<?php
namespace App\Ecard;

use DB;
use Illuminate\Http\Request;

use App\Ecard\Category;

class Navbar {
    static public function get() {
        $result = DB::table('navbar')
            ->join('category', 'category.id', '=', 'navbar.parent_id')
            ->select('navbar.id', 'navbar.parent_id', 'category.name')
            ->get();

        for($i=0; $i<count($result); $i++) {
            $child = Category::getChild($result[$i]->parent_id);
            if($child) {
                $result[$i]->child_id = $child[0]->child;
                $result[$i]->child_name = $child[0]->name;
            }else {
                $result[$i]->child_id = 'null';
                $result[$i]->child_name = 'null';
            }
        }
        
        return $result;
    }

    static public function create($parent_id) {
        $result = DB::table('navbar')
            ->insert([
                'parent_id' => $parent_id
            ]);

        return var_dump($result);
    }

    static public function delete($id) {
        $result = DB::table('navbar')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }
}
?>
