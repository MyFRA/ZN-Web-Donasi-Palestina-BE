<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotificationUserProductDonationOrder extends Mailable
{
    use Queueable, SerializesModels;

    private $productDonationOrder;

    /**
     * Create a new message instance.
     */
    public function __construct($productDonationOrder)
    {
        $this->productDonationOrder = $productDonationOrder;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bali Lestari Malik | Invoice Donasi Peduli  Palestina',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $setting = Setting::first();

        return new Content(
            view: 'mail.notification-user-product-donation-order',
            with: [
                'userDonation' => $this->productDonationOrder,
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
