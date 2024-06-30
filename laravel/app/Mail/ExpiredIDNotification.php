<?php

namespace App\Mail;


use App\Models\Manpower;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExpiredIDNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;

    public function __construct(Manpower $employee) // Corrected type here
    {
        $this->employee = $employee;
    }

    public function build()
    {
        return $this->markdown('emails.expired_id_notification')
                    ->subject('Notification: Expired ID');
    }
}
