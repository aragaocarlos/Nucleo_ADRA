<?php
    require_once "../../util/config.php";
    session_start();

    if ($_SESSION != null){
    $idAdmin = $_SESSION['idAdmin'];

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
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../administrador.php?i=<?php echo $idAdmin; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="usuario.php?i=<?php echo $idAdmin; ?>">
                    <div id="perfil" class="opcoes-nav">
                    <?php
                        echo "<img src='$imagemDataUri' alt=''>";
                        ?>
                    </div>
                </a>
            </div>
        </main>
    </header>

<div class="container-admin">
    <h2>Professores</h2>
    <p><a href="create.php" class="incluir">Incluir</a></p>
    
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Nome</center></td>
            <td><center>Sexo</center></td>
            <td><center>Telefone</center></td>
            <td><center>Informações</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
        <?php while($row = mysqli_fetch_array($result)){?>
        <tr class="tabela-linha">
            <!--<td><?php //echo($row['id'])?></td>-->
            <td><a href="./turma/index.php?p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['nome_completo']);?></a></td>
            <td><a href="./turma/index.php?p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['sexo']);?></a></td>
            <td><a href="./turma/index.php?p=<?php echo($row['id_professor']);?>" class="crud_curso"><?php echo($row['telefone']);?></a></td>
            <td><?php
            $idEndereco = $row['endereco_id'];
            echo('<a href="./endereco/index.php?id='.$idEndereco.'" class="crud_link">Endereço</a>')
            ?></td>
            <td><?php echo('<a href="read.php?id='.$row['id_professor'].'" class="crud_link">Ver mais</a>')?></td>
            <td><?php echo('<a href="update.php?id='.$row['id_professor'].'" class="crud_link">Alterar</a>')?></td>
            <td><?php echo('<a href="delete.php?id='.$row['id_professor'].'" class="crud_link" onclick="confirmarExclusao(event)">Excluir</a>')?></td>
        </tr>
        <?php } ?>
    </table>
    <div class="voltar">
        <p><a href='../administrador.php'>Voltar</a></p>
    </div>
    </div>
</div>
<?php
} else{
// Redirecionamento de volta para a página anterior
header("Location: ../../index.php");
exit(); // Certifique-se de sair após o redirecionamento
}?>
</body>
</html>