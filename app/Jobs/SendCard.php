<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Contracts\Mail\Mailer;
use DB;
use Auth;

use App\Ecard\Card;

class SendCard extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $card_id;
    protected $reciever;
    protected $message;



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($card_id, $reciever, $message)
    {
        $this->card_id = $card_id;
        $this->reciever = $reciever;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $card = Card::detail($this->card_id);
        $person = [];
        $person['reciever_name'] = $this->reciever['name'];
        $person['reciever_email'] = $this->reciever['email'];
        $person['message'] = $this->message;

        $mailer->send(['email.card', 'email.plainText.card']
        , ['card' => $card, 'person' => $person]
        , function($message) use ($person){
          $message
            ->from('ecard@demonic.csie.io', '中正大學電子賀卡系統')
            ->to($person['reciever_email'], $person['reciever_name'])
            ->subject('中正大學電子賀卡系統卡片通知');
        });
    }
}
