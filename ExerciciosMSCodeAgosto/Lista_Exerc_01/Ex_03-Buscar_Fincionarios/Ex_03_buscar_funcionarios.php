<!DOCTYPE html>
<html>
<head>
    <title>Cadastro e Busca de Funcionários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cadastro de Funcionários</h1>
    <form method="post" action="">
        <label for="nome">Nome do Funcionário:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="cargo">Cargo:</label>
        <input type="text" id="cargo" name="cargo" required><br><br>
        
        <button type="submit" name="cadastrar">Cadastrar</button>
    </form><br>
    
    <h1>Busca de Funcionários por Cargo</h1>
    <form method="get" action="">
        <label for="cargoBusca">Buscar funcionários por cargo:</label>
        <input type="text" id="cargoBusca" name="cargoBusca" required>
        <button type="submit" name="buscar">Buscar</button>
    </form>
    
    <?php
    // Código de conexão com o banco de dados (substitua pelas suas configurações)
    $servername = "localhost";
    $username = "root";
    $password = "102030@ABC";
    $dbname = "funcionario_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Cadastro de funcionários
    if (isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $cargo = $_POST['cargo'];

        $sql = "INSERT INTO funcionarios (nome, cargo) VALUES ('$nome', '$cargo')";

        if ($conn->query($sql) === TRUE) {
            echo "Funcionário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o funcionário: " . $conn->error;
        }
    }

    
   // Busca de funcionários por cargo
    if (isset($_GET['buscar'])) {
        $cargoBusca = $_GET['cargoBusca'];

        $sql = "SELECT * FROM funcionarios WHERE LOWER(cargo) = LOWER('$cargoBusca')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Funcionários encontrados:</h2>";
            while ($row = $result->fetch_assoc()) {
                echo " Nome: " . $row["nome"] . "<br>";
            }
        } else {
            echo "<p>Nenhum funcionário encontrado com o cargo '$cargoBusca'.</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>