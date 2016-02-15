<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Card;
use App\Ecard\Person;


/*
 **/

use Mail;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index(Request $request){
      return view('web.index');
    }

    public function festival(){
      return view('web.festival');
    }

    public function person(){
        return view('web.person');
    }
}
