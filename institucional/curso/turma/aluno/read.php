<?php
    require_once "../../../../util/config.php";

    $idAluno = $_GET['i'];
    $idCurso = $_GET['c'];
    $idTurma = $_GET['t'];

    $sql_1 = "SELECT * FROM curso";
    $result_1 = mysqli_query($link, $sql_1);
    while($row = mysqli_fetch_array($result_1)){
        if($idCurso == $row['id_curso']){
            $nomeCurso = $row['nome'];
        }
    }

    $sql_3 = "SELECT * FROM turma";
    $result_3 = mysqli_query($link, $sql_3);
    while($row = mysqli_fetch_array($result_3)){
        if($idTurma == $row['id']){
            $turma = $row['codigo'];
        }
    }

    if($_GET['id']){
        $id = $_GET['id'];
        $sql = "SELECT * FROM aluno WHERE id = ?";
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
    <link rel="stylesheet" href="../../../../css/mural.css">
    <link rel="icon" href="../../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div id="perfil" class="opcoes-nav">
                </div>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
        <h2>Curso "<?php echo $nomeCurso?>" - Turma "<?php echo $turma?>"</h2>
        <h3>Detalhes do Aluno</h3>
        <br>
        <p>Nome: <?php echo($row['nome']) ?></p>
        <p>Sobrenome: <?php echo($row['sobrenome']) ?></p>
        <p>Sexo: <?php echo($row['sexo']) ?></p>
        <p>Email: <?php echo($row['email']) ?></p>
        <p>Telefone: <?php echo($row['telefone']) ?></p>
        <p>Nascimento: <?php echo($row['nascimento']) ?></p>
        <p>RG: <?php echo($row['rg']) ?></p>
        <p>CPF: <?php echo($row['cpf']) ?></p>
        <p>Login: <?php echo($row['login']) ?></p>
        <p>Senha: <?php echo($row['senha']) ?></p>
    </div>
    <div class="voltar">
        <p><a href='index.php?i=<?php echo $idAluno; ?>&c=<?php echo $idCurso; ?>&t=<?php echo $idTurma; ?>'>Voltar</a></p>
    </div>
</body>
</html>