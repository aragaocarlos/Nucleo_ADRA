<?php
    require_once "../../util/config.php";

    $idAluno = $_GET['i'];

    $sql = "SELECT * FROM professor";
    $result = mysqli_query($link, $sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
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
    <h2>Professores</h2>
    <p><a href="create.php?i=<?php echo $idAluno; ?>" class="incluir">Incluir</a></p>
    
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Nome</center></td>
            <td><center>Sexo</center></td>
            <td><center>Email</center></td>
            <td><center>Telefone</center></td>
            <td><center>Nascimento</center></td>
            <td><center>Login</center></td>
            <td><center>Senha</center></td>
            <td><center>Endereço</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
        <?php while($row = mysqli_fetch_array($result)){?>
        <tr class="tabela-linha">
            <!--<td><?php //echo($row['id'])?></td>-->
            <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['nome_completo']);?></a></td>
            <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['sexo']);?></a></td>
            <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['email']);?></a></td>
            <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['telefone']);?></a></td>
            <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo(date("d/m/Y", strtotime($row['nascimento'])));?></a></td>
            <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['login']);?></a></td>
            <td><a href="./turma/index.php?i=<?php echo $idAluno; ?>&p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['senha']);?></a></td>
            <td><?php
            $idEndereco = $row['endereco_id'];
            echo('<a href="./endereco/index.php?id='.$idEndereco.'&i='.$idAluno.'" class="crud_link">Exibir</a>')
            ?></td>
            <td><?php echo('<a href="read.php?id='.$row['id_professor'].'&i='.$idAluno.'" class="crud_link">Exibir</a>')?></td>
            <td><?php echo('<a href="update.php?id='.$row['id_professor'].'&i='.$idAluno.'" class="crud_link">Alterar</a>')?></td>
            <td><?php echo('<a href="delete.php?id='.$row['id_professor'].'&i='.$idAluno.'" class="crud_link">Excluir</a>')?></td>
        </tr>
        <?php } ?>
    </table>
    <div class="voltar">
        <p><a href='../administrador.php?i=<?php echo $idAluno; ?>'>Voltar</a></p>
    </div>
    </div>
</div>

</body>
</html>