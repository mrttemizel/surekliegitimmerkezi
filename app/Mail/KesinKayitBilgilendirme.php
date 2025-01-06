<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KesinKayitBilgilendirme extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('Kesin Kayıt Başvurunuz Alındı')
                    ->view('emails.kesin-kayit-bilgilendirme')
                    ->attach($this->data['wordFile'], [
                        'as' => 'Satis.docx',
                        'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                    ]);
    }
} 