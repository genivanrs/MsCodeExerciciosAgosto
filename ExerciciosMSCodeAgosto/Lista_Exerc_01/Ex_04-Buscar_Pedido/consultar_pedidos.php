<!DOCTYPE html>
<html>
<head>
    <title>Consultar Pedidos de 2023</title>
    <link rel="stylesheet" href="style_consultar.css">
</head>
<body>
    <h1>Consultar Pedidos de 2023</h1>

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

    // Consulta de pedidos de 2023
    $sql = "SELECT * FROM pedidos WHERE YEAR(data) = 2023";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Pedidos realizados em 2023:</h3>";
        while ($row = $result->fetch_assoc()) {
            echo "Data: " . $row["data"] . " */*   Valor: " . $row["valor"] . " */*   Status: " . $row["status"] . "<br>";
        }
    } else {
        echo "<p>Nenhum pedido realizado em 2023.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
