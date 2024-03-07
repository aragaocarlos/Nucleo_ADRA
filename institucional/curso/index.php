<?php
    require_once "../../util/config.php";

    $idAluno = $_GET['i'];

    $sql = "SELECT * FROM curso";
    $result = mysqli_query($link, $sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="../../css/mural.css">
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../usuario.php?i=<?php echo $idAluno; ?>">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>

<div class="container-admin">
    <h2>Cursos</h2>
    <p><a href="create.php?i=<?php echo $idAluno; ?>" class="incluir">Incluir</a></p>
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Nome</center></td>
            <td><center>Sigla</center></td>
            <td><center>Descrição</center></td>
            <td><center>Área</center></td>
            <td><center>CH</center></td>
            <td><center>Período</center></td>
            <td><center>Ínicio do Curso</center></td>
            <td><center>Fim do Curso</center></td>
            <td><center>Horário do Início</center></td>
            <td><center>Horário do Fim</center></td>
            <td><center>Valor</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
        <?php while($row = mysqli_fetch_array($result)){?>
        <tr class="tabela-linha">
            <!--<td><?php //echo($row['id'])?></td>-->
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['nome']);?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['sigla']);?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['descricao']);?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['area']);?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['ch']);?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['periodo']);?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo(date("d/m/Y", strtotime($row['curso_inicio'])));?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo(date("d/m/Y", strtotime($row['curso_fim'])));?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['hora_inicio']);?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['hora_fim']);?></a></td>
                <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&c=<?php echo($row['id_curso']);?>" class="crud_curso"><?php echo($row['valor']);?></a></td>
            </div>
            <td><?php echo('<a href="read.php?id='.$row['id_curso'].'&i='.$idAluno.'" class="crud_link">Exibir</a>')?></td>
            <td><?php echo('<a href="update.php?id='.$row['id_curso'].'&i='.$idAluno.'" class="crud_link">Alterar</a>')?></td>
            <td><?php echo('<a href="delete.php?id='.$row['id_curso'].'&i='.$idAluno.'" class="crud_link">Excluir</a>')?></td>
        </tr>
        <?php } ?>
    </table>
    </div>
    <div class="voltar">
        <p><a href='../administrador.php?i=<?php echo $idAluno; ?>'>Voltar</a></p>
    </div>
</div>

</body>
</html>