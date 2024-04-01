<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
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

    $idAluno = $_SESSION['idAluno'];
    $sql = "SELECT * FROM aluno";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id'] == $idAluno){
            $nomeAluno = $row['nome'];
            $sobrenomeAluno = $row['sobrenome'];
            $cargoAluno = 'Aluno';
            $email = $row['email'];
        }
    }

    $idPost = $_GET['p'];
    $sql = "SELECT * FROM post";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id'] == $idPost){
            $nomePost = $row['nome'];
            $sobrenomePost = $row['sobrenome'];
            $cargoPost = $row['cargo'];
            $conteudoPost = $row['conteudo'];
            $horarioPost = $row['horario'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $nomeAluno;
        $sobrenome = $sobrenomeAluno;
        $cargo = $cargoAluno;
        $conteudo = $_POST["conteudo"];
        $horario = date('d/m H:i');

        $sql = "INSERT INTO post (nome, sobrenome, cargo, conteudo, horario) VALUES(?,?,?,?,?)";
        
        $stmt = mysqli_prepare($link, $sql);
        
        mysqli_stmt_bind_param($stmt, "sssss", $nome, $sobrenome, $cargo, $conteudo, $horario);

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
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="curso.php">
                <div id="logo" class="opcoes-nav">
                    <img src="../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div class="opcoes-nav">
                <a href="mural.php?c=<?php echo $idCurso ?>">
                    <div class="opcao-nav">
                        <div class="mural-texto">
                            Mural
                        </div>
                    </div>
                </a>
                <a href="atividade.php?c=<?php echo $idCurso ?>">
                <div class="opcao-nav">
                    <div class="atividades">
                        Atividades
                    </div>
                </div>
                </a>
                <a href="avaliacao.php?c=<?php echo $idCurso ?>">
                    <div class="opcao-nav">
                        <div class="notas-texto">
                            Avaliação
                        </div>
                    </div>
                </a>
                </div>
                <a href="usuario.php">
                    <div id="perfil" class="opcoes-nav">
                    </div>
                </a>
            </div>
        </main>
    </header>

    <div class="container">
        <div class="container-geral">

    <div class="post">
        <div class="post-alinhamento">
            <div class="cabecalho">
                <div class="foto-aluno">
                    <img src="../../imagens/perfil-branco.png" alt="">
                </div>
                <div class="container-nome">
                    <div class="nome-aluno">
                        <?php echo $nomePost ?>
                        <?php echo $sobrenomePost ?>
                    </div>
                    <div class="tipo-aluno">
                    <?php echo $cargoPost ?>
                        
                    </div>
                </div>
            </div>
            <div class="conteudo-post">
                <p><?php echo $conteudoPost ?></p>
            </div>
            <div class="data">
                <?php echo $horarioPost ?>
            </div>
        </div>
        <!--
        <div class="comentarios">
            Mostrar todos os comentários
        </div>
            -->
        </div>

        </div>
    </div>
</body>