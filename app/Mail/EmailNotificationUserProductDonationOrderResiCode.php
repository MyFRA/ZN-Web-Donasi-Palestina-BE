<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotificationUserProductDonationOrderResiCode extends Mailable
{
    use Queueable, SerializesModels;

    private $productDonation;

    /**
     * Create a new message instance.
     */
    public function __construct($productDonation)
    {
        $this->productDonation = $productDonation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kalasahan | Nomor Resi Donasi Peduli Anak Anak Palestina',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $setting = Setting::first();

        return new Content(
            view: 'mail.notification-user-product-donation-resi-code-order',
            with: [
                'userDonation' => $this->productDonation,
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
