<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AppEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address         = env('MAIL_USERNAME');;
        $name            = 'IT&E, Govt. of West Bengal';
        $email_template = '';

        if ($this->data['email_for'] == 'email_login_otp') {
            $email_template = 'emails.email_login_otp';
        } else if ($this->data['email_for'] == 'contact_form') {
            $email_template = 'emails.contact_form';
        } else if ($this->data['email_for'] == 'registration_otp') {
            $email_template = 'emails.registration_otp';
        } else if ($this->data['email_for'] == 'employer_registration') {
            $email_template = 'emails.employer_registration';
        } else if ($this->data['email_for'] == 'employer_registration_govt') {
            $email_template = 'emails.employer_registration_govt';
        } else if ($this->data['email_for'] == 'employer_email_verification') {
            $email_template = 'emails.employer_email_verification';
        } else if ($this->data['email_for'] == 'employer_approval') {
            $email_template = 'emails.employer_profile_approval';
        } else if ($this->data['email_for'] == 'employer_rejection') {
            $email_template = 'emails.employer_profile_rejection';
        } 
        else if ($this->data['email_for'] == 'org_host_req') {
            $email_template = 'emails.org_host_req';
        }

        return $this->view($email_template)
            ->from($address, $name)
            ->replyTo($address, $name)
            ->subject($this->data['email_subject'])
            ->with(['email_data' => $this->data]);
    }
}
