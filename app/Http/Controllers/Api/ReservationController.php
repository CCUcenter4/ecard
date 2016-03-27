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
    public function get(Request $request) {
        $result = Reservation::get();

        return $result;
    }

    public function create($card_id, Request $request) {
        $result = Reservation::create($card_id, $request);

        return (array)$result;
    }

    public function delete($id) {
        $result = Reservation::delete($id);

        return $result;
    }
}
