<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Card;
use App\Ecard\Upload;

class CardController extends Controller
{
    public function create() {
        $thumb_type = $request->input('thumb_type');
        $web_type   = $request->input('web_type');

        $id = Manage::createCard($request);

        if($thumb_type > -1) {
            Upload::thumbFile($id, $_FILES['thumbFile']['tmp_name']);
        }
        if($web_type > -1) {
            Upload::webFile($id, $_FILES['webFile']['tmp_name']);
        }

        return $id;
    }

    public function update($id, Request $request) {

    }

    public function delete($id) {

    }

    public function get($parent, $child) {

    }
}
