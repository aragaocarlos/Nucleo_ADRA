<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../../util/config.php";

    $idProfessor = $_GET['i'];

    $sql = "SELECT * FROM professor";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id_professor'] == $idProfessor){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link rel="stylesheet" href="../../css/mural.css">
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="curso.php?i=<?php echo $idProfessor; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
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
                        <img src="../../imagens/usuario/159158661_3884476911618851_7142528251732469605_n.jpg">
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
                            Nome: <?php echo $row['nome_completo']; ?>
                        </div>
                    </div>
                    <div class="informacoes-genero">
                        <div class="informacoes-texto">
                            Gênero:  <?php echo $row['sexo']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Nascimento: <?php echo $row['nascimento']; ?>
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
                            Email: <?php echo $row['email']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Telefone:
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Login: <?php echo $row['login']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $idEndereco = $row['endereco_id'];
                $sql = "SELECT * FROM endereco";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    if($row['id'] == $idEndereco){
            ?>
            <div class="container-usuario">
                <div class="informacoes-titulo">
                    Endereço
                </div>
                <div class="informacoes-conteudo">
                    <div class="informacoes-email">
                        <div class="informacoes-texto">
                            Logradouro: <?php echo $row['logradouro']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Número: <?php echo $row['numero']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Complemento: <?php echo $row['complemento']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Bairro: <?php echo $row['bairro']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            CEP: <?php echo $row['cep']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Cidade: <?php echo $row['cidade']; ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Estado: <?php echo $row['estado']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                    }
                }
            }
            ?>
            <div class="sair">
                <a href="../aluno.php">
                    <div class="botao-sair">Sair</div>
                </a>
            </div>
        </div>
    </div>
</body>