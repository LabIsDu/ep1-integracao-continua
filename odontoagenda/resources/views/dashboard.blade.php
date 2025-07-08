<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard - Clínica Médica</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Fundo geral */
    body {
      background-color: #f0f8ff;
      margin: 0;
      display: flex;
      min-height: 100vh;
    }
    /* Sidebar azul suave */
    .sidebar {
      background-color: #e3f2fd;
      min-height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      padding: 1rem;
      display: flex;
      flex-direction: column;
    }
    .sidebar h3 {
      color: #0d47a1;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    .sidebar .nav-link {
      color: #0d47a1;
      padding: .5rem 1rem;
      border-radius: .25rem;
      display: flex;
      align-items: center;
      gap: .5rem;
      transition: background .2s;
    }
    .sidebar .nav-link:hover {
      background-color: #bbdefb;
      text-decoration: none;
    }
    .sidebar .nav-link.active {
      background-color: #90caf9;
      font-weight: bold;
    }
    /* Botão de logout fixo no rodapé da sidebar */
    .sidebar form {
      margin-top: auto;
    }
    .sidebar .btn-logout {
      width: 100%;
      background: none;
      border: 1px solid #0d47a1;
      color: #0d47a1;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: .5rem;
      padding: .5rem;
      border-radius: .25rem;
    }
    .sidebar .btn-logout:hover {
      background-color: #bbdefb;
    }

    /* Conteúdo principal deslocado pela largura da sidebar */
    .content {
      margin-left: 250px;
      width: calc(100% - 250px);
      padding: 1rem;
      display: flex;
      flex-direction: column;
    }

    /* Cartões e botões */
    .card {
      border-left: 5px solid #0d47a1;
      margin-bottom: 1.5rem;
      box-shadow: 2px 2px 10px rgba(0,0,0,.1);
    }
    .btn-primary {
      background-color: #0d47a1;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0b5ed7;
    }

    /* Responsividade para tablets e celulares */
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        flex-direction: row;
        flex-wrap: wrap;
        padding: .5rem;
      }
      .sidebar h3 { display: none; }
      .sidebar .nav-link {
        flex: 1 1 50%;
        font-size: .9rem;
        justify-content: center;
      }
      .sidebar form { flex: 1 1 100%; margin-top: .5rem; }
      .content { margin-left: 0; width: 100%; padding: .5rem; }
    }
  </style>
</head>
<body>

  {{-- Sidebar --}}
  <nav class="sidebar">
    <h3>🩺 Painel Médico</h3>
    @auth
    <p class="text-center mb-4">
      Olá, <strong>{{ auth()->user()->name }}</strong>!
    </p>
  @endauth
    <ul class="nav flex-column mb-3">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
          🏠 Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('consultas.index') }}"
           class="nav-link {{ request()->is('consultas*') ? 'active' : '' }}">
          📋 Consultas
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('consultas.create') }}"
           class="nav-link {{ request()->is('consultas/create') ? 'active' : '' }}">
          📅 Agendar Consulta
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('pacientes.create') }}"
           class="nav-link {{ request()->is('cadastro-paciente') ? 'active' : '' }}">
          👨‍⚕️ Cadastrar Paciente
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('pacientes.index') }}"
           class="nav-link {{ request()->is('pacientes') ? 'active' : '' }}">
          👥 Lista de Pacientes
        </a>
      </li>
    </ul>

    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja sair?');">
      @csrf
      <button type="submit" class="btn-logout">
        🚪 Sair
      </button>
    </form>
  </nav>

  {{-- Conteúdo principal --}}
  <main class="content">
    {{-- Total de consultas --}}
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total de Consultas</h5>
        <p class="card-text display-4">{{ $totalConsultas }}</p>
      </div>
    </div>

    {{-- Consultas Agendadas --}}
    <section class="mb-4">
      <h2>Consultas Agendadas</h2>
      {{-- Desktop --}}
      <div class="table-responsive d-none d-md-block">
        <table class="table table-striped">
          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Paciente</th>
              <th>Data</th>
              <th>Hora</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($consultas as $consulta)
              <tr>
                <td>{{ $consulta->id }}</td>
                <td>{{ optional($consulta->paciente)->nome ?? '—' }}</td>
                <td>{{ date('d/m/Y', strtotime($consulta->data)) }}</td>
                <td>{{ $consulta->hora }}</td>
                <td>
                  <a href="{{ route('consultas.edit', $consulta->id) }}"
                     class="btn btn-info btn-sm">👁️</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- Mobile --}}
      <ul class="list-group d-md-none">
        @foreach ($consultas as $consulta)
          <li class="list-group-item">
            <strong>Paciente:</strong> {{ optional($consulta->paciente)->nome ?? '—' }}<br>
            <strong>Data:</strong> {{ date('d/m/Y', strtotime($consulta->data)) }}<br>
            <strong>Hora:</strong> {{ $consulta->hora }}<br>
            <a href="{{ route('consultas.edit', $consulta->id) }}"
               class="btn btn-info btn-sm mt-2">👁️</a>
          </li>
        @endforeach
      </ul>
    </section>

    {{-- Pacientes Cadastrados --}}
    <section>
      <h2>Pacientes Cadastrados</h2>
      {{-- Desktop --}}
      <div class="table-responsive d-none d-md-block">
        <table class="table table-striped">
          <thead class="table-primary">
            <tr>
              <th>Nome</th>
              <th>CPF</th>
              <th>E‑mail</th>
              <th>Telefone</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pacientes as $paciente)
              <tr>
                <td>{{ $paciente->nome }}</td>
                <td>{{ $paciente->cpf }}</td>
                <td>{{ $paciente->email }}</td>
                <td>{{ $paciente->telefone }}</td>
                <td>
                  <a href="{{ route('pacientes.edit', $paciente->id) }}"
                     class="btn btn-warning btn-sm">✏️</a>
                  <form action="{{ route('pacientes.destroy', $paciente->id) }}"
                        method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      {{-- Mobile --}}
      <ul class="list-group d-md-none">
        @foreach ($pacientes as $paciente)
          <li class="list-group-item">
            <strong>Nome:</strong> {{ $paciente->nome }}<br>
            <strong>CPF:</strong> {{ $paciente->cpf }}<br>
            <strong>E‑mail:</strong> {{ $paciente->email }}<br>
            <strong>Telefone:</strong> {{ $paciente->telefone }}<br>
            <div class="mt-2">
              <a href="{{ route('pacientes.edit', $paciente->id) }}"
                 class="btn btn-warning btn-sm">✏️</a>
              <form action="{{ route('pacientes.destroy', $paciente->id) }}"
                    method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
              </form>
            </div>
          </li>
        @endforeach
      </ul>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
