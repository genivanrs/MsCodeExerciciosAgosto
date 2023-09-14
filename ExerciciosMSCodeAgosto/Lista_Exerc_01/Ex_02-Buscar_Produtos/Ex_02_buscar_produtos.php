<!DOCTYPE html>
<html>
<head>
    <title>Cadastro e Busca de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cadastro de Produtos</h1>
    <form method="post" action="">
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" required><br><br>
        
        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required><br><br>
        
        <button type="submit" name="cadastrar">Cadastrar</button>
    </form><br>
    
    <h1>Busca de Produtos</h1>
    <form method="get" action="">
        <label for="valor">Buscar produtos com preço igual ou inferior a:</label><br><br>
        <input type="number" id="valor" name="valor" step="0.01" required>
        <button type="submit" name="buscar">Buscar</button>
    </form>
    
    <?php
    // Código de conexão com o banco de dados (substitua pelas suas configurações)
    $servername = "localhost";
    $username = "root";
    $password = "102030@ABC";
    $dbname = "produto_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Cadastro de produtos
    if (isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];

        $sql = "INSERT INTO produtos (nome, preco) VALUES ('$nome', '$preco')";

        if ($conn->query($sql) === TRUE) {
            echo "Produto cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o produto: " . $conn->error;
        }
    }

    // Busca de produtos com preço <= valor fornecido
    if (isset($_GET['buscar'])) {
        $valor = $_GET['valor'];

        $sql = "SELECT * FROM produtos WHERE preco <= '$valor'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Produtos encontrados:</h2>";
            while ($row = $result->fetch_assoc()) {
                echo " | Nome: " . $row["nome"] . " | Preço: " . $row["preco"] . "<br>";
            }
        } else {
            echo "<p>Nenhum produto encontrado com preço igual ou inferior a $valor.</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>