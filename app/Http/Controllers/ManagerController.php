<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function manage() {
        return view('manager.manage');
    }

    public function login() {
        return view('manager.login');
    }
}
