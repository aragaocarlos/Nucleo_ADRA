<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar</title>
    <link rel="stylesheet" href="../../../css/mural.css">
    <link rel="icon" href="../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                <div id="perfil" class="opcoes-nav">
                </div>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
    <?php
        require_once "../../../util/config.php";
        session_start();
    
        $idAdmin = $_SESSION['idAdmin'];
        $idProfessor = $_GET['p'];
        if ($_GET['id']) {
            $id = $_GET['id'];
            
            $sqlUpdateFK = "SET foreign_key_checks = 0";
            mysqli_query($link, $sqlUpdateFK);

            $sql_1 = "DELETE FROM professor_turma WHERE turma_id = ?";
            $stmt_1 = mysqli_prepare($link, $sql_1);
            mysqli_stmt_bind_param($stmt_1, "i", $id);
            
            if (mysqli_stmt_execute($stmt_1)) {
                echo "<p>Registro Excluido</p>";
            } else {
                echo "<p>Não foi possível excluir</p>";
            }

            $sqlResetFK = "SET foreign_key_checks = 1";
            mysqli_query($link, $sqlResetFK);

            echo "<a href='index.php?p=$idProfessor'>Voltar</a>";
        }
        ?>
    </div>
</body>
</html>