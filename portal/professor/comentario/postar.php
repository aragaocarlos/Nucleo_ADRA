<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../../../util/config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $idProfessor = $_POST["idProfessor"];
    $idCurso = $_POST["idCurso"];
    $idPost = $_POST["idPost"];
    $idTurma = $_POST["idTurma"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $comentario_texto = $_POST["comentario_texto"];
    $horario = date('y-m-d');

    $sql = "INSERT INTO comentario (aluno_id, post_id, turma_id, nome, sobrenome, texto, data) VALUES(?,?,?,?,?,?,?)";
    
    $stmt = mysqli_prepare($link, $sql);
    
    mysqli_stmt_bind_param($stmt, "iiissss", $idProfessor, $idPost, $idTurma, $nome, $sobrenome, $comentario_texto, $horario);

    if(mysqli_stmt_execute($stmt)){
        $_SESSION['msg'] = " Post enviado";
    }else{
        $_SESSION['msg'] = " Tente novamente mais tarde";
    }

}

// Redirecionamento de volta para a página anterior
header("Location: ../mural.php?i=$idProfessor&c=$idCurso&t=$idTurma");
exit(); // Certifique-se de sair após o redirecionamento
?>
?>