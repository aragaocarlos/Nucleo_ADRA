<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar</title>
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
        <?php
        require_once "../../util/config.php";
        $idAluno = $_GET['i'];
        if($_GET['id']){
            $id = $_GET['id'];
            $sql = "DELETE FROM aluno WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            if(mysqli_stmt_execute($stmt)){
                echo "<p>Registro Excluido</p>";
            }else{
                echo "<p>Não foi possível excluir</p>";
            }
            echo "<a href='index.php?i=<?php echo $idAluno; ?>'>Voltar</a>";
        }
    ?>
    </div>
</body>
</html>