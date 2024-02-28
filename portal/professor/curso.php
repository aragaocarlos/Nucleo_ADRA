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
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
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
                $sql_1 = "SELECT * FROM turma";
                $result_1 = mysqli_query($link, $sql_1);
                while($row = mysqli_fetch_array($result_1)){
                    $id_turma = $row['id'];
                    $codigo_turma = $row['codigo'];
                    $id_curso = $row['curso_id_curso'];
                
        ?>
            <!-- INTEGRAÇÃO COM BANCO DE DADOS AQUI -->
            <div class="curso"><a href="mural.php?c=<?php echo $row['curso_id_curso']; ?>&i=<?php echo $idAluno; ?>&t=<?php echo $id_turma; ?>">
                
                <div class="conteudo-curso">
                    <!-- NOME DO CURSO -->
                        <div class="nome-curso">
                        <?php 
                        $sql = "SELECT * FROM curso";
                        $result = mysqli_query($link, $sql);
                        while($row = mysqli_fetch_array($result)){
                            if ($id_curso == $row['id_curso']){
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
                    <?php 
                        $sql_5 = "SELECT * FROM professor_turma";
                        $result_5 = mysqli_query($link, $sql_5);
                        while($row = mysqli_fetch_array($result_5)){
                            if ($id_turma == $row['turma_id']){
                                $id_professor = $row['professor_id'];
                            }
                            $sql_6 = "SELECT * FROM professor";
                            $result_6 = mysqli_query($link, $sql_6);
                            while($row = mysqli_fetch_array($result_6)){
                                if ($id_professor == $row['id_professor']){
                                    $nome_professor = $row['nome'] . ' ' . $row['sobrenome'];
                                }
                            }
                    ?>
                        Professor: <?php echo $nome_professor; }?>
                    </div>
                    <?php          
                        $sql_2 = "SELECT * FROM sala_has_turma";
                        $result_2 = mysqli_query($link, $sql_2);
                        while($row = mysqli_fetch_array($result_2)){
                            if($row['turma_id'] == $id_turma){
                                $sala_id = $row['sala_id'];
                                $sql_3 = "SELECT * FROM sala";
                                $result_3 = mysqli_query($link, $sql_3);
                                while($row = mysqli_fetch_array($result_3)){
                                    if($row['id'] == $sala_id){
                                        $sala = $row['tipo'];
                                    }
                                }
                            }
                        }
                        ?>
                    
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
        ?>
        </div>
    </div>
</body>
</html>