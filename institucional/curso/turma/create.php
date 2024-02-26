<?php
    require_once "../../../util/config.php";

    $idAluno = $_GET['i'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Curso</title>
    <link rel="stylesheet" type="text/css" href="../../../css/cad_funcionario.css" />
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
                <div id="perfil" class="opcoes-nav">
                </div>
            </div>
        </main>
    </header>  

<div class="container-geral">
<div class = "fundo">
        <div class = "area">
        <div class = "quadrado">
            <div class ="titulo">Cadastro de Turma</div>
            <div class ="texto">Curso TAL</div>
            <form method = "POST">
                <div class = "cad">
                    <div class = "input-cad"><input type="text" id="codigo" name="codigo" placeholder = "Turma"></div>
                    <div class = "input-cad"><input type="text" id="sala" name="sala" placeholder = "Sala"></div>

                    <button type="submit" id="botao-cadastrar">Cadastrar</button>
                    </div>
                </form>
        </div>
        </div>
</div> 
</div>
</body>
</html>