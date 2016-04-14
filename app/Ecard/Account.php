<?php
namespace App\Ecard;

use DB;
use Illuminate\Http\Request;

use App\Ecard\Category;

class Account {
    static public function getNotUser() {
        $result = DB::table('user')
            ->whereNotIn('role', ['user', 'manager'])
            ->get();

        return $result;
    }

    static public function changeRole($id, $role) {
        $result = DB::table('user')
            ->where('id', '=', $id)
            ->update([
                'role' => $role
            ]);

        return var_dump($result);
    }

    static public function searchUser($pattern) {
        $result = DB::table('user')
            ->where('account', 'like', '%'.$pattern.'%')
            ->where('role', '=', 'user')
            ->get();

        return $result;
    }
}
?>
