<?php 
        require_once "../../util/config.php";
        $idAluno = $_GET['i'];
        $idAluno = $_GET['i'];
        if($_GET['id']){
            $id = $_GET['id'];
            $sql = "SELECT * FROM administracao WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){        
            $nome = $_POST["nome"];
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $id = $_POST["id"];
        
            $sql = "UPDATE administracao SET nome = ?, login = ?, senha = ? WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $nome, $login, $senha, $id);
        
            if (mysqli_stmt_execute($stmt)) {
                echo "Registro atualizado com sucesso.";
            } else {
                echo "Erro na atualização: " . mysqli_error($link);
            }
    
            mysqli_stmt_close($stmt);
        }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alteração de Funcionários</title>
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
            <div id="perfil" class="opcoes-nav">
            </div>
        </div>
    </main>
</header>
<div class="container-admin">
    <h2>Alteração de Funcionários</h2>
    <form method="post" action="update.php?i=<?php echo $idAluno; ?>&id=<?php echo $id ?>">
        <p>Nome: <input type="text" name="nome" value="<?php echo $row['nome'] ?>"></p>
        <p>Login: <input type="text" name="login" value="<?php echo $row['login'] ?>"></p>
        <p>Senha: <input type="text" name="senha" value="<?php echo $row['senha'] ?>"></p>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <p><input type="submit" class="botao_funcionario" value="Alterar"></p>
    </form>

</div>
<div class="voltar">
    <p><a href='index.php?i=<?php echo $idAluno; ?>'>Voltar</a></p>
</div>
    </body>
    </html>