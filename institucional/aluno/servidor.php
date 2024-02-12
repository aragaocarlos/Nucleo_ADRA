<?php
session_start();

$minhaVariavel = $_SESSION['nome_da_variavel'];
echo "Valor: " . $_SESSION['nome_da_variavel'];
ob_clean();
?>


<a href="cliente.php?nome_da_variavel=<?php echo 4 ?>" >LINK</a>