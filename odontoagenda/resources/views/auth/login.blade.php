<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login – Odonto Agende</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    * { margin:0; padding:0; box-sizing:border-box; }
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display:flex; justify-content:center; align-items:center;
      height:100vh;
    }
    .login-container {
      background:#fff;
      padding:20px;
      border-radius:10px;
      box-shadow:0 4px 6px rgba(0,0,0,0.1);
      width:100%; max-width:400px;
      text-align:center;
    }
    .login-header h1 { font-size:24px; color:#167EE6; margin-bottom:5px; }
    .login-header p { font-size:14px; color:#666; margin-bottom:20px; }
    .form-group { margin-bottom:15px; text-align:left; }
    .form-group label { display:block; font-size:14px; margin-bottom:5px; }
    .form-group input {
      width:100%; padding:10px; font-size:14px;
      border:1px solid #ddd; border-radius:5px;
    }
    .form-group input:focus { border-color:#167EE6; outline:none; }
    .error-message { color:red; font-size:12px; margin-top:5px; display:block; }
    button[type="submit"] {
      background:#167EE6; color:#fff;
      padding:10px; border:none; border-radius:5px;
      font-size:16px; cursor:pointer; width:100%; margin-top:10px;
    }
    button[type="submit"]:hover { background:#125bb5; }

    .social-login { margin-top:20px; }
    .social-login p { font-size:14px; color:#666; margin-bottom:10px; }
    .social-buttons {
      display:flex; justify-content:space-between;
    }
    .social-button {
      flex:1; margin:0 5px;
      background:#fff; border:1px solid #ddd; border-radius:5px;
      padding:10px; font-size:14px; cursor:pointer;
      display:flex; align-items:center; justify-content:center;
    }
    .social-button i { margin-right:10px; }
    .social-button.facebook { color:#1877f2; }
    .social-button.google   { color:#db4437; }
    .social-button.apple    { color:#000; }

    .forgot-password, .create-account {
      margin-top:15px; font-size:14px;
    }
    .forgot-password a, .create-account a {
      color:#167EE6; text-decoration:none;
    }
    .forgot-password a:hover, .create-account a:hover {
      text-decoration:underline;
    }

    @media (max-width:768px) {
      .login-container { padding:15px; }
      .login-header h1 { font-size:20px; }
      .login-header p, .social-login p,
      .create-account, .forgot-password p { font-size:12px; }
      button[type="submit"] { font-size:14px; padding:8px; }
      .social-buttons { flex-direction:column; }
      .social-button { margin:5px 0; font-size:12px; padding:8px; }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="login-header">
      <h1>Odonto Agende</h1>
      <p>Seu sorriso, nossa prioridade.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" id="login-form">
      @csrf

      <div class="form-group">
        <label for="email">E‑mail*</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Senha*</label>
        <input type="password" id="password" name="password" required>
        @error('password')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <button type="submit">Acessar conta</button>
    </form>

    <div class="social-login">
      <p>Ou acesse com:</p>
      <div class="social-buttons">
        <button class="social-button facebook"><i class="fab fa-facebook-f"></i> Facebook</button>
        <button class="social-button google"><i class="fab fa-google"></i> Google</button>
        <button class="social-button apple"><i class="fab fa-apple"></i> Apple</button>
      </div>
    </div>

    <div class="forgot-password">
      <p><a href="#">Esqueceu sua senha?</a></p>
    </div>

    <div class="create-account">
  <p>Não tem uma conta? 
    <a href="{{ route('register') }}" class="text-primary fw-bold">
      Criar Conta
    </a>
  </p>
</div>

</body>
</html>
