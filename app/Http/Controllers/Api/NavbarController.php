<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Navbar;

class NavbarController extends Controller
{
    public function get() {
        $result = Navbar::get();

        return $result;
    }

    public function create($parent_id) {
        $result = Navbar::create($parent_id);

        return $result;
    }

    public function delete($id) {
        $result = Navbar::delete($id);

        return $result;
    }
}
