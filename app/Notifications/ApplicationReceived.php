<?php

namespace App\Notifications;

use App\Careers\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationReceived extends Notification
{
    use Queueable;


    public $application;
    public $posting;

    public function __construct(Application $application, $posting)
    {
        $this->application = $application;
        $this->posting = $posting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'slack'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $name = "{$this->application->last_name}, {$this->application->first_name}";
        return (new MailMessage)
            ->subject("New job application from {$name}")
            ->markdown('mail.applications.message', [
                'name'           => $name,
                'phone'          => $this->application->phone,
                'email'          => $this->application->email,
                'contact_method' => $this->application->contact_method,
                'posting'        => $this->posting,
                'url'            => url("/admin/applications/{$this->application->id}")
            ]);
    }

    public function toSlack()
    {
        $url = url("/admin/applications/{$this->application->id}");

        return (new SlackMessage)
            ->success()
            ->content("An application has been submitted for the {$this->posting} position.")
            ->attachment(function ($attachment) use ($url) {
                $attachment->title('View on the site', $url)
                           ->fields([
                               'Name'           => $this->application->last_name . ', ' . $this->application->first_name,
                               'Phone'          => $this->application->phone,
                               'Email'          => $this->application->email,
                               'Contact method' => $this->application->contact_method
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
