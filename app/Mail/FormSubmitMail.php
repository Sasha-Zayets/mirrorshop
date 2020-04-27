<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $phone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Нове повідомлення з сайту ' . config('app.name');
        $data = [
            'phone' => $this->phone,
            'name' => $this->name,
        ];

        return $this->text('mail.form_submit')
            ->subject($subject)
            ->from('noanswer@' . request()->getHttpHost(), request()->getHttpHost())
            ->with($data);
    }
}
