<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>CHESS-TORRES ♖</title>
    <link rel="stylesheet" href="Ex_01_Xadrez_Torres.css">
</head>
<body>
    <h1>CHESS-TORRES ♖</h1>    
    <div class="chessboard" id="chessboard">
        <?php
            for ($row = 1; $row <= 8; $row++) {
                for ($col = 1; $col <= 8; $col++) {
                    $color = ($row + $col) % 2 === 0 ? "white" : "black";
                    echo "<div class='square $color' data-row='$row' data-col='$col'></div>";
                }
            }
        ?>
    </div>
    <div >
        <br><br>
        <button id="resetButton">Resetar</button>
        <button id="verifyButton">Verificar</button>
        <br><br>
        <div id="result">        
    </div>
    <script>
        const chessboard = document.getElementById('chessboard');
        const resetButton = document.getElementById('resetButton');
        const verifyButton = document.getElementById('verifyButton');
        let whiteTowerPosition = null;
        let blackTowerPosition = null;

        chessboard.addEventListener('click', (event) => {
            const clickedSquare = event.target;
            if (clickedSquare.classList.contains('square')) {
                if (!whiteTowerPosition) {
                    whiteTowerPosition = clickedSquare;
                    whiteTowerPosition.textContent = '♖'; // Torre branca
                } else if (!blackTowerPosition) {
                    blackTowerPosition = clickedSquare;
                    blackTowerPosition.textContent = '♜'; // Torre preta
                }
            }
        });

        resetButton.addEventListener('click', () => {
            if (whiteTowerPosition) {
                whiteTowerPosition.textContent = '';
                whiteTowerPosition = null;
            }
            if (blackTowerPosition) {
                blackTowerPosition.textContent = '';
                blackTowerPosition = null;
            }
            clearResult();
        });

        verifyButton.addEventListener('click', () => {
            if (whiteTowerPosition && blackTowerPosition) {
                const isAttacking = areTowersAttacking(whiteTowerPosition, blackTowerPosition);
                displayResult(isAttacking);
            } else {
                clearResult();
            }
        });

        function areTowersAttacking(whiteSquare, blackSquare) {
            const whiteRow = parseInt(whiteSquare.getAttribute('data-row'));
            const whiteCol = parseInt(whiteSquare.getAttribute('data-col'));
            const blackRow = parseInt(blackSquare.getAttribute('data-row'));
            const blackCol = parseInt(blackSquare.getAttribute('data-col'));

            return whiteRow === blackRow || whiteCol === blackCol;
        }

        function displayResult(isAttacking) {
            const resultDiv = document.getElementById('result');
            if (isAttacking) {
                resultDiv.textContent = 'Estão em posição de ataque';
            } else {
                resultDiv.textContent = 'Não estão em posição de ataque';
            }
        }

        function clearResult() {
            const resultDiv = document.getElementById('result');
            resultDiv.textContent = '';
        }

</script>
</body>
</html>







