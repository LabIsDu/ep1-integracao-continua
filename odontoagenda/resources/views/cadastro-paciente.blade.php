<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Cadastro de Paciente</h2>
    
    <!-- Mensagem de sucesso ou erro -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário de cadastro -->
    <form action="{{ route('pacientes.store') }}" method="POST">
        @csrf

        <!-- Informações Pessoais -->
        <div class="mb-3">
            <label for="nome" class="form-label">Nome Completo:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
            @error('nome')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" required oninput="formatarCPF(this)">
            @error('cpf')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}" required>
            @error('data_nascimento')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Gênero:</label>
            <select class="form-control" id="genero" name="genero" required>
                <option value="">Selecione</option>
                <option value="masculino" {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="feminino" {{ old('genero') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                <option value="outro" {{ old('genero') == 'outro' ? 'selected' : '' }}>Outro</option>
            </select>
            @error('genero')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contato -->
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" value="{{ old('telefone') }}" required>
            @error('telefone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Endereço -->
        <div class="mb-3">
            <label for="cep" class="form-label">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep') }}" required maxlength="9" onblur="buscarEndereco()">
            @error('cep')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="logradouro" class="form-label">Logradouro:</label>
            <input type="text" class="form-control" id="logradouro" name="logradouro" value="{{ old('logradouro') }}" required>
            @error('logradouro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="numero" class="form-label">Número:</label>
            <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}" required>
            @error('numero')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="complemento" class="form-label">Complemento:</label>
            <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('complemento') }}">
        </div>

        <div class="mb-3">
            <label for="bairro" class="form-label">Bairro:</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro') }}" required>
            @error('bairro')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade:</label>
            <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade') }}" required>
            @error('cidade')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="">Selecione</option>
                <option value="AC" {{ old('estado') == 'AC' ? 'selected' : '' }}>Acre</option>
                <option value="AL" {{ old('estado') == 'AL' ? 'selected' : '' }}>Alagoas</option>
                <option value="AP" {{ old('estado') == 'AP' ? 'selected' : '' }}>Amapá</option>
                <option value="AM" {{ old('estado') == 'AM' ? 'selected' : '' }}>Amazonas</option>
                <option value="BA" {{ old('estado') == 'BA' ? 'selected' : '' }}>Bahia</option>
                <option value="CE" {{ old('estado') == 'CE' ? 'selected' : '' }}>Ceará</option>
                <option value="ES" {{ old('estado') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                <option value="GO" {{ old('estado') == 'GO' ? 'selected' : '' }}>Goiás</option>
                <option value="MA" {{ old('estado') == 'MA' ? 'selected' : '' }}>Maranhão</option>
                <option value="MT" {{ old('estado') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                <option value="MS" {{ old('estado') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                <option value="MG" {{ old('estado') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                <option value="PA" {{ old('estado') == 'PA' ? 'selected' : '' }}>Pará</option>
                <option value="PB" {{ old('estado') == 'PB' ? 'selected' : '' }}>Paraíba</option>
                <option value="PR" {{ old('estado') == 'PR' ? 'selected' : '' }}>Paraná</option>
                <option value="PE" {{ old('estado') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                <option value="PI" {{ old('estado') == 'PI' ? 'selected' : '' }}>Piauí</option>
                <option value="RJ" {{ old('estado') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                <option value="RN" {{ old('estado') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                <option value="RS" {{ old('estado') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                <option value="RO" {{ old('estado') == 'RO' ? 'selected' : '' }}>Rondônia</option>
                <option value="RR" {{ old('estado') == 'RR' ? 'selected' : '' }}>Roraima</option>
                <option value="SC" {{ old('estado') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                <option value="SP" {{ old('estado') == 'SP' ? 'selected' : '' }}>São Paulo</option>
                <option value="SE" {{ old('estado') == 'SE' ? 'selected' : '' }}>Sergipe</option>
                <option value="TO" {{ old('estado') == 'TO' ? 'selected' : '' }}>Tocantins</option>
            </select>
            @error('estado')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Cadastrar Paciente</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Função para formatar o CPF no formato xxx.xxx.xxx-xx
    function formatarCPF(campo) {
        let cpf = campo.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
        if (cpf.length <= 11) {
            cpf = cpf.replace(/(\d{3})(\d{3})?(\d{3})?(\d{2})?/, function(_, a, b, c, d) {
                return a + (b ? '.' + b : '') + (c ? '.' + c : '') + (d ? '-' + d : '');
            });
            campo.value = cpf;
        }
    }

    // Função para buscar o endereço com base no CEP
    function buscarEndereco() {
        var cep = document.getElementById("cep").value.replace(/\D/g, ''); // Remove caracteres não numéricos
        if (cep.length === 8) {
            var url = `https://viacep.com.br/ws/${cep}/json/`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById("logradouro").value = data.logradouro;
                        document.getElementById("bairro").value = data.bairro;
                        document.getElementById("cidade").value = data.localidade;
                        document.getElementById("estado").value = data.uf;
                    } else {
                        alert("CEP não encontrado!");
                    }
                })
                .catch(error => {
                    alert("Erro ao buscar o CEP!");
                });
        }
    }
</script>

</body>
</html>
