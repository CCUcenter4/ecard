<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Account;

class AccountController extends Controller
{
    public function getNotUser() {
        $result = Account::getNotUser();

        return $result;
    }

    public function changeRole($id, $role) {
        if($role == 'manager') {// Avoid Add Manager
            return;
        }

        $result = Account::changeRole($id, $role);

        return $result;
    }

    public function searchUser(Request $request) {
        $result = Account::searchUser($request->input('pattern'));

        return $result;
    }
}
