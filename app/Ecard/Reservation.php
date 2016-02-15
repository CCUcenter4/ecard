<?php namespace App\Ecard;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use DB;
use Auth;


use App\Jobs\SendCard;

class Reservation{
  use DispatchesJobs;

  static public function checkNeedToMail(){
    $query_list = DB::table('reservation_list');
    $query_log  = DB::table('reservation_log');

    $data_list = $query_list->get();
    //$data = (array)$data;

    $now = date('Y-m-d H:i:s');

    $dispatcher = new self();
    for($i=0; $i<count($data_list); $i++){
      if(strtotime($now) > strtotime($data_list[$i]->mail_time)){
        $id = $data_list[$i]->reservation_id;
        $query_list
          ->where('reservation_id', '=', $id)
          ->delete();


        $card = $query_log
          ->where('id', '=', $id)
          ->first();
        $card_id    = $card->id;
        $from_email = $card->from_email;
        $from_name  = $card->from_name;
        $to_email   = $card->to_email;
        $to_name    = $card->to_name;
        $content    = $card->content;

        // send mail
        $dispatcher->dispatch(new SendCard($card_id, $from_email, $from_name, $to_email, $to_name, $content));

        $update_log = [
          'status' => '1'
        ];

        $query_log
          ->where('id', '=', $id)
          ->update($update_log);
      }
    }
  }

  static public function createReservation(Request $request){
    $id         = $request->input('id');
    $member_id  = Auth::user()->id;
    $from_name  = $request->input('from_name');
    $from_email = $request->input('from_email');
    $to_name    = $request->input('to_name');
    $to_email   = $request->input('to_email');
    $content    = $request->input('content');
    $mail_time  = $request->input('mail_time');

    $query_list = DB::table('reservation_list');
    $query_log  = DB::table('reservation_log');

    $member_id = Auth::user()->id;

    $insert_log = [
      'member_id' => $member_id,
      'card_id'   => $id,
      'from_name' => $from_name,
      'from_email'=> $from_email,
      'content'   => $content,
      'mail_time' => $mail_time
    ];


    for($i=0; $i<count($to_name); $i++){

      $insert_log['to_name'] = $to_name[$i];
      $insert_log['to_email']= $to_email[$i];

      $reservation_id = $query_log->insertGetId($insert_log);
      $insert_list = [
        'reservation_id'  => $reservation_id,
        'mail_time'       => $mail_time
      ];
      $query_list->insert($insert_list);
    }
  }

  static public function updateReservation(Request $request){

  }

  static public function deleteReservation(Request $request){

  }
}

