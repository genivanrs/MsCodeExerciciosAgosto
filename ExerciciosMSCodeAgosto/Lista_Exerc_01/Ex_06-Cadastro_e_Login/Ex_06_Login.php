<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Login e Cadastro</title>
    <style>
        body {
            margin-top: 55px;
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #6959CD;
        }
        
        .container {
            width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #6959CD;
            border-radius: 5px;
        }
        
        .form-group {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Sistema de Login e Cadastro</h1>
    <div class="container">       
        <h2>Login</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" name="login">Login</button>            
        </form>
        <h2>Ainda não tem cadastro?</h2>
        <button type="submit" name="cadastro"><a href="../Lista_Exerc_01/Ex_06_Cadastro.php">Cadastre-se
        </a></button>      
        
        
        <?php
        // Código de conexão com o banco de dados (substitua pelas suas configurações)
        $servername = "localhost";
        $username = "root";
        $password = "102030@ABC";
        $dbname = "usuarios_db";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
       // Autenticação de login
        if (isset($_POST['login'])) {
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $sql = "SELECT id_usuario, nome, senha FROM usuarios WHERE email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($senha, $row['senha'])) {
                    // Redirecionar para a página após o login
                    header("Location: Ex_06_pagina_logada.php");
                    exit; // Certificar-se de que o script seja encerrado após o redirecionamento
                } else {
                    echo "Senha incorreta.";
                }
            } else {
                echo "Usuário não encontrado.";
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
