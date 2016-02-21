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
        $user = Auth::user();
        if($user) {
            $person = Person::get();

            $sender = [];
            $sender['name'] = $person->name;
            $sender['email'] = $person->email;
        } else {
            $sender = [];
            $sender['name'] = $request->input('sender_name');
            $sender['email'] = $request->input('sender_email');
        }

        $reciever = [];
        $reciever['name'] = $request->input('reciever_name');
        $reciever['email'] = $request->input('reciever_email');
        $message = $request->input('message');

        $dispatcher = new self();
        $dispatcher->dispatch(new SendCard($card_id, $sender, $reciever, $message));
    }
}
?>
