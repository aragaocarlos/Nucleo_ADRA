<?php
    require_once "../../../util/config.php";

    $idAluno = $_GET['i'];
    if($_GET['id']){
        $id = $_GET['id'];
        $sql = "SELECT * FROM endereco WHERE id = ?";
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
    <title>Detalhe do Aluno</title>
    <link rel="stylesheet" href="../../../css/mural.css">
    <link rel="icon" href="../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
            <a href="../../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../../usuario.php?i=<?php echo $idAluno; ?>">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
        <h2>Detalhes</h2>
        <p>Logradouro: <?php echo($row['logradouro']) ?></p>
        <p>Número: <?php echo($row['numero']) ?></p>
        <p>Complemento: <?php echo($row['complemento']) ?></p>
        <p>Bairro: <?php echo($row['bairro']) ?></p>
        <p>CEP <?php echo($row['cep']) ?></p>
        <p>Cidade: <?php echo($row['cidade']) ?></p>
        <p>Estado: <?php echo($row['estado']) ?></p>
    </div>
    <div class="voltar">
        <p><a href='index.php?i=<?php echo $idAluno; ?>&id=<?php echo $id; ?>'>Voltar</a></p>
    </div>
</body>
</html>