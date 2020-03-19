<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\user as User;

class UserRegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;
    protected $randomPassword;

    public function __construct(User $user, $randomPassword)
    {
        $this->user = $user;
        $this->randomPassword = $randomPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        // dd($this->user);
        return $this->from('gdochadipa@gmail.com')
        ->subject('Verifikasi pendaftaran anda')
        ->view('emails.verify')
        ->with([
            'user' =>$this->user,
            'password'=>$this->randomPassword
        ]);
    }
}
