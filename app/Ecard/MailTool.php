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
}
?>
