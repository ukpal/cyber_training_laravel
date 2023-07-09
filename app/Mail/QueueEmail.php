<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QueueEmail extends Mailable {
	
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address         = 'donotreply@nltr.org';
        $name            = 'IT&E, Govt. of West Bengal';
        $email_template = '';

        if ($this->data['email_for'] == 'participant_invitation') {
            $email_template = 'emails.participant_invitation';
        }

        return $this->view($email_template)
            ->from($address, $name)
            ->replyTo($address, $name)
            ->subject($this->data['email_subject'])
            ->with(['email_data' => $this->data]);
    }

}