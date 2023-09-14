<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylo.css">
    <title>Calculadora Tempo</title>
</head>
<body>
    <div class="container">
        <h1>Calculadora de Diferença de Datas</h1>
        <br><br>
        <form id="dateCalculatorForm" action="" method="post">
            <label for="dataInicial"> Data Inicial:</label>
            <input type="datetime-local" id="dataInicial" name="dataInicial" required>
            <br><br>
            <label for="dataFinal">Data Final:</label>
            <input type="datetime-local" id="dataFinal" name="dataFinal" required>
            <br><br>
            <button type="submit" name="calcular" id="BotaoCalcular">Calcular</button>
        </form>
        
        <div id="resultado" class="resultado"></div>
    </div>

    <script>
        const form = document.getElementById('dateCalculatorForm');
        const dataInicialInput = document.getElementById('dataInicial');
        const dataFinalInput = document.getElementById('dataFinal');
        const resultado = document.getElementById('resultado');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const dataInicial = new Date(dataInicialInput.value);
            const dataFinal = new Date(dataFinalInput.value);

            const diferenca = dataFinal - dataInicial;

            if (diferenca < 0) {
                resultado.textContent = "A data final deve ser maior que a data inicial.";
                return;
            }

            form.style.display = 'none';          

            const interval = setInterval(() => {
                const agora = new Date();
                const tempoRestante = dataFinal - agora;

                if (tempoRestante <= 0) {
                    clearInterval(interval);
                    resultado.textContent = "Tempo esgotado!";
                } else {
                    const dias = Math.floor(tempoRestante / (1000 * 60 * 60 * 24));
                    const horas = Math.floor((tempoRestante % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutos = Math.floor((tempoRestante % (1000 * 60 * 60)) / (1000 * 60));
                    const segundos = Math.floor((tempoRestante % (1000 * 60)) / 1000);

                    let textoResultado = "Tempo Restante:<br><br>";

                    if (dias > 0) {
                        textoResultado += `<span class="tempo dias">${dias} dias</span>`;
                    }

                    if (horas > 0 || dias > 0) {
                        textoResultado += `<span class="tempo horas">${horas} horas</span>`;
                    }

                    if (minutos > 0 || horas > 0 || dias > 0) {
                        textoResultado += `<span class="tempo minutos">${minutos} minutos</span>`;
                    }

                    if (segundos > 0 || minutos > 0 || horas > 0 || dias > 0) {
                        textoResultado += `<span class="tempo segundos">${segundos} segundos</span>`;
                    }

                    resultado.innerHTML = textoResultado;
                }
            }, 1000);

        });
    </script>
</body>
</html>


