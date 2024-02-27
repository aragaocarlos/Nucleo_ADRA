<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar</title>
    <link rel="stylesheet" href="../../css/mural.css">
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
        <?php
        require_once "../../util/config.php";
        $idAluno = $_GET['i'];
        if ($_GET['id']) {
            $id = $_GET['id'];
            
            // Update foreign key constraint to handle cascading deletes
            $sqlUpdateFK = "SET foreign_key_checks = 0";
            mysqli_query($link, $sqlUpdateFK);

            $sql = "DELETE FROM curso WHERE id_curso = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            
            if (mysqli_stmt_execute($stmt)) {
                echo "<p>Registro Excluido</p>";
            } else {
                echo "<p>Não foi possível excluir</p>";
            }

            // Reset foreign key constraint
            $sqlResetFK = "SET foreign_key_checks = 1";
            mysqli_query($link, $sqlResetFK);

            echo "<a href='index.php?i=$idAluno'>Voltar</a>";
        }
        ?>
    </div>
</body>
</html>