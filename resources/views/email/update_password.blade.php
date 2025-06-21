<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <style>
    body {
      font-family: 'Trebuchet MS', sans-serif;
      color: #333;
      line-height: 1.6;
      border-radius: 10px;
      background-color: #f2f2f2;
      padding: 20px;
    }

    .container {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ddd;
      background-color: #fff;
      border-radius: 10px;
    }

    h2 {
      color: #222;
    }

    .info {
      margin-bottom: 15px;
    }

    .password-button {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 24px;
      background-color: #007bff;
      color: #fff !important;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .password-button:hover {
      background-color: #0056b3;
    }

    .small-text {
      font-size: 12px;
      color: #777;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Solicitação de alteração de senha</h2>

    <div class="info">
      Olá, recebemos uma solicitação para redefinir a sua senha.
    </div>

    <div class="info">
      Para criar uma nova senha, clique no botão abaixo. Se você não fez essa solicitação, apenas ignore este e-mail.
    </div>

    <a class="password-button" href="{{ $link }}" target="_blank">
      Alterar minha senha
    </a>

    <div class="small-text">
      Este link é válido por tempo limitado por motivos de segurança.
    </div>
  </div>
</body>
</html>
