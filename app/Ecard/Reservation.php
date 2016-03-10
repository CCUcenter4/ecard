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
        $dispatcher = new self();
        for($i=0; $i<count($reservation); $i++){
            if(strtotime($now) > strtotime($reservation[$i]->mail_time)){
                $card_id    = $reservation[$i]->card_id;
                $reciever['name'] = $reservation[$i]->reciever_name;
                $reciever['email'] = $reservation[$i]->reciever_email;
                $message    = $reservation[$i]->message;

                // send mail
                $dispatcher->dispatch(new SendCard($card_id, $reciever, $message));

                // remove reservation
                DB::table('reservation')
                    ->where('id', '=', $id)
                    ->delete();
            }
        }
    }

    static public function createReservation(Request $request){
        $user_id = Auth::user()->id;
        $card_id    = $request->input('card_id');
        $to_name    = $request->input('to_name');
        $to_email   = $request->input('to_email');
        $message    = $request->input('message');
        $mail_time  = $request->input('mail_time');


        $result = DB::table('reservation')
            ->insert([
                'card_id'   => $card_id,
                'user_id'   => $user_id,
                'to_name'   => $to_name,
                'to_email'  => $to_email,
                'message'   => $message,
                'mail_time' => $mail_time
            ]);

        return $result;
    }

    static public function updateReservation($id, Request $request){
        $to_name    = $request->input('to_name');
        $to_email   = $request->input('to_email');
        $message    = $request->input('message');
        $mail_time  = $request->input('mail_time');


        $result = DB::table('reservation')
            ->where('id', '=', $id)
            ->update([
                'to_name'   => $to_name,
                'to_email'  => $to_email,
                'message'   => $message,
                'mail_time' => $mail_time
            ]);

        return $result;
    }

    static public function deleteReservation($id){
        $result = DB::table('reservation')
            ->where('id', '=', $id)
            ->delete();

        return $result;
    }
}

