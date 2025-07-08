<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas Agendadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Painel Médico</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Consultas Agendadas</h3>
            </div>
            <div class="card-body">
                @if ($consultas->isEmpty()) 
                    <p class="text-center">Nenhuma consulta agendada.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome do Paciente</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultas as $consulta)
                                <tr>
                                    <td>{{ $consulta->id }}</td>
                                    <td>{{ $consulta->paciente->nome ?? 'Paciente não encontrado' }}</td>
                                    <td>{{ date('d/m/Y', strtotime($consulta->data)) }}</td>
                                    <td>{{ $consulta->hora }}</td>
                                    <td>
                                        <!-- Botão para Editar -->
                                        <a href="{{ route('consultas.edit', $consulta->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                        <!-- Botão para Excluir -->
                                        <form action="{{ url('/consultas/' . $consulta->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <a href="{{ url('/') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>

</body>
</html>
