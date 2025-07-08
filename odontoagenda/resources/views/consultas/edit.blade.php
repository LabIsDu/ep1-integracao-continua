<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Editar Consulta</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('consultas.update', $consulta->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="data" class="form-label">Data da Consulta</label>
                        <input type="date" name="data" id="data" class="form-control" value="{{ $consulta->data }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora da Consulta</label>
                        <input type="time" name="hora" id="hora" class="form-control" value="{{ $consulta->hora }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="{{ url('/consultas') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
