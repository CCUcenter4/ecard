<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Reservation;

class ReservationController extends Controller
{
    public function create(Request $request) {
        $result = Reservation::create($request);

        return $result;
    }

    public function update($id, Request $request) {
        $result = Reservation::update($id, $request);

        return $result;

    }

    public function delete($id) {
        $result = Reservation::delete($id);

        return $result;
    }
}
