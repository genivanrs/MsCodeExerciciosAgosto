<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>New PHP - Blog</title>
</head>
<body>
    <header>
        <h1>New PHP</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Início</a></li>
            <li><a href="article.php">Artigo</a></li>
        </ul>
    </nav>
    <main>
        <?php
        function formatarNomes($listaNomes) {
            $nomesFormatados = array();
            foreach ($listaNomes as $nome) {
                $nomeFormatado = ucwords(strtolower($nome));
                $nomesFormatados[] = $nomeFormatado;
            }
            return $nomesFormatados;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $entradaNomes = $_POST['entradaNomes'];
            $listaNomes = explode("\n", $entradaNomes);
            $listaNomesFormatados = formatarNomes($listaNomes);
        }

        // Conexão com o banco de dados (substitua com suas credenciais)
        $servername = "localhost";
        $username = "root";
        $password = "102030@ABC";
        $dbname = "comentarios_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Verificar se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $nome = $_POST['nome'];
            $comentario = htmlspecialchars($_POST['comentario']);

            // Inserir o comentário no banco de dados
            $sql = "INSERT INTO comentarios (nome, comentario) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $nome, $comentario);

            if ($stmt->execute()) {
                echo "Comentário enviado com sucesso!";
            } else {
                echo "Erro ao enviar o comentário: " . $stmt->error;
            }

            // Fechar a declaração e a conexão
            $stmt->close();
        }
        ?>
        
        <article>
            <h2>Os 10 comandos mais utilizados em PHP</h2>
            <p>
                O PHP é uma linguagem de programação amplamente usada para o desenvolvimento web. Aqui estão os 10 comandos mais utilizados em PHP:
            </p>
            <ol>            
                <li>
                    echo: Usado para imprimir texto ou variáveis na saída do PHP, geralmente para exibir conteúdo na página web.
                    echo "Olá, Mundo!"; 
                </li><br>
                <li>
                    if...else: Estrutura condicional que permite executar blocos de código com base em uma condição.
                    if ($idade >= 18) { echo "Você é maior de idade."; } else { echo "Você é menor de idade."; } 
                </li><br>
                <li>
                    for: Um loop que permite que você execute um bloco de código um número específico de vezes.
                    for ($i = 0; $i < 5; $i++) { echo "Contagem: $i"; }
                </li> <br>
                <li>
                    while: Um loop que executa um bloco de código enquanto uma condição for verdadeira.
                    $contador = 0; while ($contador < 3) { echo "Contagem: $contador"; $contador++; } 
                </li><br>
                <li>
                    foreach: Usado para iterar através de elementos em arrays ou objetos.
                    $cores = array("vermelho", "azul", "verde"); foreach ($cores as $cor) { echo "Cor: $cor"; } 
                </li><br>
                <li>
                    function: Define uma função que pode ser chamada posteriormente para executar um bloco de código.
                    function saudacao($nome) { echo "Olá, $nome!"; } saudacao("Alice"); 
                </li><br>
                <li>
                    include e require: Usados para incluir código de outros arquivos PHP em seu script. include emite um aviso se o arquivo não for encontrado, enquanto require gera um erro fatal.
                    include "header.php"; require "config.php"; 
                </li><br>
                <li>
                    $_GET e $_POST: Variáveis superglobais usadas para coletar dados enviados por formulários ou por meio de URLs.
                    $nome = $_GET['nome']; $email = $_POST['email']; 
                </li><br>
                <li>
                    strlen: Retorna o comprimento de uma string.
                    $nome = "João"; $comprimento = strlen($nome); // Retorna 4
                </li> <br>
                <li>
                    date: Usado para formatar a data e hora atual de acordo com um formato especificado.
                    $dataAtual = date("d/m/Y H:i:s"); echo "Data atual: $dataAtual";
                </li>          
                
            </ol>
        </article>

        <section id="comentarios">
            <h2>Comentários</h2>
            <?php
            // Recuperar e exibir os comentários do banco de dados
            $sql = "SELECT nome, comentario, data FROM comentarios";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<p><strong>" . $row['nome'] . "</strong> em " . $row['data'] . "</p>";
                    echo "<p>" . $row['comentario'] . "</p>";
                }
            } else {
                echo "Nenhum comentário ainda.";
            }
            ?>

            <form method="post" action="">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" required><br>
                <label for="comentario">Comentário:</label>
                <textarea name="comentario" rows="4" required></textarea><br>
                <input type="submit" name="submit" value="Enviar">
            </form>
        </section>
    </main>
</body>
</html>

