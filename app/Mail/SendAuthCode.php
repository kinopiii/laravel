<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAuthCode extends Mailable
{
    use Queueable, SerializesModels;

    private $auth_code = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($auth_code)
    {
        $this->auth_code = $auth_code;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('temp.laravel.kadai@gmail.com', 'Laravel')
        ->subject('メールアドレス変更の認証コードのご送付')
        ->view('emails.authcode')
        ->with('auth_code', $this->auth_code);
    }
}
