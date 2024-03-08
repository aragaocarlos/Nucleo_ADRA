<?php
    require_once "../../util/config.php";
    $idProfessor = $_GET['i'];

        $sql = "SELECT * FROM professor";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($result)){
            if($row['id_professor'] == $idProfessor){
                $idProfessor = $row['id_professor'];
                $nomeProfessor = $row['nome'] . ' ' . $row['sobrenome'];
            }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <link rel="stylesheet" href="../../css/cursos.css">
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <div class="logo">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                <a href="usuario.php?i=<?php echo $idProfessor ?>">
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
                </a>
            </div>
        </main>
    </header>

    <div class="container-titulo">
        <div class="meus-cursos">
            Minhas Turmas
        </div>
    </div>

    <div class="container-geral">
        <div class="container-curso">
        <?php
            $sql_turma = "SELECT * FROM professor_turma";
            $result_turma = mysqli_query($link, $sql_turma);
            while($row = mysqli_fetch_array($result_turma)){
                if($row['professor_id'] == $idProfessor){
                    $idTurma = $row['turma_id'];
                    $sql_1 = "SELECT * FROM turma";
                    $result_1 = mysqli_query($link, $sql_1);
                    while($row = mysqli_fetch_array($result_1)){
                        if($row['id'] == $idTurma){
                        $codigo_turma = $row['codigo'];
                        $id_curso = $row['curso_id_curso'];
                        $sala = $row['sala'];
        ?>
            <div class="curso"><a href="mural.php?c=<?php echo $row['curso_id_curso']; ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>">
                
                <div class="conteudo-curso">
                    <!-- NOME DO CURSO -->
                        <div class="nome-curso">
                        <?php 
                        $sql_2 = "SELECT * FROM curso";
                        $result_2 = mysqli_query($link, $sql_2);
                        while($row = mysqli_fetch_array($result_2)){
                            if ($row['id_curso'] == $id_curso){
                                $nome_curso = $row['nome'];
                                $dias_curso = $row['descricao'];
                                $hora_curso = $row['hora_inicio'];
                            }
                        }
                    ?>
                        <?php echo $nome_curso;?>
                    </div>
                    <!-- DIAS DO CURSO -->
                    <div class="descricao-curso">
                        Período: <?php echo $dias_curso;?>
                    </div>
                    <!-- HORÁRIO DO CURSO -->
                    <div class="descricao-curso">
                        Horário: <?php echo $hora_curso;?>
                    </div>
                    <!-- PROFESSOR DA TURMA -->
                    <div class="descricao-curso">
                        Professor: <?php echo $nomeProfessor; ?>
                    </div>   
                    <div class="area">
                        <!-- CÓDIGO DA TURMA -->
                        <div class="area-texto-turma">Turma <?php echo $codigo_turma; ?></div>
                        <!-- SALA DO CURSO -->
                        <div class="area-texto-sala">Sala: <?php echo $sala;?></div>
                    </div>
                </div>
            </div></a>
        <?php
                            }
                        }
                }
            }      
        ?>
        </div>
    </div>
</body>
</html>