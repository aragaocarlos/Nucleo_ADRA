<?php
    session_start();
    require_once "../../util/config.php";

    $idProfessor = $_GET['i'];
    $idTurma = $_GET['t'];
    $idCurso = $_GET['c'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação</title>
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
                    </div>
                </a>
            </div>
        </main>
    </header>

<div class="container">
    <div class="container-avaliacao">
        <table class="tabela">
            
            <tr class="tabela-header">
                <td><center>Aluno</center></td>
                <td><center>Unidade 1</center></td>
                <td><center>Unidade 2</center></td>
                <td><center>Unidade 3</center></td>
                <td><center>Faltas</center></td>
                <td><center>Situação</center></td>
                <td><center>Ações</center></td>
                
            </tr>
            <?php
    $sql_turma = "SELECT * FROM aluno_has_turma";
    $result_turma = mysqli_query($link, $sql_turma);
    while($row = mysqli_fetch_array($result_turma)){  
        if($row['turma_id'] == $idTurma){
            $idAluno = $row['aluno_id'];
        $sql_aluno = "SELECT * FROM aluno";
        $result_aluno = mysqli_query($link, $sql_aluno);
        while($row = mysqli_fetch_array($result_aluno)){
            if($row['id'] == $idAluno){
            $nomeAluno = $row['nome_completo'];
            $avaliando = $row['id'];
            ?>
            <tr class="tabela-linha">
                <td><?php echo $nomeAluno; ?></td>
                <?php
                    $sql_avaliacao = "SELECT * FROM avaliacao";
                    $result_avaliacao = mysqli_query($link, $sql_avaliacao);
                    while($row = mysqli_fetch_array($result_avaliacao)){
                        if($row['aluno_id'] == $avaliando){
                ?>
                <td><?php
                if($row['n1'] != null){
                    echo $row['n1'];
                } else{
                    echo 'Pendente';
                }?></td>
                <td><?php
                if($row['n2'] != null){
                    echo $row['n2'];
                } else{
                    echo 'Pendente';
                }?></td>
                <td><?php
                if($row['n3'] != null){
                    echo $row['n3'];
                } else{
                    echo 'Pendente';
                }?></td>
                <td><?php
                if($row['faltas'] != null){
                    echo $row['faltas'];
                } else{
                    echo 'Pendente';
                }?></td>

                <?php
                if($row['situacao'] != null){
                    $situacaoExibir = $row['situacao'];
                } else{
                    $situacaoExibir = 'Aguardando processamento';
                }
                
                switch ($row['situacao']) {
                    case 'APROVADO':
                        $situacaoClasse = 'situacao_verde';
                    case 'REPROVADO':
                        $situacaoClasse = 'situacao_vermelho';
                    case 'Aguardando processamento':
                        $situacaoClasse = 'situacao_azul';
                }	
                ?>

                <td class="<?php echo $situacaoClasse;?>"><?php
                echo $situacaoExibir;
                ?></td>
                <td><?php echo('<a href="update_avaliacao.php?id='.$row['id'].'&i='.$idProfessor.'&a='.$row['aluno_id'].'&c='.$idCurso.'&t='.$idTurma.'" class="crud_link">Avaliar</a>')?></td>
            </tr>
            <?php
                                }
                            }
                        }
                    }
                }
            }
        ?>
        </table>
    </div>

</div>
</body>
</html>