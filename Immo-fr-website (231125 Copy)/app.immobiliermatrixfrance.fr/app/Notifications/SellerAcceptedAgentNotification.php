<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SellerAcceptedAgentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $seller)
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
            ->subject('You have been approved to list a property')
            ->line($this->message())
            ->action('Go to Dashboard', url(route('dashboard')));
    }

    private function message(): string
    {
        $locale = \Session::get('locale');
        return match ($locale) {
            'fr' => "Nous sommes ravis de vous informer que le vendeur a accepté votre intérêt pour leur propriété. Utilisez le lien ci-dessous pour vous connecter et commencer à élaborer un plan optimal pour promouvoir cette maison auprès d'acheteurs authentiques.",
            default => "We're excited to let you know the seller has agreed to your interest in their property. Use the link below to connect and begin designing an optimal plan to promote this home to genuine buyers."
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
