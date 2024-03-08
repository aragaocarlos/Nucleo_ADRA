<?php
    session_start();
    require_once "../../util/config.php";
    
    $idTurma = $_GET['t'];
    $idCurso = $_GET['c'];
    $sql = "SELECT * FROM curso";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id_curso'] == $idCurso){
            $nomeCurso = $row['nome'];
        }
    }


    $idProfessor = $_GET['i'];
    $sql = "SELECT * FROM professor";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id_professor'] == $idProfessor){
            $nomeAluno = $row['nome'];
            $sobrenomeAluno = $row['sobrenome'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades</title>
    <link rel="stylesheet" href="../../css/mural.css">
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
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
                <div class="opcoes-nav">
                <a href="mural.php?c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="mural-texto">
                            Mural
                        </div>
                    </div>
                </a>
                <a href="lista_atividade.php?c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>">
                <div class="opcao-nav">
                    <div class="atividades">
                        Atividades
                    </div>
                </div>
                </a>
                <a href="avaliacao.php?c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="notas-texto">
                            Avaliação
                        </div>
                    </div>
                </a>
                </div>
                <a href="usuario.php?i=<?php echo $idProfessor; ?>">
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
    <div class="container-atividades">
        <?php
                $sql = "SELECT * FROM atividade";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    if ($idTurma == $row['turma']){
        ?>
        <a href="post_atividade.php?p=<?php echo $row['id'] ?>&c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>&a=<?php echo $row['id'] ?>"><div class="barra-atividades">
            <div class="icone-atividades">
                <img src="../../imagens/atividades.png" alt="" class="s">
            </div>
            <div class="nome-atividades">
                <?php echo $row['titulo'] ?>
            </div>
            <div class="data-atividades">
                <?php echo $row['prazo'] ?>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>

</body>
</html>