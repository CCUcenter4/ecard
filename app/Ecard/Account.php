<?php
namespace App\Ecard;

use DB;
use Illuminate\Http\Request;

use App\Ecard\Category;

class Account {
    static public function get() {
        $result = DB::table('user')
            ->where('role', '=', 'multimailer')
            ->get();

        return $result;
    }

    static public function create($account_id) {
        $result = DB::table('user')
            ->where('id', '=', $account_id)
            ->update([
                'role' => 'multimailer'
            ]);

        return var_dump($result);
    }

    static public function delete($account_id) {
        $result = DB::table('user')
            ->where('id', '=', $account_id)
            ->update([
                'role' => 'user'
            ]);

        return $result;
    }

    static public function searchNotMultimailer($pattern) {
        $result = DB::table('user')
            ->where('account', 'like', $pattern)
            ->whereNotIn('role', ['multimailer'])
            ->get();

        return $result;
    }
}
?>
