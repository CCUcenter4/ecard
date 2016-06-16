<?php namespace App\Ecard;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use DB;
use Auth;


use App\Jobs\SendCard;

class Reservation{
    use DispatchesJobs;

    static public function checkNeedToMail(){
        $reservation = DB::table('reservation')
            ->get();

        $now = date('Y-m-d H:i:s');
        $reciever = [];
        $type = 'reservation';
        $dispatcher = new self();
        for($i=0; $i<count($reservation); $i++){
            if(strtotime($now) > strtotime($reservation[$i]->mail_time)){
                $card_id    = $reservation[$i]->card_id;
                $reciever['name'] = $reservation[$i]->reciever_name;
                $reciever['email'] = $reservation[$i]->reciever_email;
                $message    = $reservation[$i]->message;

                // send mail
                $dispatcher->dispatch(new SendCard($card_id, $reciever, $message, $type));

                // remove reservation
                DB::table('reservation')
                    ->where('id', '=', $id)
                    ->delete();
            }
        }
    }

    static public function get() {
        $user = Auth::user();
        if($user) {
            $result = DB::table('reservation')
                ->where('user_id', '=', $user->id)
                ->get();
        }

        return $result;
    }

    static public function create($card_id, Request $request){
        $user_id = Auth::user()->id;
        $message    = $request->input('message');
        $mail_time  = $request->input('mail_time');


        foreach ($request->input('contact') as $contactSelects) {
            $contactName =  strtok($contactSelects, "/");
            $contactEmail = strtok("/");
            $result = DB::table('reservation')
                ->insert([
                    'card_id'   => $card_id,
                    'user_id'   => $user_id,
                    'reciever_name'   => $contactName,
                    'reciever_email'  => $contactEmail,
                    'message'   => $message,
                    'mail_time' => $mail_time,
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s')
                ]);
        }


        return $result;
    }

    static public function delete($id){
        $result = DB::table('reservation')
            ->where('id', '=', $id)
            ->where('user_id', '=', Auth::user()->id)
            ->delete();

        return $result;
    }
}

