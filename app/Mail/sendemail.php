<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\setting;

/**
 * Class SendContact.
 */
class sendemail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $email;
    public $mytemplate;
    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct($email,$mytemplate)
    {
        $this->email        = $email;
        $this->mytemplate   = $mytemplate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $myemail     = setting::value('email');
        return $this->to($this->email)
            ->view('mail.sendemail')
            ->subject('KoraStation')
            ->from($myemail,'Kora Station')
            ->replyTo($this->email);
    }
}
