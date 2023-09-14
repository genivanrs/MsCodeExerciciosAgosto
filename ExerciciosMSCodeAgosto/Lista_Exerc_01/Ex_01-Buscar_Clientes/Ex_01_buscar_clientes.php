<!DOCTYPE html>
<html>
<head>
    <title>Busca_Clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "102030@ABC";
        $dbname = "cliente_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        function buscar_cliente($conn, $idade) {
                
            // Consulta com base na idade após a inserção
            $sql = "SELECT nome FROM cliente WHERE idade > $idade"; // Use $novaIdade ao invés de $idade
            $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h2>Clientes com idade acima de $idade:</h2>";
                    echo "<ul>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . $row["nome"] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "Nenhum cliente encontrado com idade acima de $idade.";
                }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {        
            
            // Inserir novo cliente
            if (isset($_POST["novo_nome"]) && isset($_POST["nova_idade"])){    
                    $novoNome = $_POST["novo_nome"];
                    $novaIdade = $_POST["nova_idade"];
                    $sql = "INSERT INTO cliente (nome, idade) VALUES ('$novoNome', $novaIdade)";
                    if ($conn->query($sql) === TRUE) {
                        echo "Novo cliente adicionado com sucesso!";               
                    } else {
                        echo "Erro ao adicionar cliente: " . $conn->error;
                    }
                    
            }
            if (isset($_POST["idade_busca"])){
                buscar_cliente($conn, $_POST["idade_busca"]);
            } 
        }

        $conn->close();
    ?>

    <h1 id="titulo_principal">Busca de clientes por idade...</h1><br>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Buscar cliente pela idade desejada: <input type="text" name="idade_busca">
        <input type="submit" value="Buscar">
    </form><br>

    <h2>Adicionar novo cliente:</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        Nome: <input type="text" name="novo_nome"><br><br>
        Idade: <input type="text" name="nova_idade"><br><br>
        <input type="submit" value="Adicionar">
    </form>
</body>
</html>