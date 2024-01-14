<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../../util/config.php";
    $idCurso = $_GET['c'];
    $idTurma = $_GET['t'];
    $sql = "SELECT * FROM disciplina";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id_dis'] == $idCurso){
            $nomeCurso = $row['nome'];
        }
    }

    $idAluno = $_GET['i'];
    $sql = "SELECT * FROM professor";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id_professor'] == $idAluno){
            $nomeAluno = $row['nome'];
            $sobrenomeAluno = $row['sobrenome'];
            $cargoAluno = 'Professor';
            $email = $row['email'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $nomeAluno;
        $sobrenome = $sobrenomeAluno;
        $cargo = $cargoAluno;
        $conteudo = $_POST["conteudo"];
        $horario = date('d/m H:i');
        $turma = $idTurma;

        $sql = "INSERT INTO post (nome, sobrenome, cargo, conteudo, horario, turma) VALUES(?,?,?,?,?,?)";
        
        $stmt = mysqli_prepare($link, $sql);
        
        mysqli_stmt_bind_param($stmt, "sssssi", $nome, $sobrenome, $cargo, $conteudo, $horario, $turma);

        if(mysqli_stmt_execute($stmt)){
            $_SESSION['msg'] = " Post enviado";
        }else{
            $_SESSION['msg'] = " Tente novamente mais tarde";
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural</title>
    <link rel="stylesheet" href="../../css/mural.css">
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="curso.php?i=<?php echo $idAluno; ?>">
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
                <a href="lista_atividade.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
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
        <div class="titulo-curso">
            <div class="titulo-texto">
                <?php echo $nomeCurso; ?>
            </div>
        </div>
        <form method="post">
        <div class="container-caixa">
            <div class="container-alinhamento">
                <div class="caixa-texto">
                    <textarea name="conteudo" id="" cols="30" rows="10" placeholder="Escreva uma mensagem para a turma"></textarea>
                </div>
                <div class="caixa-base">
                    <a href=""><div class="anexo">
                        <img src="./imagens/paper-clip-branco.png" alt="">
                    </div></a>
                    <div class="publicar">
                        <button type="submit">Publicar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- INSERIR NOVA ATIVIDADE -->
        <div class="aba-atividade">
            <a href="atividade.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>"><div class="postar-atividade">
                <div class="icone-atividade">
                    +
                </div>
                <div class="texto-atividade">
                    Inserir nova atividade
                </div>
            </div></a>
        </div>
        </form>
        <?php
                $sql = "SELECT * FROM post";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    if ($idTurma == $row['turma']){
        ?>
        <div class="post"><a href="post.php?p=<?php echo $row['id'] ?>&c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
            <div class="post-alinhamento">
                <div class="cabecalho">
                    <div class="foto-aluno">
                        <img src="../../imagens/perfil-branco.png" alt="">
                    </div>
                    <div class="container-nome">
                        <div class="nome-aluno">
                        <?php echo $row['nome']; ?>
                        <?php echo $row['sobrenome']; ?>
                        </div>
                        <div class="tipo-aluno">
                        <?php echo $row['cargo']; ?>
                        </div>
                    </div>
                </div>
                <div class="conteudo-post">
                    <p><?php echo $row['conteudo']; ?></p>
                </div>
                <div class="data">
                    <?php echo $row['horario']; ?>
                </div>
            </div>
            <!--
            <div class="comentarios">
                Mostrar todos os comentários
            </div>
                -->
            </a></div>
        <?php }
                }
        ?>
    </div>
</div>


</body>
</html>