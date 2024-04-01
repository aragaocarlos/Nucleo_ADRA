<?php
// Iniciar a sessão
session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Se desejar destruir a sessão completamente, descomente a linha abaixo
session_destroy();

// Redirecionar para a página inicial ou outra página após logout
header("Location: ../professor.php");
exit;
?>