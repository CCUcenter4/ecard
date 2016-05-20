<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Auth;
use DB;
use Excel;
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

    public function cardList($parent_id, $child_id) {
        $result = Card::cardList($parent_id, $child_id);

        return $result;
    }

    public function detail($id) {
        $result = Card::detail($id);

        return (array)$result;
    }

    public function likeDetail($id) {
        $result = Card::likeDetail($id);

        return (array)$result;
    }

    public function collectDetail($id) {
        $result = Card::collectDetail($id);

        return (array)$result;
    }

    public function mail($id, Request $request) {
        $result = MailTool::card($id, $request);

        return $result;
    }

    public function multiMail($id, Request $request) {
      $user = Auth::user();

      if($user && $user->role != 'user') {
        $filepath = $request->file('excel')->getRealPath();
        $list = Excel::load($filepath)->toArray();
        $message = $request->input('message');

        MailTool::multiMail($id, $list, $message);

        return $list;
      }else {
        return 'error';
      }
    }

    public function fb_share_increment($id) {
        $result = Card::fb_share_increment($id);

        return $result;
    }

    public function like_increment($id) {
        $result = Card::like_increment($id);

        return $result;
    }

    public function collect_increment($id) {
        $result = Card::collect_increment($id);

        return $result;
    }

    public function name() {
        $result = Card::name();

        return $result;
    }
}
