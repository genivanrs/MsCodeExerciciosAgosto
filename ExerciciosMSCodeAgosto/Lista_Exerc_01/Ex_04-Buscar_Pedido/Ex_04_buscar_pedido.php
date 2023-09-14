<!DOCTYPE html>
<html>
<head>
    <title>Registro de Pedidos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 
    
    <div class="container" id="realizar_pedidos">
        <div class="realizar_pedidos">
            <h2>Realizar Pedido</h2><br>
            <form method="post" action="">
                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required><br><br>
                
                <label for="valor">Valor:</label>
                <input type="number" step="0.01" id="valor" name="valor" required><br><br>
                
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="realizado">Realizado</option>
                    <option value="em andamento">Em Andamento</option>
                </select><br><br>
                
                <label for="produto">Selecionar Produto:</label>
                <select id="produto" name="produto">
                    <option value="Produtos">------</option>
                    <option value="Produto A">Hamburguer</option>
                    <option value="Produto B">X-Bacon</option>
                    <option value="Produto C">Pizza</option>
                </select><br><br>
                
                <button type="submit" name="cadastrar">Cadastrar Pedido</button>
            </form>
        </div>
    </div>


    <div class="container" id="consultar_pedidos" >
        <div>
            <h2>Consultar Pedidos de 2023</h2><br><br>            
            <form method="get" action="consultar_pedidos.php" target="_blank">
            <button type="submit" name="consultar">Consultar Pedidos de 2023</button>
            </form>

        </div>
    </div>
    
    <?php
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "102030@ABC";
    $dbname = "pedidos_db";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Cadastro de pedidos
    if (isset($_POST['cadastrar'])) {
        $data = $_POST['data'];
        $valor = $_POST['valor'];
        $status = $_POST['status'];
        $produto = $_POST['produto'];

        $sql = "INSERT INTO pedidos (data, valor, status) VALUES ('$data', '$valor', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo "Pedido cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o pedido: " . $conn->error;
        }
    }
    /*
    // Consulta de pedidos de 2023
    if (isset($_GET['consultar'])) {
        $sql = "SELECT * FROM pedidos WHERE YEAR(data) = 2023";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Pedidos realizados em 2023:</h3>";
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id_pedido"] . " | Data: " . $row["data"] . " | Valor: " . $row["valor"] . " | Status: " . $row["status"] . "<br>";
            }
        } else {
            echo "<p>Nenhum pedido realizado em 2023.</p>";
        }
    }

    $conn->close();
    */
    ?>
</body>
</html>
