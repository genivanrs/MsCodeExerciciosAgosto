<?php
function limparLista($lista) {
    $listaLimpa = array_unique($lista);
    return $listaLimpa;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entradaLista = $_POST['entradaLista'];
    $lista = explode(',', $entradaLista);
    $listaLimpa = limparLista($lista);
    $listaLimpaFormatada = implode(',', $listaLimpa);
    $mostrarNovaLista = true;
} else {
    $mostrarNovaLista = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limpador de Lista</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Limpador de Lista</h1>
    <?php if (!$mostrarNovaLista): ?>
    <form method="post">
        <label for="entradaLista">Digite a lista de números (separados por vírgula):</label>
        <input type="text" name="entradaLista" id="entradaLista">
        <input type="submit" value="Limpar Lista" name="limparLista">
    </form>
    <?php else: ?>
    <form method="post">
        <label for="entradaLista">Digite a nova lista de números (separados por vírgula):</label>
        <input type="text" name="entradaLista" id="entradaLista">
        <input type="submit" value="Limpar Lista" name="limparLista">
        <input type="submit" value="Nova Lista" name="novaLista">
    </form>
    <?php endif; ?>

    <?php if (isset($listaLimpaFormatada)): ?>
        <h2>Lista Limpa:</h2>
        <p><?php echo $listaLimpaFormatada; ?></p>
    <?php endif; ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['novaLista'])) {
        $mostrarNovaLista = false;
    }
    ?>
</body>
</html>






