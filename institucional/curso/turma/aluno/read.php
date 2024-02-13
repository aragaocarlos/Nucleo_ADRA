<?php
    require_once "../../../util/config.php";

    $idAluno = $_GET['i'];
    $idCurso = $_GET['c'];
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
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div id="perfil" class="opcoes-nav">
                </div>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
        <h2>Detalhes da Turma</h2>
        <p>Turma: <?php echo($row['codigo']) ?></p>
    </div>
    <div class="voltar">
        <p><a href='index.php?i=<?php echo $idAluno; ?>&c=<?php echo $idCurso; ?>'>Voltar</a></p>
    </div>
</body>
</html>