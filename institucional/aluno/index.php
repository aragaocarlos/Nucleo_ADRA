<?php
    require_once "../../util/config.php";

    $idAluno = $_GET['i'];
    $sql = "SELECT * FROM aluno";
    $result = mysqli_query($link, $sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link rel="stylesheet" href="../../css/mural.css">
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
                <div id="perfil" class="opcoes-nav">
                </div>
            </div>
        </main>
    </header>

<div class="container-admin">
    <h2>Alunos</h2>
    <p><a href="create.php?i=<?php echo $idAluno; ?>">Incluir</a></p>
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Nome</center></td>
            <td><center>Sobrenome</center></td>
            <td><center>Sexo</center></td>
            <td><center>Email</center></td>
            <td><center>Nascimento</center></td>
            <td><center>RG</center></td>
            <td><center>CPF</center></td>
            <td><center>login</center></td>
            <td><center>senha</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
        <?php while($row = mysqli_fetch_array($result)){?>
        <tr class="tabela-linha">
            <!--<td><?php //echo($row['id'])?></td>-->
            <td><?php echo($row['nome'])?></td>
            <td><?php echo($row['sobrenome'])?></td>
            <td><?php echo($row['sexo'])?></td>
            <td><?php echo($row['email'])?></td>
            <td><?php echo($row['nascimento'])?></td>
            <td><?php echo($row['rg'])?></td>
            <td><?php echo($row['cpf'])?></td>
            <td><?php echo($row['login'])?></td>
            <td><?php echo($row['senha'])?></td>
            <td><?php echo('<a href="read.php?id='.$row['id'].'&i='.$idAluno.'">Exibir</a>')?></td>
            <td><?php echo('<a href="update.php?id='.$row['id'].'&i='.$idAluno.'">Alterar</a>')?></td>
            <td><?php echo('<a href="delete.php?id='.$row['id'].'&i='.$idAluno.'">Excluir</a>')?></td>
        </tr>
        <?php } ?>
    </table>
    </div>
</div>

</body>
</html>