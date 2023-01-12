<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DbBackupMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $sql_file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sql_file)
    {
        $this->sql_file = $sql_file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.backup.db_backup')
                    ->attach($this->sql_file, [
                        'as' => 'data.sql',
                        'mime' => 'application/xl',
                    ])
                    // ->cc('fourbrothers053@gmail.com')
                    ->subject('DATA BACKUP '.strtoupper(env('APP_NAME')));
    }
}
