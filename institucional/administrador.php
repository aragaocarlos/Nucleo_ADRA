<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../util/config.php";


    $idAluno = $_GET['i'];
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
    <link rel="stylesheet" href="../css/mural.css">
    <link rel="stylesheet" href="../css/administrador.css">
    <link rel="icon" href="../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="usuario.php?i=<?php echo $idAluno; ?>">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>

<div class="container-geral">
    <div class="container-titulo">
        <div class="titulo">
            Menu de Seleção
        </div>
    </div>
    <div class="container-botoes">
        <div class="dois_botoes">
            <a href="./funcionario/index.php?&i=<?php echo $idAluno; ?>">
                <div class="botao-texto">
                    Funcionários
                </div>
            </a>
            <a href="./curso/index.php?&i=<?php echo $idAluno; ?>">
                <div class="botao-texto">
                    Cursos
                </div>
            </a>
        </div>
        <div class="dois_botoes">
            <a href="./professor/index.php?&i=<?php echo $idAluno; ?>">
                <div class="botao-texto">
                    Professores
                </div>
            </a>
            <a href="./aluno/index.php?&i=<?php echo $idAluno; ?>">
                <div class="botao-texto">
                    Alunos
                </div>
            </a>
        </div>
    </div>
</div>

</body>