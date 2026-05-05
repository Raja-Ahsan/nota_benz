<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuestCheckoutWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $plainPassword,
        public Order $order,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Your :app account & order confirmation', ['app' => config('app.name', 'NOTaBENZ')]),
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.guest-checkout-welcome',
        );
    }
}
