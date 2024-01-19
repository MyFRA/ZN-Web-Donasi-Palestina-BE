<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotificationUserDonation extends Mailable
{
    use Queueable, SerializesModels;

    private $userDonation;

    /**
     * Create a new message instance.
     */
    public function __construct($userDonation)
    {
        $this->userDonation = $userDonation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kalasahan | Invoice Donasi Peduli Anak Anak Palestina',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $setting = Setting::first();

        return new Content(
            view: 'mail.notification-user-donation',
            with: [
                'userDonation' => $this->userDonation,
                'setting' => $setting,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
