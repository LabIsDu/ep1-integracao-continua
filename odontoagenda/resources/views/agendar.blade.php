<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Consulta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Agendar Consulta</h2>

    <form action="{{ route('consultas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF do Paciente</label>
            <div class="input-group">
                <input type="text" id="cpf" name="cpf" class="form-control" required>
                <button type="button" id="buscar-paciente" class="btn btn-secondary">Buscar Paciente</button>
            </div>
        </div>

        <div id="paciente-info" style="display: none;">
            <div class="mb-3">
                <label for="paciente_id" class="form-label">Nome do Paciente</label>
                <input type="hidden" id="paciente_id" name="paciente_id">
                <input type="text" id="nome" class="form-control" disabled>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" id="telefone" class="form-control" disabled>
            </div>

            <div class="mb-3">
                <label for="data_consulta" class="form-label">Data da Consulta</label>
                <input type="date" name="data_consulta" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="hora_consulta" class="form-label">Hora da Consulta</label>
                <input type="time" name="hora_consulta" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Agendar</button>
        </div>

        <!-- Alerta caso o CPF não seja encontrado -->
        <div id="paciente-nao-encontrado" class="alert alert-danger mt-3" style="display: none;">
            <p>Paciente não encontrado. Deseja cadastrá-lo?</p>
            <a id="cadastrar-paciente-btn" href="{{ route('pacientes.create') }}" class="btn btn-success">Cadastrar Paciente</a>
        </div>

    </form>
</div>

<script>
$(document).ready(function() {
    $('#buscar-paciente').on('click', function() {
        var cpf = $('#cpf').val().trim();

        if (cpf === "") {
            alert("Por favor, insira um CPF.");
            return;
        }

        $.ajax({
            url: '/buscar-paciente/' + cpf,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data && data.id) {
                    $('#paciente_id').val(data.id);
                    $('#nome').val(data.nome);
                    $('#telefone').val(data.telefone);
                    $('#paciente-info').show();
                    $('#paciente-nao-encontrado').hide();
                } else {
                    $('#paciente-info').hide();
                    $('#paciente-nao-encontrado').show();
                    $('#cadastrar-paciente-btn').attr('href', "{{ route('pacientes.create') }}?cpf=" + cpf);
                }
            },
            error: function() {
                $('#paciente-info').hide();
                $('#paciente-nao-encontrado').show();
                $('#cadastrar-paciente-btn').attr('href', "{{ route('pacientes.create') }}?cpf=" + cpf);
            }
        });
    });
});
</script>

</body>
</html>
