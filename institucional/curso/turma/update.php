<?php 
        require_once "../../../util/config.php";
        $idAluno = $_GET['i'];
        $idCurso = $_GET['c'];
        if($_GET['id']){
            $id = $_GET['id'];
            $sql = "SELECT * FROM turma WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){        
            $codigo = $_POST["codigo"];
            $id = $_POST["id"];
            $sql = "UPDATE turma SET codigo = ? WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "si", $codigo, $id);
            if(mysqli_stmt_execute($stmt)){
                header(`location: index.php?i=`. echo($idAluno) . `&c=` . echo($idCurso));
                exit;
            } else {
                echo "Ocorreu um erro";
            }
        }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Turmas</title>
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
    <h2>Alterar Turmas</h2>
    <form method="post" action="update.php">
        <p>Turma: <input type="text" name="nome" value="<?php echo $row['codigo'] ?>"></p>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <p><input type="submit" class="botao_funcionario" value="Alterar"></p>
    </form>

</div>
<div class="voltar">
    <p><a href='index.php?i=<?php echo $idAluno; ?>&c=<?php echo $idCurso; ?>'>Voltar</a></p>
</div>
    </body>
    </html>