<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once "../util/config.php";

$idAdmin = $_GET['i'];

$sql_perfil = "SELECT * FROM administracao";
$result_perfil = mysqli_query($link, $sql_perfil);
while ($row = mysqli_fetch_array($result_perfil)) {
    if($row['id'] == $idAdmin){
        $imagem64 = $row['imagem'];
        if (!empty($row['imagem'])) {
                    // Decodifica o texto em base64
                    $imagemDecodificada = base64_decode($row['imagem']);

                    // Determina o tipo de conteúdo da imagem
                    $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecodificada, FILEINFO_MIME_TYPE);

                    // Gera um URI de dados para a imagem
                    $imagemDataUri = "data:$tipoConteudo;base64," . base64_encode($imagemDecodificada);
        } else {
            $imagemDataUri = "../imagens/perfil-branco.png";
        }
        }
    }

$sql = "SELECT * FROM administracao";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result)) {
    if ($row['id'] == $idAdmin) {  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário</title>
    <link rel="stylesheet" href="../css/mural.css">
    <link rel="icon" href="../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="administrador.php?i=<?php echo $idAdmin; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="usuario.php?i=<?php echo $idAdmin; ?>">
                    <div id="perfil" class="opcoes-nav">
                    <?php
                        echo "<img src='$imagemDataUri' alt=''>";
                        ?>
                    </div>
                </a>
            </div>
        </main>
    </header>

    <div class="container">
        <div class="container-geral">
            <div class="espaco"></div>
            <div class="container-usuario">

                <div class="container-perfil">
                    <div class="icone-foto">
                        <?php
                        if (!empty($row['imagem'])) {
                                    // Decodifica o texto em base64
                                    $imagemDecodificada = base64_decode($row['imagem']);

                                    // Determina o tipo de conteúdo da imagem
                                    $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecodificada, FILEINFO_MIME_TYPE);

                                    // Gera um URI de dados para a imagem
                                    $imagemDataUri = "data:$tipoConteudo;base64," . base64_encode($imagemDecodificada);

                                    // Exibe a imagem usando a tag <img>
                                    echo "<img src='$imagemDataUri' alt=''>";
                        } else {
                            echo '<img src="../imagens/perfil-branco.png" alt="">';
                        }
                        ?>
                    </div>
                </div>
                <div class="upload_arquivo">
                    <form method="post" action="./imagem/update.php" enctype="multipart/form-data">
                        <label for="imagem">Atualize sua imagem:</label>
                        <input type="file" name="imagem" id="imagem" accept="image/*" required>
                        <input type="hidden" name="idAdmin" value="<?php echo $idAdmin; ?>">
                        <br>
                        <button type="submit">Salvar</button>
                    </form>
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
                        <div class="informacoes-texto">
                            Login: <?php echo $row['login']; ?>
                        </div>
                        <div class="informacoes-texto">
                            Senha: <?php echo $row['senha']; ?>
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