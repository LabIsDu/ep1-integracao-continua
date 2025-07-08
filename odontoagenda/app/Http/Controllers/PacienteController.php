<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    // Método para exibir o formulário de cadastro
    public function create()
    {
        return view('cadastro-paciente'); // Nome da view HTML
    }

    // Método para armazenar o cadastro do paciente
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'string', 'max:14', 'unique:pacientes,cpf', function ($attribute, $value, $fail) {
                if (!$this->isValidCpf($value)) {
                    $fail('O CPF informado não é válido.');
                }
            }],
            'data_nascimento' => 'required|date',
            'genero' => 'required|string',
            'telefone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:pacientes,email',
            'cep' => 'required|string|max:9',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
        ]);

        // Criando o paciente no banco de dados
        Paciente::create($request->all());

        // Redirecionando para o dashboard com uma mensagem de sucesso
        return redirect()->route('dashboard')->with('success', 'Paciente cadastrado com sucesso!');
    }

    // Método para listar os pacientes
    public function index()
    {
        // Recupera todos os pacientes do banco
        $pacientes = Paciente::all();

        // Retorna a view com os pacientes
        return view('pacientes.index', compact('pacientes'));
    }

    // Método para editar ficha de paciente 
    public function edit($id)
{
    $paciente = Paciente::find($id);

    if (!$paciente) {
        return redirect()->route('pacientes.index')->with('error', 'Paciente não encontrado.');
    }

    return view('pacientes.edit', compact('paciente'));
}

    // Método para atualizar os dados do paciente
    public function update(Request $request, $id)
{
    // Validação dos dados
    $request->validate([
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|max:14',
        'data_nascimento' => 'required|date',
        'genero' => 'required|string',
        'telefone' => 'required|string|max:15',
        'email' => 'required|string|email|max:255',
        'cep' => 'required|string|max:9',
        'logradouro' => 'required|string|max:255',
        'numero' => 'required|string|max:10',
        'complemento' => 'nullable|string|max:255',
        'bairro' => 'required|string|max:255',
        'cidade' => 'required|string|max:255',
        'estado' => 'required|string|max:2',
    ]);
// Busca o paciente no banco de dados
    $paciente = Paciente::find($id);

    if (!$paciente) {
        return redirect()->route('pacientes.index')->with('error', 'Paciente não encontrado.');
    }

    // Atualiza os dados do paciente
    $paciente->update($request->all());

    return redirect()->route('pacientes.index')->with('success', 'Paciente atualizado com sucesso.');
}

    // Método para excluir um paciente
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente excluído com sucesso!');
    }

    // Método para exibir os detalhes de um paciente (JSON)
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);

        // Retorna os dados do paciente como JSON
        return response()->json($paciente);
    }

    // Função para validar CPF
    private function isValidCpf($cpf)
    {
        // Remover caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verificar se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verificar se o CPF é uma sequência de números iguais (ex: 111.111.111.11)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Validar primeiro dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int)$cpf[$i] * (10 - $i);
        }
        $remainder = $sum % 11;
        $firstVerifier = $remainder < 2 ? 0 : 11 - $remainder;
        if ($cpf[9] != $firstVerifier) {
            return false;
        }

        // Validar segundo dígito verificador
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += (int)$cpf[$i] * (11 - $i);
        }
        $remainder = $sum % 11;
        $secondVerifier = $remainder < 2 ? 0 : 11 - $remainder;
        if ($cpf[10] != $secondVerifier) {
            return false;
        }

        return true;
    }
    public function buscarPorCpf($cpf)
{
    $paciente = \App\Models\Paciente::where('cpf', $cpf)->first();
    
    if ($paciente) {
        return response()->json($paciente);
    } else {
        return response()->json(null);
    }
}
}
