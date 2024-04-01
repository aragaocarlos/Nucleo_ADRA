<?php
    session_start();
    require_once "../../util/config.php";
        
    $idProfessor = $_SESSION['idProfessor'];
    $idCurso = $_GET['c'];
    $idTurma = $_GET['t'];

    $sql_perfil = "SELECT * FROM professor";
    $result_perfil = mysqli_query($link, $sql_perfil);
    while ($row = mysqli_fetch_array($result_perfil)) {
        if($row['id_professor'] == $idProfessor){
            $imagem64Professor = $row['imagem'];
            if (!empty($row['imagem'])) {
                        // Decodifica o texto em base64
                        $imagemDecode = base64_decode($row['imagem']);

                        // Determina o tipo de conteúdo da imagem
                        $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecode, FILEINFO_MIME_TYPE);

                        // Gera um URI de dados para a imagem
                        $imagemDataUriProfessor = "data:$tipoConteudo;base64," . base64_encode($imagemDecode);
            } else {
                $imagemDataUriProfessor = "../../imagens/perfil.png";
            }
            }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $titulo = $_POST['titulo'];
        $comando = $_POST['comando'];
        $prazo =  $_POST['prazo'];
        $turma = $idTurma;
    
        $sql = "INSERT INTO atividade (titulo, comando, prazo, turma) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
    
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $titulo, $comando, $prazo, $turma);
            if (mysqli_stmt_execute($stmt)) {
                echo "Atividade cadastrada com sucesso!";
            } else {
                echo "Erro ao cadastrar a atividade: " . mysqli_error($link);
            }
    
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da declaração: " . mysqli_error($link);
        }
    
        mysqli_close($link);
    }
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Atividade</title>
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
                        echo "<img src='$imagemDataUriProfessor' alt=''>";
                        ?>
                    </div>
                </a>
            </div>
        </main>
    </header>

    <div class="container">
        <div class="container-geral">
            <div class="post_atividade_cadastro">
                <div class="atividade_titulo">
                    Cadastro de Atividade
                </div>
        <form method="post" action="">
            <div id="atividade_info">
                <p>Título da Atividade:</p>
                <p>
                    <div class="caixa-texto-atividade">
                        <textarea name="titulo" id="" cols="30" rows="1" placeholder="Escreva o título da atividade" required></textarea>
                    </div>
                <p>Comando da Atividade:</p>
                <p>
                    <div class="caixa-texto-atividade">
                        <textarea name="comando" id="" cols="30" rows="7" placeholder="Escreva o comando da atividade" required></textarea>
                    </div>
                </p>
            </div>
            <div id="atividade_info">            
                <p><strong>Prazo de Entrega:</strong></p>
                <p><input type = "date" name = "prazo" required></p>
            </div>
            <div id="atividade_sub">
                <button type="submit">Cadastrar Atividade</button>
            </div>
        </form>
            </div>
        </div>
    </div>
</body>
</html>