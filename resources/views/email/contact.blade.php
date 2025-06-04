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
    }

    .container {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ddd;
      background-color: #f9f9f9;
    }

    .info {
      margin-bottom: 10px;
    }

    .label {
      font-weight: bold;
    }

    .whatsapp-button {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 20px;
      background-color: #25d366;
      color: #fff !important;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }

    .whatsapp-button:hover {
      background-color: #20b158;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Dados da solicitação de contato:</h2>

    <div class="info">
      <span class="label">Nome:</span> {{ $nome }}
    </div>
    <div class="info">
      <span class="label">Telefone:</span> {{ $telefone }}
    </div>
    <div class="info">
      <span class="label">Assunto:</span> {{ $assunto }}
    </div>
    <div class="info">
      <span class="label">Mensagem:</span>
      <div style="margin-top: 5px;">{{ $mensagem }}</div>
    </div>

    <a class="whatsapp-button" href="https://wa.me/{{ $telefoneTratado }}" target="_blank">
      Conversar no WhatsApp
    </a>
  </div>
</body>
</html>
