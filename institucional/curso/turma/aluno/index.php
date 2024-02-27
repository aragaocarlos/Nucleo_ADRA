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
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso: <?php echo $nomeCurso ?> </title>
    <link rel="stylesheet" href="../../../../css/mural.css">
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../../administrador.php?i=<?php echo $idAluno; ?>">
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
    <h3>Alunos</h3>
    <br>
    <p><a href="create.php?i=<?php echo $idAluno; ?>&c=<?php echo $idCurso; ?>&t=<?php echo $idTurma; ?>" class="incluir">Incluir</a></p>
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Nome</center></td>
            <td><center>Sexo</center></td>
            <td><center>Email</center></td>
            <td><center>Nascimento</center></td>
            <td><center>RG</center></td>
            <td><center>CPF</center></td>
            <td><center>login</center></td>
            <td><center>senha</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
        <?php
        $sql_2 = "SELECT * FROM aluno_has_turma";
        $result_2 = mysqli_query($link, $sql_2);
        while($row = mysqli_fetch_array($result_2)){
            if($idTurma == $row['turma_id']){
                $alunoTurma = $row['aluno_id'];

            $sql_3 = "SELECT * FROM aluno";
            $result_3 = mysqli_query($link, $sql_3);
            while($row = mysqli_fetch_array($result_3)){
                if($alunoTurma == $row['id']){
                        ?>
        <tr class="tabela-linha">
            <!--<td><?php //echo($row['id'])?></td>-->
            <td><?php echo($row['nome_completo'])?></td>
            <td><?php echo($row['sexo'])?></td>
            <td><?php echo($row['email'])?></td>
            <td><?php echo($row['nascimento'])?></td>
            <td><?php echo($row['rg'])?></td>
            <td><?php echo($row['cpf'])?></td>
            <td><?php echo($row['login'])?></td>
            <td><?php echo($row['senha'])?></td>
            <td><?php echo('<a href="read.php?id='.$row['id'].'&i='.$idAluno.'&t='.$idTurma.'&c='.$idCurso.'" class="crud_link">Exibir</a>')?></td>
            <td><?php echo('<a href="update.php?id='.$row['id'].'&i='.$idAluno.'&t='.$idTurma.'&c='.$idCurso.'" class="crud_link">Alterar</a>')?></td>
            <td><?php echo('<a href="delete.php?id='.$row['id'].'&i='.$idAluno.'&t='.$idTurma.'&c='.$idCurso.'" class="crud_link">Excluir</a>')?></td>
        </tr>
        <?php }
            }
        }
    } ?>
    </table>
    </div>
    <div class="voltar">
        <p><a href='../index.php?i=<?php echo $idAluno; ?>&c=<?php echo($idCurso)?>'>Voltar</a></p>
    </div>
</div>

</body>
</html>