<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class SlipMail extends Mailable
{
    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function build()
    {
        return $this->subject('Slip Gaji')
            ->view('emails.slip')
            ->attachFromStorageDisk('public', $this->file);
    }
}