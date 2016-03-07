<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    public function upload() {
        return view('manager.upload');
    }

    public function env() {
        return view('manager.env');
    }

    public function login() {
        return view('manager.login');
    }
}
