<?php
    session_start();
    require_once "../../util/config.php";

    if ($_SESSION != null){
    $idProfessor = $_SESSION['idProfessor'];
    $idAtividade = $_GET['a'];
    $idTurma = $_GET['t'];
    $idCurso = $_GET['c'];
?>

<!DOCTYPE html>
<html lang="PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização e Submissão de Atividade</title>
    <link rel="stylesheet" href="../../css/atividade.css">
    <link rel="stylesheet" href="../../css/mural.css">
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="curso.php">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div class="opcoes-nav">
                <a href="mural.php?c=<?php echo $idCurso ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="mural-texto">
                            Mural
                        </div>
                    </div>
                </a>
                <a href="lista_atividade.php?c=<?php echo $idCurso ?>&t=<?php echo $idTurma; ?>">
                <div class="opcao-nav">
                    <div class="atividades">
                        Atividades
                    </div>
                </div>
                </a>
                <a href="avaliacao.php?c=<?php echo $idCurso ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="notas-texto">
                            Avaliação
                        </div>
                    </div>
                </a>
                </div>
                <a href="usuario.php">
                    <div id="perfil" class="opcoes-nav">
                    <?php
                $sql_perfil = "SELECT * FROM professor";
                $result_perfil = mysqli_query($link, $sql_perfil);
                while ($row = mysqli_fetch_array($result_perfil)) {
                    if($row['id_professor'] == $idProfessor){
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
                            echo '<img src="../../imagens/perfil-branco-200px.png" alt="">';
                        }
                        }
                    }
                        ?>
                    </div>
                </a>
            </div>
        </main>
    </header>
    <div class="container">
        <div class="container-geral">
    <?php
            $sql = "SELECT * FROM atividade";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_array($result)){
                if($row['id'] == $idAtividade){
                    $titulo = $row['titulo'];
                    $comando = $row['comando'];
                    $prazo = $row['prazo'];
                }
            }
    ?>
            <div class="post_atividade">
                <div class="atividade_titulo">
                    Visualização e Submissão de Atividade
                </div>
                <div class="atividade_info">
                    <p><h2>Título: </h2></p>
                    <p><?php echo $titulo ?></p>
                </div>
                <div class="atividade_info">
                    <p><strong>Comando da Atividade:</strong></p>
                    <p><?php echo $comando ?></p>
                </div>
                <div class="atividade_info">
                    <p><strong>Prazo de Entrega:</strong></p>
                    <p><?php echo(date("d/m/Y", strtotime($prazo))) ?></p>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    } else{
    // Redirecionamento de volta para a página anterior
    header("Location: ../professor.php");
    exit(); // Certifique-se de sair após o redirecionamento
    }?> 
</body>
</html>



