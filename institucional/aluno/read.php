<?php
    require_once "../../util/config.php";
    session_start();

    if ($_SESSION != null){
    $idAdmin = $_SESSION['idAdmin'];

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
    <title>Detalhe do Aluno</title>
    <link rel="stylesheet" href="../../css/mural.css">
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
            <a href="../administrador.php">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../usuario.php">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>
    
    <div class="container-admin">
        <h2>Detalhes</h2>
        <p>Nome: <?php echo($row['nome']) ?></p>
        <p>Sobrenome: <?php echo($row['sobrenome']) ?></p>
        <p>Sexo: <?php echo($row['sexo']) ?></p>
        <p>Email: <?php echo($row['email']) ?></p>
        <p>Nascimento: <?php echo($row['nascimento']) ?></p>
        <?php
            $nascimento = date("Y-m-d", strtotime($row['nascimento']));
            $dataNascimento = new DateTime($nascimento);
            $dataAtual = new DateTime();
            $diferenca = $dataAtual->diff($dataNascimento);
            $idade = $diferenca->y;
        ?>
        <p>Idade: <?php echo($idade) ?></p>
        <p>Telefone: <?php echo($row['telefone']) ?></p>
        <p>RG: <?php echo($row['rg']) ?></p>
        <p>CPF: <?php echo($row['cpf']) ?></p>
        <p>Login: <?php echo($row['login']) ?></p>
        <p>Senha: <?php echo($row['senha']) ?></p>
    </div>
    <div class="voltar">
        <p><a href='index.php'>Voltar</a></p>
    </div>
    <?php
    } else{
    // Redirecionamento de volta para a página anterior
    header("Location: ../../index.php");
    exit(); // Certifique-se de sair após o redirecionamento
    }?>
</body>
</html>