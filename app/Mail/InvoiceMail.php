<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $products;
    public $total;
    protected $pdf;

    public function __construct($order, $user, $products, $total, $pdf)
    {
        $this->order = $order;
        $this->user = $user;
        $this->products = $products;
        $this->total = $total;
        $this->pdf = $pdf;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmação de Compra - AC Vila Meã',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.invoice',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdf, 'fatura.pdf')
                ->withMime('application/pdf'),
        ];
    }
}