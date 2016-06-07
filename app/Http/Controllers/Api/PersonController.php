<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Person;

class PersonController extends Controller
{
    public function history() {
        $result = Person::getHistory();

        return $result;
    }

    public function like() {
        $result = Person::getLike();

        return $result;
    }

    public function collect() {
        $result = Person::getCollect();

        return $result;
    }

    public function contact() {
        $result = Person::getContact();

        return $result;
    }

    public function update(Request $request) {

    }
}
