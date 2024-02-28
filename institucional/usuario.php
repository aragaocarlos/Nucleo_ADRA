<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../util/config.php";

    $idFuncionario = $_GET['i'];

    $sql = "SELECT * FROM administracao";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id'] == $idFuncionario){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural</title>
    <link rel="stylesheet" href="../css/mural.css">
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="administrador.php?i=<?php echo $idFuncionario; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                    <div id="perfil" class="opcoes-nav">
                    </div>
            </div>
        </main>
    </header>

    <div class="container">
        <div class="container-geral">
            <div class="espaco"></div>
            <div class="container-usuario">
                <div class="container-perfil">
                    <div class="icone-foto">
                        <div class="icone-camera"></div>
                    </div>
                </div>
                <div class="informacoes-titulo">
                    <div class="post-titulo">
                        Informações Básicas
                    </div>
                </div>
                <div class="informacoes-conteudo">
                    <div class="informacoes-nome">
                        <div class="informacoes-texto">
                            Nome: <?php echo $row['nome']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Nascimento: <?php echo $row['login']; ?>
                        </div>
                    </div>
                    <div class="informacoes-genero">
                        <div class="informacoes-texto">
                            Gênero: 
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-usuario">
                <div class="informacoes-titulo">
                    Contato
                </div>
                <div class="informacoes-conteudo">
                    <div class="informacoes-email">
                        <div class="informacoes-texto">
                            Email: 
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Telefone: 
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            <div class="sair">
                <a href="../index.php">
                    <div class="botao-sair">Sair</div>
                </a>
            </div>
        </div>
    </div>

</body>