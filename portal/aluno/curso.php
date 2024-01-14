<?php
    require_once "../../util/config.php";
    $idAluno = $_GET['i'];

        $sql = "SELECT * FROM aluno";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_array($result)){
            if($row['id'] == $idAluno){
                $idAluno = $row['id'];
                $nomeAluno = $row['nome'];
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
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <div class="logo">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                <a href="usuario.php?c=#&i=<?php echo $idAluno; ?>&t=#">
                <div id="perfil" class="opcoes-nav">
                </div>
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
                $sql = "SELECT * FROM turma";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    $id_turma = $row['id'];
                    $codigo_turma = $row['codigo'];
                    $id_disciplina = $row['disciplina_id'];
        ?>
            <!-- INTEGRAÇÃO COM BANCO DE DADOS AQUI -->
            <div class="curso"><a href="mural.php?c=<?php echo $row['disciplina_id']; ?>&i=<?php echo $idAluno; ?>&t=<?php echo $row['id']; ?>">
                
                <div class="conteudo-curso">
                    <!-- NOME DA TURMA -->
                    <div class="nome-curso">
                        <?php 
                        $sql = "SELECT * FROM disciplina";
                        $result = mysqli_query($link, $sql);
                        while($row = mysqli_fetch_array($result)){
                            if ($id_disciplina == $row['id_dis']){
                                $nome_disciplina = $row['nome'];
                                $id_curso = $row['curso_id'];
                            echo $row['nome'];
                            }
                            }
                        ?>
                    </div>
                    <!-- NOME DO CURSO -->
                    <div class="descricao-curso">
                    <?php 
                        $sql = "SELECT * FROM curso";
                        $result = mysqli_query($link, $sql);
                        while($row = mysqli_fetch_array($result)){
                            if ($id_curso == $row['id_curso']){
                    ?>
                        Curso: <?php echo $row['nome']; }}?>
                    </div>
                    <!-- PROFESSOR DA TURMA -->
                    <div class="descricao-curso">
                    <?php 
                        $sql = "SELECT * FROM professor_turma";
                        $result = mysqli_query($link, $sql);
                        while($row = mysqli_fetch_array($result)){
                            if ($id_turma == $row['turma_id']){
                                $id_professor = $row['professor_id'];
                            }
                            $sql = "SELECT * FROM professor";
                            $result = mysqli_query($link, $sql);
                            while($row = mysqli_fetch_array($result)){
                                if ($id_professor == $row['id_professor']){
                                    $nome_professor = $row['nome'] . ' ' . $row['sobrenome'];
                                }
                            }
                    ?>
                        Professor: <?php echo $nome_professor; }?>
                    </div>
                    <!-- CÓDIGO DA TURMA -->
                    <div class="area">
                        <div class="area-texto">Turma <?php echo $codigo_turma ?></div>
                    </div>
                </div>
            </div></a>
        <?php
                        
                }
        ?>
        </div>
    </div>
</body>
</html>