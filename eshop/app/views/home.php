<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #FFD700;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 300px;
            padding: 16px;
            background-color: white;
            margin: 0 auto;
            margin-top: 100px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px #000;
        }
        .login-container img {
            display: block;
            margin: 0 auto;
            width: 70%;
        }
        .login-container input[type=text], .login-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 10px 0;
            border: none;
            background: #f1f1f1;
        }
        .login-container button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }
        .login-container button:hover {
            opacity:1;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="data:image/jpeg;base64,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" alt="Gatinho fofo">
        <label for="uname"><b>Nome de usuário</b></label>
        <input type="text" placeholder="Insira o nome de usuário" name="uname" required>
        <label for="psw"><b>Senha</b></label>
        <input type="password" placeholder="Insira a senha" name="psw" required>
        <button type="submit">Login</button>
    </div>
</body>
</html>
