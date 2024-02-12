<?php
session_start();

$minhaVariavel = $_GET['nome_da_variavel'];
var_dump($minhaVariavel); // Verifique o valor
$_SESSION['nome_da_variavel'] = $minhaVariavel;
echo $_SESSION['nome_da_variavel'];
if($_SERVER['REQUEST_METHOD'] == "POST"){  
    ob_clean();
    header("Location: servidor.php");
}
?>

<form method="post" action="cliente.php">
    <input type="submit" class="botao_funcionario" value="Alterar">
</form>
