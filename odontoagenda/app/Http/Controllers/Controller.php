<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // Método para listar as consultas
    public function index()
    {
        $consultas = Consulta::orderBy('data', 'asc')->orderBy('hora', 'asc')->get();
        return view('consultas', compact('consultas'));
    }

    // Método para exibir o dashboard
    public function dashboard()
    {
        $pacientes = Paciente::all(); // Recupera todos os pacientes
        $consultas = Consulta::all(); // Recupera todas as consultas (se necessário)
        $totalConsultas = $consultas->count(); // Total de consultas

        return view('dashboard', compact('pacientes', 'consultas', 'totalConsultas'));
    }
}
