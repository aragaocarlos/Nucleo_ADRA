<?php
    require_once "../../../util/config.php";
    session_start();

    if ($_SESSION != null){
    $idAdmin = $_SESSION['idAdmin'];
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
    <link rel="icon" href="../../../imagens/nucleo-adra-icone.png" >
    <!-- Confirmação de Exclusão -->
    <script>
        function confirmarExclusao(event) {
            var confirmacao = confirm("Você tem certeza que quer excluir?");
            if (!confirmacao) {
                event.preventDefault(); // Cancela a ação de exclusão se o usuário clicar em "Não"
            }
        }
    </script>  
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../../administrador.php">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../../usuario.php">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>

<div class="container-admin">
    <h2>Curso "<?php echo $nomeCurso?>"</h2>
    <h3>Turmas</h3>
    <br>
    <p><a href="create.php?c=<?php echo($idCurso) ?>" class="incluir">Incluir</a></p>
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Turma</center></td>
            <td><center>Sala</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
        <?php 

            $sql = "SELECT * FROM turma";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($result)){
                if($idCurso == $row['curso_id_curso']){?>
            <tr class="tabela-linha">
                <td><a href="./aluno/index.php?c=<?php echo($idCurso) ?>&t=<?php echo($row['id'])?>" class="crud_curso"><?php echo($row['codigo'])?></a></td>
                <td><a href="./aluno/index.php?c=<?php echo($idCurso) ?>&t=<?php echo($row['id'])?>" class="crud_curso"><?php echo($row['sala'])?></a></td>
            </div>
            <td><?php echo('<a href="read.php?c='.$idCurso.'&id='.$row['id'].'" class="crud_link">Exibir</a>')?></td>
            <td><?php echo('<a href="update.php?c='.$idCurso.'&id='.$row['id'].'" class="crud_link">Alterar</a>')?></td>
            <td><?php echo('<a href="delete.php?c='.$idCurso.'&id='.$row['id'].'" class="crud_link" onclick="confirmarExclusao(event)">Excluir</a>')?></td>
        </tr>
        <?php  }
        } ?>
    </table>
    </div>
    <div class="voltar">
        <p><a href='../index.php'>Voltar</a></p>
    </div>
</div>
<?php
} else{
// Redirecionamento de volta para a página anterior
header("Location: ../../../index.php");
exit(); // Certifique-se de sair após o redirecionamento
}?>
</body>
</html>