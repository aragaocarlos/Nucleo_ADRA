<?php
    require_once "../../util/config.php";

    $idAluno = $_GET['i'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>
    <link rel="stylesheet" type="text/css" href="../../css/cad_aluno.css" />
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
<div class="container-geral">
<div class = "fundo">
        <div class = "area">
        <div class = "quadrado"> 
            <div class ="titulo">Cadastro de Funcionário</div>
            <div class ="texto">Preencha os dados</div>
            <div class ="formulario">
                <form method = "POST">
                    <div class = "cad">
                    <div class = "input-cad"><input type = "text" name = "nome" placeholder = "Primeiro nome"></div>
                    <div class = "input-end"><input type = "text" name = "cidade" placeholder = "Cidade"></div>
                    <div class = "input-end"><input type = "text" name = "uf" placeholder = "UF"></div> 
                    <!-- Botão de salvar -->
                    <button type="submit" id="botao-cadastrar">Cadastrar</button>

                    
                    </div>
                </form>
            </div>
            <div class="aba-institucional">
                <a href="index.php"><div class="portal-institucional">
                    <div class="texto-institucional">
                        Ir para a Área Institucional
                    </div>
                </div></a>
            </div>
        </div>   
        </div>   
    </div>
</div>   
</body>
</html>