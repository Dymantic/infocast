<?php

namespace App\Notifications;

use App\Contact\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactMessageReceived extends Notification
{
    use Queueable;

    public $message;

    public function __construct(ContactMessage $message)
    {
        $this->message = $message;
    }


    public function via($notifiable)
    {
        return ['mail', 'slack'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("New site message from {$this->message->first_name} {$this->message->last_name}")
            ->markdown('mail.contact.message', [
                'name'    => "{$this->message->last_name}, {$this->message->first_name}",
                'phone'   => $this->message->phone,
                'email'   => $this->message->email,
                'inquiry' => $this->message->inquiry,
                'url'     => url("/admin/inquiries")
            ]);
    }

    public function toSlack()
    {
        $url = url("/admin/inquiries");

        return (new SlackMessage)
            ->success()
            ->content('An inquiry has come in via the website.')
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('View on the site', $url)
                           ->fields([
                               'Name'    => $this->message->last_name . ', ' . $this->message->first_name,
                               'Phone'   => $this->message->phone,
                               'Email'   => $this->message->email,
                               'Message' => $this->message->inquiry
                           ]);
            });
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
