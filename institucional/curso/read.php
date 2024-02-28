<?php
    require_once "../../util/config.php";

    $idAluno = $_GET['i'];
    if($_GET['id']){
        $id = $_GET['id'];
        $sql = "SELECT * FROM curso WHERE id_curso = ?";
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
    <link rel="stylesheet" href="../../css/mural.css">
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div id="perfil" class="opcoes-nav">
                </div>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
        <h2>Detalhes do Curso</h2>
        <p>Nome: <?php echo($row['nome']) ?></p>
        <p>Sigla: <?php echo($row['sigla']) ?></p>
        <p>Descrição: <?php echo($row['descricao']) ?></p>
        <p>Área: <?php echo($row['area']) ?></p>
        <p>Carga Horária: <?php echo($row['ch']) ?></p>
        <p>Período: <?php echo($row['periodo']) ?></p>
        <p>Início do Curso: <?php echo($row['curso_inicio']) ?></p>
        <p>Fim do Curso: <?php echo($row['curso_fim']) ?></p>
        <p>Hora de Início: <?php echo($row['hora_inicio']) ?></p>
        <p>Hora de Término: <?php echo($row['hora_fim']) ?></p>
        <p>Valor: <?php echo($row['valor']) ?></p>
    </div>
    <div class="voltar">
        <p><a href='index.php?i=<?php echo $idAluno; ?>'>Voltar</a></p>
    </div>
</body>
</html>