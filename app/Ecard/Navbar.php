<?php
namespace App\Ecard;

use DB;
use Illuminate\Http\Request;
use Auth;

class Navbar {
    static public function get() {
        $result = DB::table('navbar')
            ->join('category', 'category.id', '=', 'navbar.parent_id')
            ->select('navbar.id', 'category.name')
            ->get();

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
