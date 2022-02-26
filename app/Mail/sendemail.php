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
    public $email; // to
    public $myemail; // from
    public $mytemplate;
    public $subject;
    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct($email,$myemail,$subject,$mytemplate)
    {
        $this->email        = $email;
        $this->myemail      = $myemail;
        $this->mytemplate   = $mytemplate;
        $this->subject      = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->view('mail.sendemail')
            ->subject($this->subject)
            ->from($this->myemail,$this->subject)
            ->replyTo($this->email);
    }
}
