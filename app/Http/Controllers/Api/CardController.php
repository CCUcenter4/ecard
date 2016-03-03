<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ecard\Card;
use App\Ecard\Upload;
use App\Ecard\MailTool;

class CardController extends Controller
{
    public function create(Request $request) {
        $id = Card::create($request);

        Upload::webFile($id, $_FILES['webFile']['tmp_name']);

        return $id;
    }

    public function update($id, Request $request) {
        $result = Card::update($id, $request);
        $webFileExist = $request->input('webFileExist');

        if($webFileExist == 1) {
            Upload::webFile($id, $_FILES['webFile']['tmp_name']);
        }

        return $result;
    }

    public function delete($id) {
        $result = Card::delete($id);

        return $result;
    }

    public function list($parent_id, $child_id) {
        $result = Card::list($parent_id, $child_id);

        return $result;
    }

    public function detail($id) {
        $result = Card::detail($id);

        return (array)$result;
    }

    public function mail($id, Request $request) {
        $result = MailTool::card($id, $request);

        return $result;
    }
}
