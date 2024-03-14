<?php
    session_start();
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de Seleção</title>
    <link rel="stylesheet" href="../css/mural.css">
    <link rel="stylesheet" href="../css/administrador.css">
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

<div class="container-geral">
    <!--
    <div class="container-pesquisa">
    <form action="" method="POST">
        <div class="container-input">
            <input type="text" name="pesquisa" placeholder="Insira sua pesquisa">
        </div>
        <div class="container-lupa">
            <button type="submit"><img src="../imagens/lupa.png"></button>
        </div>
        </form>
    </div>
    -->
    <div class="container-titulo">
        <div class="titulo">
            Menu de Seleção
        </div>
    </div>
    <div class="container-botoes">
        <div class="dois_botoes">
            <a href="./funcionario/index.php?&i=<?php echo $idAdmin; ?>">
                <div class="botao-texto">
                    Funcionários
                </div>
            </a>
            <a href="./curso/index.php?&i=<?php echo $idAdmin; ?>">
                <div class="botao-texto">
                    Cursos
                </div>
            </a>
        </div>
        <div class="dois_botoes">
            <a href="./professor/index.php?&i=<?php echo $idAdmin; ?>">
                <div class="botao-texto">
                    Professores
                </div>
            </a>
            <a href="./aluno/index.php?&i=<?php echo $idAdmin; ?>">
                <div class="botao-texto">
                    Alunos
                </div>
            </a>
        </div>
    </div>
</div>

</body>