<!DOCTYPE html>
<html>
<head>
    <title>Gerenciamento de Produtos e Estoque</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Gerenciamento de Produtos e Estoque</h1>
    
    <h2>Consultar Produtos e Estoque</h2>
    <form method="get" action="">
        <button type="submit" name="consultar">Consultar Produtos e Estoque</button>
    </form>
    
    <?php
    // Código de conexão com o banco de dados (substitua pelas suas configurações)
    $servername = "localhost";
    $username = "root";
    $password = "102030@ABC";
    $dbname = "produtos_db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Consulta de produtos e estoque
    if (isset($_GET['consultar'])) {
        $sql = "SELECT * FROM produtos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Produtos e Estoque:</h3>";
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id_produto"] . " | Nome: " . $row["nome"] . " | Estoque: " . $row["quantidade_estoque"] . "<br>";
            }
        } else {
            echo "<p>Nenhum produto encontrado.</p>";
        }
    }

    // Atualização de estoque
    if (isset($_POST['atualizar'])) {
        $produtoId = $_POST['produtoId'];
        $novaQuantidade = $_POST['novaQuantidade'];

        $sql = "UPDATE produtos SET quantidade_estoque = '$novaQuantidade' WHERE id_produto = '$produtoId'";

        if ($conn->query($sql) === TRUE) {
            echo "Estoque atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o estoque: " . $conn->error;
        }
    }

    // Cadastro de novo produto
    if (isset($_POST['cadastrarProduto'])) {
        $nomeProduto = $_POST['nomeProduto'];
        $quantidadeEstoque = $_POST['quantidadeEstoque'];

        $sql = "INSERT INTO produtos (nome, quantidade_estoque) VALUES ('$nomeProduto', '$quantidadeEstoque')";

        if ($conn->query($sql) === TRUE) {
            echo "Novo produto cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o produto: " . $conn->error;
        }
    }

    $conn->close();
    ?>
    
    <h2>Atualizar Estoque</h2>
    <form method="post" action="">
        <label for="produtoId">ID do Produto:</label>
        <input type="number" id="produtoId" name="produtoId" required><br><br>
        
        <label for="novaQuantidade">Nova Quantidade em Estoque:</label>
        <input type="number" id="novaQuantidade" name="novaQuantidade" required><br><br>
        
        <button type="submit" name="atualizar">Atualizar Estoque</button>
    </form>
    
    <h2>Cadastrar Novo Produto</h2>
    <form method="post" action="">
        <label for="nomeProduto">Nome do Produto:</label>
        <input type="text" id="nomeProduto" name="nomeProduto" required><br><br>
        
        <label for="quantidadeEstoque">Quantidade em Estoque:</label>
        <input type="number" id="quantidadeEstoque" name="quantidadeEstoque" required><br><br>
        
        <button type="submit" name="cadastrarProduto">Cadastrar Produto</button>
    </form>
</body>
</html>
