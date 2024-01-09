<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once "./util/config.php";
    $idCurso = $_GET['c'];
    $sql = "SELECT * FROM curso";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id'] == $idCurso){
            $nomeCurso = $row['nome'];
        }
    }


    $idAluno = $_GET['i'];
    $sql = "SELECT * FROM aluno";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id'] == $idAluno){
            $nomeAluno = $row['nome'];
            $sobrenomeAluno = $row['sobrenome'];
            $cargoAluno = 'Aluno';
            $email = $row['email'];
            $genero = $row['genero'];
            $nascimento = $row['nascimento'];
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
    <link rel="stylesheet" href="./css/mural.css">
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="cursos.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="./imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div class="opcoes-nav">
                <a href="mural.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>">
                    <div class="opcao-nav">
                        <div class="mural-texto">
                            Mural
                        </div>
                    </div>
                </a>
                <a href="atividades.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>">
                <div class="opcao-nav">
                    <div class="atividades">
                        Atividades
                    </div>
                </div>
                </a>
                <a href="avaliacao.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>">
                    <div class="opcao-nav">
                        <div class="notas-texto">
                            Avaliação
                        </div>
                    </div>
                </a>
                </div>
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
                            Nome: 
                        </div>
                        <div class="informacoes-dado">
                            <?php $nomeAluno ?>
                            <?php $sobrenomeAluno ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Nascimento: 
                        </div>
                        <div class="informacoes-dado">
                            <?php $nascimento ?>
                        </div>
                    </div>
                    <div class="informacoes-genero">
                        <div class="informacoes-texto">
                            Gênero: 
                        </div>
                        <div class="informacoes-dado">
                            <?php $genero ?>
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
                        <div class="informacoes-dado">
                            <?php $email ?>
                        </div>
                    </div>
                    <div class="informacoes-nascimento">
                        <div class="informacoes-texto">
                            Telefone: 
                        </div>
                        <div class="informacoes-dado">
                            <?php $telefone ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sair">
                <div class="botao-sair">
                    <a href="aluno.php">Sair</a>
                </div>
            </div>
        </div>
    </div>

</body>