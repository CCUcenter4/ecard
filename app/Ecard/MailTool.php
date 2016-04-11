<?php
namespace App\Ecard;

use Storage;
use DB;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\SendCard;
use App\Ecard\Person;

class MailTool {
    use DispatchesJobs;

    public function __construct() {

    }

    static public function card($card_id, Request $request) {
        $reciever = [];
        $reciever['name'] = $request->input('reciever_name');
        $reciever['email'] = $request->input('reciever_email');
        $message = $request->input('message');
        $type = 'immediate';

        $dispatcher = new self();
        $dispatcher->dispatch(new SendCard($card_id, $reciever, $message, $type));
    }

    static public function multiMail($card_id, $list, $message) {
      $type = 'immediate';

      $reciever = [];
      $length = count($list[0]);
      for($i=0; $i<$length; $i++) {
        $reciever['name'] = $list[0][$i]['name'];
        $reciever['email'] = $list[0][$i]['email'];
        $dispatcher = new self();
        $dispatcher->dispatch(new SendCard($card_id, $reciever, $message, $type));
      }
    }
}
?>
