<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Agendar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Painel Médico</a>
        </div>
    </nav>

    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Opções</h3>
            </div>
            <div class="card-body">
                <p>Escolha uma das opções abaixo:</p>
                <a href="{{ url('/agendar') }}" class="btn btn-success">Agendar Consulta</a>
            </div>
        </div>
    </div>

</body>
</html>
<a href="{{ url('/consultas') }}" class="btn btn-info">Ver Consultas Agendadas</a>

