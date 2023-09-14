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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formatador de Nomes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Formatador de Nomes</h1>
    <form method="post">
        <label for="entradaNomes">Digite a lista de nomes (um por linha):</label><br><br>
        <textarea name="entradaNomes" id="entradaNomes" rows="6" cols="50" style="vertical-align: top;"></textarea>
        <br><br>
        <input type="submit" value="Verificar" name="verificarNomes">
    </form>

    <?php if (isset($listaNomesFormatados)): ?>
        <h2>Lista Formatada:</h2>
        <ul>
            <?php foreach ($listaNomesFormatados as $nome): ?>
                <li><?php echo $nome; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
