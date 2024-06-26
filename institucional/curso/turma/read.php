<?php
    require_once "../../../util/config.php";
    session_start();

    if ($_SESSION != null){
    $idAdmin = $_SESSION['idAdmin'];
    $idCurso = $_GET['c'];

    $sql_1 = "SELECT * FROM curso";
    $result_1 = mysqli_query($link, $sql_1);
    while($row = mysqli_fetch_array($result_1)){
        if($idCurso == $row['id_curso']){
            $nomeCurso = $row['nome'];
        }
    }

    if($_GET['id']){
        $id = $_GET['id'];
        $sql = "SELECT * FROM turma WHERE id = ?";
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
    <title>Detalhes do Curso</title>
    <link rel="stylesheet" href="../../../css/mural.css">
    <link rel="icon" href="../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../../administrador.php">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../../usuario.php">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
        <h2>Curso "<?php echo $nomeCurso; ?>"</h2>
        <h3>Detalhes da Turma</h3>
        <br>
        <p>Turma: <?php echo($row['codigo']) ?></p>
        <p>Sala: <?php echo($row['sala']) ?></p>
    </div>
    <div class="voltar">
        <p><a href='index.php?c=<?php echo $idCurso; ?>'>Voltar</a></p>
    </div>
    <?php
} else{
// Redirecionamento de volta para a página anterior
#header("Location: ../usuario.php?i=$idProfessor");
header("Location: ../../../index.php");
exit(); // Certifique-se de sair após o redirecionamento
}?>
</body>
</html>