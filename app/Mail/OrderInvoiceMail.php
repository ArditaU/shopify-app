<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdf;
    /**
     * Create a new message instance.
     */
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('mail.orders.invoice')
                    ->subject('Order Invoice Email')
                    ->attachData($this->pdf->output(), 'invoice.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
