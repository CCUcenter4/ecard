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
        $contact = $request->input('contact');
        $message = $request->input('message');
        $type = 'immediate';

        $dispatcher = new self();
        $dispatcher->dispatch(new SendCard($card_id, $reciever, $message, $type, $contact));
    }

    static public function multiMail($card_id, $list, $message) {
      $type = 'immediate';

      $DEBUG = [];
      $reciever = [];
      $length = count($list);
      for($i=0; $i<$length; $i++) {
        $reciever['name'] = $list[$i]['name'];
        $reciever['email'] = $list[$i]['email'];

        $contact = array($reciever['name'].'/'.$reciever['email']);
        array_push($DEBUG, $contact);

        $dispatcher = new self();
        $dispatcher->dispatch(new SendCard($card_id, $reciever, $message, $type, $contact));
      }

      return $DEBUG;
    }
}
?>
