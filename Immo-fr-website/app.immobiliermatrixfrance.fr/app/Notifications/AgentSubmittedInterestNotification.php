<?php

namespace App\Notifications;

use App\Models\Agent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AgentSubmittedInterestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Agent $agent)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->message())
            ->action('Go to Dashboard', url(route('dashboard')));
    }

    private function message(): string
    {
        $locale = \Session::get('locale');
        return match ($locale) {
            'fr' => "Bonjour. Belle opportunité ! Un agent d'Immobilier Matrix France est intéressé à promouvoir votre propriété. Cliquez ci-dessous pour vous connecter et discuter de comment ils peuvent efficacement mettre en marché votre maison auprès d'acheteurs sérieux.",
            default => "Hello. Great opportunity! An Immobilier Matrix France Agent is interested in promoting your property. Click below to connect and discuss how they can effectively market your home to serious buyers."
        };
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
