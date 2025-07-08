<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Paciente;

class DashboardController extends Controller
{
    public function index()
    {
        // Conta quantas consultas foram agendadas
        $totalConsultas = Consulta::count();

        // Lista todas as consultas, carregando os pacientes corretamente
        $consultas = Consulta::with('paciente') // Adiciona o relacionamento com o paciente
            ->orderBy('data', 'asc')
            ->orderBy('hora', 'asc')
            ->get();

        // Lista todos os pacientes em ordem alfabética
        $pacientes = Paciente::orderBy('nome', 'asc')->get();

        return view('dashboard', compact('totalConsultas', 'consultas', 'pacientes'));
    }
}
