<?php
        require_once "../../../util/config.php";
        session_start();

        $idTurma = $_GET['t'];
        $idCurso = $_GET['c'];
        $idProfessor = $_SESSION['idProfessor'];
        if ($_GET['id']) {
            $id = $_GET['id'];
            
            // Update foreign key constraint to handle cascading deletes
            $sqlUpdateFK = "SET foreign_key_checks = 0";
            mysqli_query($link, $sqlUpdateFK);

            $sql_comentario = "DELETE FROM comentario WHERE id = ?";
            $stmt_comentario = mysqli_prepare($link, $sql_comentario);
            mysqli_stmt_bind_param($stmt_comentario, "i", $id);
            
            if (mysqli_stmt_execute($stmt_comentario)) {
                "<p>Registro Excluido</p>";
            } else {
                "<p>Não foi possível excluir</p>";
            }

            // Reset foreign key constraint
            $sqlResetFK = "SET foreign_key_checks = 1";
            mysqli_query($link, $sqlResetFK);

        }

// Redirecionamento de volta para a página anterior
header("Location: ../mural.php?c=$idCurso&t=$idTurma");
exit(); // Certifique-se de sair após o redirecionamento
?>
?>