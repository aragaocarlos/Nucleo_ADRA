<?php
    require_once "../../../util/config.php";
    session_start();

    if ($_SESSION != null){

    $idAluno = $_GET['i'];
    $id= $_GET['id'];
    $sql = "SELECT * FROM endereco WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endereço</title>
    <link rel="stylesheet" href="../../../css/mural.css">
    <link rel="icon" href="../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../../administrador.php?i=<?php echo $idAdmin; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../../usuario.php?i=<?php echo $idAdmin; ?>">
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
    <h2>Endereço</h2>
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Logradouro</center></td>
            <td><center>Número</center></td>
            <td><center>Complemento</center></td>
            <td><center>Bairro</center></td>
            <td><center>CEP</center></td>
            <td><center>Cidade</center></td>
            <td><center>Estado</center></td>
            <td colspan="3"><center>Ações</center></td>
        </tr>
        <?php ?>
        <tr class="tabela-linha">
            <td><?php echo($row['logradouro'])?></td>
            <td><?php echo($row['numero'])?></td>
            <td><?php echo($row['complemento'])?></td>
            <td><?php echo($row['bairro'])?></td>
            <td><?php echo($row['cep'])?></td>
            <td><?php echo($row['cidade'])?></td>
            <td><?php echo($row['estado'])?></td>
            <td><?php echo('<a href="read.php?id='.$row['id'].'&i='.$idAluno.'" class="crud_link">Exibir</a>')?></td>
            <td><?php echo('<a href="update.php?id='.$row['id'].'&i='.$idAluno.'" class="crud_link">Alterar</a>')?></td>
        </tr>
    </table>
    <div class="voltar">
        <p><a href='../index.php?i=<?php echo $idAluno; ?>'>Voltar</a></p>
    </div>
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