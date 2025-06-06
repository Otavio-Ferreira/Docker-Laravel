<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar senha</title>
  <style>
    * {
      padding: 0px;
      /* font-family: Arial, Helvetica, sans-serif; */
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
    }

    body {
      background-color: #F5F5F5;
      padding: 15px;
    }


    #header {
      padding: 5px;
      padding-bottom: 5px;
    }

    h1 {
      text-align: center;
      color: #11C76F;
    }

    #body {
      background-color: white;
      box-shadow: 0px 0px 0.5px black;
      border-top: 6px solid #11C76F;
      padding: 20px;
    }

    h2 {
      color: #333F4C;
      font-size: 26px;
    }

    hr {
      border-top: 1px solid #EAEAEF;
    }


    p {
      color: #4E5964;
      font-size: 18px;
    }

    span {
      color: #333F4C;
      font-weight: bold;
    }

    a {
      background-color: #11C76F;
      text-decoration: none;
      color: white;
      font-weight: bold;
      border-radius: 25px;
      display: block;
      width: 180px;
      height: 45px;
      text-align: center;
      align-content: center;
      margin: 20px auto 0px auto;
    }
  </style>
</head>

<body>
  <div id="header">
    <h1>Primeiro acesso</h1>
  </div>
  <div id="body">
    <h2>
      Credenciais para o primeiro acesso!
    </h2>
    <hr>
    <p>Email: <strong>{{ $email }}</strong></p>
    <p>Senha: <strong>{{ $password }}</strong></p>
    <hr>
    <p>Olá, <span>{{ $name }}</span>! <br><br> Você foi cadastrado no nosso sistema
      no horário <span>{{ $time }}</span>. <br><br> Acesse o link abaixo para acessar o sistema!
      <hr>
      <a href="{{ route('login') }}">Acessar</a>
  </div>
</body>

</html>
