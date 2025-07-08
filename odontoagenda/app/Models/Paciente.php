<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'cpf', 'data_nascimento', 'genero', 
        'telefone', 'email', 'cep', 'logradouro', 
        'numero', 'complemento', 'bairro', 'cidade', 'estado'
    ];
}
