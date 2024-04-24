<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["numero1"]) && isset($_POST["operacao"]) && isset($_POST["numero2"])) {
        $numero1 = $_POST["numero1"];
        $operacao = $_POST["operacao"];
        $numero2 = $_POST["numero2"];

        
        switch ($operacao) {
            case '+':
                $resultado = $numero1 + $numero2;
                break;
            case '-':
                $resultado = $numero1 - $numero2;
                break;
            case '*':
                $resultado = $numero1 * $numero2;
                break;
            case '/':
                if ($numero2 != 0) {
                    $resultado = $numero1 / $numero2;
                } else {
                    $resultado = "Erro: divisão por zero";
                }
                break;
            case '^':
                $resultado = pow($numero1, $numero2);
                break;
            case '!':
                $resultado = gmp_fact($numero1);
                break;
            default:
                $resultado = "Operação inválida";
        }

        // Adiciona a operação ao histórico
        if (!isset($_SESSION["historico"])) {
            $_SESSION["historico"] = [];
        }
        array_push($_SESSION["historico"], "$numero1 $operacao $numero2 = $resultado");
        
        // Define o resultado para exibição no visor
        $_SESSION["visor"] = "$numero1 $operacao $numero2 = $resultado";
    }
    
    // Funcionamento do Botão Salvar
    if (isset($_POST["salvar"])) {
        $_SESSION["memoria"] = $_SESSION["visor"];
    }
    
    // Funcionamento do Botão Pegar Valores
    if (isset($_POST["pegar_valores"])) {
        if (isset($_SESSION["memoria"])) {
            $_SESSION["visor"] = $_SESSION["memoria"];
            unset($_SESSION["memoria"]);
        }
    }
	
    // Funcionamento do Botão Memoria que é a mescla dos 2 outros botoes.
	if (isset($_POST["memoria"])) {
		if (isset($_SESSION["memoria"])) {
			$_SESSION["visor"] = $_SESSION["memoria"];
			unset($_SESSION["memoria"]);
		} else {
			$_SESSION["memoria"] = $_SESSION["visor"];
		}
	}
    
    // Funcionamento do Botão Limpar Historico
    if (isset($_POST["limpar_historico"])) {
        // Limpa o histórico
        unset($_SESSION["historico"]);
		unset($_SESSION["memoria"]);
		unset($_SESSION["visor"]);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>Calculadora PHP</title>
</head>
<body>
    <h1 class="titulo-principal">Calculadora PHP</h1>
    <div class="gameboy cima">

        <div class="tela">
            <h2>Visor:</h2>
            <div>
                <?php
                    if (isset($_SESSION["visor"])) {
                        echo $_SESSION["visor"];
                    }
                ?>
            </div>
        </div>

        <div class="">
            <h2>Memoria</h2>
            <div>
                <?php
                    if (isset($_SESSION["memoria"])) {
                        echo $_SESSION["memoria"];
                    }
                ?>
            </div>

            <h2>Histórico:</h2>
            <div id="historico">
                <?php
                if (isset($_SESSION["historico"])) {
                    foreach ($_SESSION["historico"] as $op) {
                        echo $op . "<br>";
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <div class="gameboy baixo">
        <form method="post">
            <label for="numero1">Número 1:</label>
            <input type="text" name="numero1" id="numero1" required><br><br>
            
            <label for="operacao">Operação:</label>
            <select name="operacao" id="operacao" required>
                <option value="+" selected>+</option>
                <option value="-">-</option>
                <option value="/">/</option>
                <option value="*">*</option>
                <option value="^">^</option>
                <option value="!">n!</option>
            </select><br><br>
            
            <label for="numero2">Número 2:</label>
            <input type="text" name="numero2" id="numero2" required><br><br>
            
            <input type="submit" name="calcular" value="Calcular">
        </form>

        <br>
        <form method="post">
            <input type="submit" name="salvar" value="Salvar">
            <input type="submit" name="pegar_valores" value="Pegar Valores">
            <input type="submit" name="memoria" value="Memória">
            <input type="submit" name="limpar_historico" value="Apagar Histórico">
        </form>

    </div>
        
        
        
        
        
        
    </div>
</body>
</html>