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
use App\Ecard\Navbar;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index(Request $request){
        $navbar = Navbar::get();
        return view('web.index')
            ->with('navbar', $navbar);
    }

    public function festival($parent_id, $child_id){
        $list = Category::getChild($parent_id);

        return view('web.festival')
            ->with('parent_id', $parent_id)
            ->with('child_id', $child_id)
            ->with('list', $list)
            ->with('active_id', $child_id);
    }

    public function normal($navbar_id, $parent_id, $child_id) {
        $navbar = Navbar::get();
        $list = Category::getChild($parent_id);

        return view('web.normal')
            ->with('navbar', $navbar)
            ->with('navbar_id', $navbar_id)
            ->with('parent_id', $parent_id)
            ->with('child_id', $child_id)
            ->with('list', $list)
            ->with('active_id', $child_id);
    }

    public function card($card_id) {
        $card = Card::detail($card_id);
        $navbar = Navbar::get();

        return view('web.card')
            ->with('navbar', $navbar)
            ->with('fb_app_id', env('FB_client_id'))
            ->with('card_id', $card->id)
            ->with('card_name', $card->name)
            ->with('card_description', $card->description)
            ->with('author', $card->author);
    }

    public function person(){
        $navbar = Navbar::get();

        return view('web.person')
            ->with('navbar', $navbar);
    }
}
