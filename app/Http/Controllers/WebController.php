<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Card;
use App\Ecard\Person;
use App\Ecard\Category;


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

    public function festival($parent_id, $child_id){
        $list = Category::getChild($parent_id);

        return view('web.festival')
            ->with('parent_id', $parent_id)
            ->with('child_id', $child_id)
            ->with('list', $list)
            ->with('active_id', $child_id);
    }

    public function card($card_id) {
        $card = Card::detail($card_id);

        return view('web.card')
            ->with('fb_app_id', env('FB_client_id'))
            ->with('card_id', $card->id)
            ->with('card_name', $card->name)
            ->with('card_description', $card->description);
    }

    public function person(){
        return view('web.person');
    }
}
