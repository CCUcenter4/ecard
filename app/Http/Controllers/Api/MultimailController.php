<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Account;

class MultimailController extends Controller
{
    public function get() {
        $result = Account::getMultimailer();

        return $result;
    }

    public function create($account_id) {
        $result = Account::createMultimailer($account_id);

        return $result;
    }

    public function delete($account_id) {
        $result = Account::deleteMultimailer($account_id);

        return $result;
    }

    public function search(Request $request) {
        $result = Account::searchNotMultimailer($request->input('pattern'));

        return $result;
    }
}
