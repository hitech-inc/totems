<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Clip;

class MailClassDel extends Mailable
{
    use Queueable, SerializesModels;

    public $clipName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clipName)
    {
        //
        $this->clipName = $clipName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
                    ->view('frontend.email.deleted-clip')
                    ->with([
                        'clipName' => $this->clipName,
                    ])
                    ->subject("Видеофайл удален");
    }
}
