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

        $sql_2 = "SELECT * FROM professor";
        $result_2 = mysqli_query($link, $sql_2);
        while($row = mysqli_fetch_array($result_2)){
            $idEndereco = $row['endereco_id'];
        }

        $idAluno = $_GET['i'];
        if ($_GET['id']) {
            $id = $_GET['id'];
            
            // Update foreign key constraint to handle cascading deletes
            $sqlUpdateFK = "SET foreign_key_checks = 0";
            mysqli_query($link, $sqlUpdateFK);

            $sql_1 = "DELETE FROM professor WHERE id_professor = ?";
            $stmt_1 = mysqli_prepare($link, $sql_1);
            mysqli_stmt_bind_param($stmt_1, "i", $id);

            $sql_3 = "DELETE FROM endereco WHERE id = ?";
            $stmt_3 = mysqli_prepare($link, $sql_3);
            mysqli_stmt_bind_param($stmt_3, "i", $idEndereco);
            
            if (mysqli_stmt_execute($stmt_1)) {
                echo "<p>Registro Excluido</p>";
            } else {
                echo "<p>Não foi possível excluir</p>";
            }

            if (mysqli_stmt_execute($stmt_3)) {
                "<p>Registro Excluido</p>";
            } else {
                "<p>Não foi possível excluir</p>";
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