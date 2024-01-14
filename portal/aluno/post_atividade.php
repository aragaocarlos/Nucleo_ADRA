<?php
    session_start();
    require_once "../../util/config.php";

    $idAluno = $_GET['i'];
    $idAtividade = $_GET['a'];
    $idTurma = $_GET['t'];
    $idCurso = $_GET['c'];
    $sql = "SELECT * FROM disciplina";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($idCurso == $row['id_dis']){
            $nomeCurso = $row['nome'];
        }
    }
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
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="cursos.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div class="opcoes-nav">
                <a href="mural.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="mural-texto">
                            Mural
                        </div>
                    </div>
                </a>
                <a href="atividade.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
                <div class="opcao-nav">
                    <div class="atividades">
                        Atividades
                    </div>
                </div>
                </a>
                <a href="avaliacao.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="notas-texto">
                            Avaliação
                        </div>
                    </div>
                </a>
                </div>
                <a href="usuario.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
                <div id="perfil" class="opcoes-nav">
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
                    <p><?php echo $prazo ?></p>
                </div>
                <form id="atividade_sub">
                    <label for="arquivo">Submeter Arquivo (PDF):</label>
                    <input type="file" id="arquivo" name="arquivo" accept=".pdf" required>
        
                    <button type="button" onclick="submeterArquivo()">Submeter Arquivo</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>



