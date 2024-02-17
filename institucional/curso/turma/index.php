<?php
    require_once "../../../util/config.php";

    $idAluno = $_GET['i'];
    $idCurso = $_GET['c'];

    $sql_1 = "SELECT * FROM curso";
    $result_1 = mysqli_query($link, $sql_1);
    while($row = mysqli_fetch_array($result_1)){
        if($idCurso == $row['id_curso']){
            $nomeCurso = $row['nome'];
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
    <link rel="stylesheet" href="../../../css/mural.css">
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div id="perfil" class="opcoes-nav">
                </div>
            </div>
        </main>
    </header>

<div class="container-admin">
    <h2>Curso: <?php echo $nomeCurso ?></h2>
    <p><a href="create.php?i=<?php echo $idAluno; ?>" class="incluir">Incluir</a></p>
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Turma</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
        <?php 

            $sql = "SELECT * FROM turma";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($result)){
                if($idCurso == $row['curso_id_curso']){?>
            <tr class="tabela-linha">
            <!--<td><?php //echo($row['id'])?></td>-->
                <td><a href="./aluno/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($idCurso)?>&t=<?php echo($row['id'])?>" class="crud_curso"><?php echo($row['codigo'])?></a></td>
            </div>
            <td><?php echo('<a href="read.php?id='.$row['id'].'&i='.$idAluno.'&c='.$idCurso.'" class="crud_link">Exibir</a>')?></td>
            <td><?php echo('<a href="update.php?id='.$row['id'].'&i='.$idAluno.'&c='.$idCurso.'" class="crud_link">Alterar</a>')?></td>
            <td><?php echo('<a href="delete.php?id='.$row['id'].'&i='.$idAluno.'&c='.$idCurso.'" class="crud_link">Excluir</a>')?></td>
        </tr>
        <?php  }
        } ?>
    </table>
    </div>
</div>

</body>
</html>