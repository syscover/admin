<?php namespace Syscover\Admin\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Route;

class ResetPassword extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;


    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     */
    public function toMail()
    {
        if (Route::has('web.show_reset_form-' . user_lang()))
        {
            $routeName = 'web.show_reset_form-' . user_lang();
        }
        elseif (Route::has('web.show_reset_form'))
        {
            $routeName = 'web.show_reset_form';
        }
        else
        {
            throw new \Exception('To send the reset password email you must create the route web.show_reset_form or web.show_reset_form-es, depending on whether you have installed the pulsar-navtools package');
        }

        return (new MailMessage)
            ->line(__('admin::pulsar.message_reset_password_notification_01'))
            ->action(__('admin::pulsar.reset_password'), route($routeName, ['token' => $this->token]))
            ->line(__('admin::pulsar.message_reset_password_notification_02'));
    }
}
