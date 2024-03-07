<?php
        require_once "../../../util/config.php";


        $idTurma = $_GET['t'];
        $idCurso = $_GET['c'];
        $idProfessor = $_GET['i'];
        $idAluno = $_GET['i'];
        if ($_GET['id']) {
            $id = $_GET['id'];
            
            // Update foreign key constraint to handle cascading deletes
            $sqlUpdateFK = "SET foreign_key_checks = 0";
            mysqli_query($link, $sqlUpdateFK);

            $sql_1 = "DELETE FROM post WHERE id = ?";
            $stmt_1 = mysqli_prepare($link, $sql_1);
            mysqli_stmt_bind_param($stmt_1, "i", $id);

            $sql_2 = "SELECT * FROM comentario";
            $result_2 = mysqli_query($link, $sql_2);
            while($row = mysqli_fetch_array($result_2)){
                $idComentario = $row['id'];
                if($row['post_id'] == $id){
                    $sql_3 = "DELETE FROM comentario WHERE id = ?";
                    $stmt_3 = mysqli_prepare($link, $sql_3);
                    mysqli_stmt_bind_param($stmt_3, "i", $idComentario);
                
                if (mysqli_stmt_execute($stmt_3)) {
                    "<p>Registro Excluido</p>";
                } else {
                    "<p>Não foi possível excluir</p>";
                }
            }

            if (mysqli_stmt_execute($stmt_1)) {
                "<p>Registro Excluido</p>";
            } else {
                "<p>Não foi possível excluir</p>";
            }

            // Reset foreign key constraint
            $sqlResetFK = "SET foreign_key_checks = 1";
            mysqli_query($link, $sqlResetFK);

        }

    }

// Redirecionamento de volta para a página anterior
header("Location: ../mural.php?i=$idProfessor&c=$idCurso&t=$idTurma");
exit(); // Certifique-se de sair após o redirecionamento
?>
?>