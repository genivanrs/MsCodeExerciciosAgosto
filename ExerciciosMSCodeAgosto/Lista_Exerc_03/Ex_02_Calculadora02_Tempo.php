  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylo.css">
    <title>Calculadora de Diferença de Datas</title>
</head>
<body>
    <div class="container">
        <h1>Calculadora de Diferença de Datas</h1>
        <form id="dateCalculatorForm" action="" method="post">
            <label for="dataHoraFutura">Data e Hora Futura:</label>
            <input type="datetime-local" id="dataHoraFutura" name="dataHoraFutura" required>
            <button type="submit" name="calcular"><strong>Calcular</strong></button>
        </form>

        <div id="resultado" class="resultado"></div>
    </div>

    <script>
        const form = document.getElementById('dateCalculatorForm');
        const dataHoraFuturaInput = document.getElementById('dataHoraFutura');
        const resultado = document.getElementById('resultado');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const dataHoraFutura = new Date(dataHoraFuturaInput.value);
            const dataAtual = new Date();

            const diferenca = dataHoraFutura - dataAtual;

            if (diferenca < 0) {
                resultado.textContent = "A data e hora futura deve ser maior que a data e hora atual.";
                return;
            }

            form.style.display = 'none';

            const interval = setInterval(() => {
                const agora = new Date();
                const tempoRestante = dataHoraFutura - agora;

                if (tempoRestante <= 0) {
                    clearInterval(interval);
                    resultado.textContent = "Tempo esgotado!";
                    window.location.href = "https://www.moveissimonetti.com.br/";

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
