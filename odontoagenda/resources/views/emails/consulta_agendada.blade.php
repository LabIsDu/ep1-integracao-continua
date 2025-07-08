<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta Agendada</title>
</head>
<body>
    <h2>Olá, {{ $consulta->paciente->nome }}</h2>
    <p>Sua consulta foi agendada com sucesso!</p>
    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($consulta->data)->format('d/m/Y') }}</p>
    <p><strong>Hora:</strong> {{ \Carbon\Carbon::parse($consulta->hora)->format('H:i') }}</p>
    <p><strong>Local:</strong> Clínica Médica XYZ</p>
    <p>Se precisar remarcar ou cancelar, entre em contato.</p>
</body>
</html>
