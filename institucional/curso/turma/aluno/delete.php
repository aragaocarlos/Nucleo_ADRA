<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar</title>
    <link rel="stylesheet" href="../../../../css/mural.css">
    <link rel="icon" href="../../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
    <?php
        require_once "../../../../util/config.php";
        session_start();

        $idAdmin = $_SESSION['idAdmin'];
        $idCurso = $_GET['c'];
        $idTurma = $_GET['t'];
        if ($_GET['id']) {
            $id = $_GET['id'];
            
            // Update foreign key constraint to handle cascading deletes
            $sqlUpdateFK = "SET foreign_key_checks = 0";
            mysqli_query($link, $sqlUpdateFK);

            $sql = "DELETE FROM aluno_has_turma WHERE aluno_id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Registro Excluido</p>";
            } else {
                echo "<p>Não foi possível excluir</p>";
            }

            $sql_avaliacao = "DELETE FROM avaliacao WHERE aluno_id = ?";
            $stmt_avaliacao = mysqli_prepare($link, $sql_avaliacao);
            mysqli_stmt_bind_param($stmt_avaliacao, "i", $id);
            
            if (mysqli_stmt_execute($stmt_avaliacao)) {
                "<p>Registro Excluido</p>";
            } else {
                "<p>Não foi possível excluir</p>";
            }

            // Reset foreign key constraint
            $sqlResetFK = "SET foreign_key_checks = 1";
            mysqli_query($link, $sqlResetFK);

            header("Location: ./index.php?c=$idCurso&t=$idTurma");
            exit();
        }
        ?>
    </div>
</body>
</html>