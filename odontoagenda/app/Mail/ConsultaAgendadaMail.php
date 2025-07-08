<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Consulta;

class ConsultaAgendadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $consulta;

    public function __construct(Consulta $consulta)
    {
        $this->consulta = $consulta;
    }

    public function build()
    {
        return $this->subject('Consulta Agendada')
                    ->view('emails.consulta_agendada')
                    ->with(['consulta' => $this->consulta]);
    }
}
