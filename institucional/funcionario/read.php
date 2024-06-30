<?php
    require_once "../../util/config.php";
    session_start();

    if ($_SESSION != null){
    $idAdmin = $_SESSION['idAdmin'];
    if($_GET['id']){
        $id = $_GET['id'];
        $sql = "SELECT * FROM administracao WHERE id = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhe do Aluno</title>
    <link rel="stylesheet" href="../../css/mural.css">
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../administrador.php?i=<?php echo $idAdmin; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="usuario.php?i=<?php echo $idAdmin; ?>">
                    <div id="perfil" class="opcoes-nav">
                    <?php
                        echo "<img src='$imagemDataUri' alt=''>";
                        ?>
                    </div>
                </a>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
        <h2>Detalhes do Funcionário</h2>
        <p>Nome: <?php echo($row['nome']) ?></p>
        <p>Login: <?php echo($row['login']) ?></p>
        <p>Senha: <?php echo($row['senha']) ?></p>
    </div>
    <div class="voltar">
        <p><a href='index.php'>Voltar</a></p>
    </div>
<?php
} else{
// Redirecionamento de volta para a página anterior
header("Location: ../../index.php");
exit(); // Certifique-se de sair após o redirecionamento
}?>
</body>
</html>