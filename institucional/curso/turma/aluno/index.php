<?php
    require_once "../../../../util/config.php";

    $idAluno = $_GET['i'];
    $idCurso = $_GET['c'];
    $idTurma = $_GET['t'];

    $info_total = 0;
    $info_17 = 0;
    $info_18_59 = 0;
    $info_60 = 0;
    $info_masculino = 0;
    $info_feminino = 0;
    $info_outro_genero = 0;
    $info_sim_pcd = 0;
    $info_nao_pcd = 0;

    $sql_info = "SELECT * FROM aluno";
    $result_info = mysqli_query($link, $sql_info);
    while($row = mysqli_fetch_array($result_info)){
        $info_total += 1;
        if($row['idade'] <= 17){
            $info_17 += 1;
        }
        if($row['idade'] >= 18 && $row['idade'] <= 59){
            $info_18_59 += 1;
        }
        if($row['idade'] >= 60){
            $info_60 += 1;
        }
        if($row['sexo'] == 'M'){
            $info_masculino += 1;
        }
        if($row['sexo'] == 'F'){
            $info_feminino += 1;
        }
        if($row['sexo'] == 'N'){
            $info_outro_genero += 1;
        }
        if($row['pcd'] == 1){
            $info_sim_pcd += 1;
        }
        if($row['pcd'] == 0){
            $info_nao_pcd += 1;
        }
    }

    $sql_1 = "SELECT * FROM curso";
    $result_1 = mysqli_query($link, $sql_1);
    while($row = mysqli_fetch_array($result_1)){
        if($idCurso == $row['id_curso']){
            $nomeCurso = $row['nome'];
        }
    }

    $sql_3 = "SELECT * FROM turma";
    $result_3 = mysqli_query($link, $sql_3);
    while($row = mysqli_fetch_array($result_3)){
        if($idTurma == $row['id']){
            $turma = $row['codigo'];
        }
    }

    $sql_5 = "SELECT * FROM professor_turma";
    $result_5 = mysqli_query($link, $sql_5);
    while($row = mysqli_fetch_array($result_5)){
        if($row['turma_id'] == $idTurma){
            $idProfessor = $row['professor_id'];
            $sql_6 = "SELECT * FROM professor";
            $result_6 = mysqli_query($link, $sql_6);
            while($row = mysqli_fetch_array($result_6)){
                if($row['id_professor'] == $idProfessor){
                    $nomeProfessor = $row['nome_completo'];
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso: <?php echo $nomeCurso ?> </title>
    <link rel="stylesheet" href="../../../../css/mural.css">
    <link rel="icon" href="../../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../../../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../../../usuario.php?i=<?php echo $idAluno; ?>">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>

    <div class="container-admin">
    <h2>Curso "<?php echo $nomeCurso?>" - Turma "<?php echo $turma?>"</h2>
    <h3>Professor: <?php echo $nomeProfessor?></h3>
    <h3>Alunos</h3>
    <br>
    <p><a href="create.php?i=<?php echo $idAluno; ?>&c=<?php echo $idCurso; ?>&t=<?php echo $idTurma; ?>" class="incluir">Incluir</a></p>
    
    <div class="info_data_container">
        <div class="info_data_titulo">
            Quantidade de alunos
        </div>
        <div class="info_caixa">
            <div class="total">
                Total: <?php echo $info_total ?>
            </div>
            <div class="info_17">
                Até 17 anos: <?php echo $info_17 ?>
            </div>
            <div class="info_18_59">
                Entre 18 a 59 anos: <?php echo $info_18_59 ?>
            </div>
            <div class="info_60">
                Acima de 60 anos: <?php echo $info_60 ?>
            </div>
            <div class="info_masculino">
                Masculino: <?php echo $info_masculino ?>
            </div>
            <div class="info_feminino">
                Feminino: <?php  echo $info_feminino ?>
            </div>
            <div class="info_outro_genero">
                Outro gênero: <?php echo $info_outro_genero ?>
            </div>
            <div class="info_sim_pcd">
                PCD: <?php echo $info_sim_pcd ?>
            </div>
            <div class="info_nao_pcd">
                Não PCD: <?php echo $info_nao_pcd ?>
            </div>
        </div>
    </div>
    
    <table border="0" class="tabela-admin">
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Nome</center></td>
            <td><center>Sexo</center></td>
            <td><center>Email</center></td>
            <td><center>Telefone</center></td>
            <td><center>Nascimento</center></td>
            <td><center>RG</center></td>
            <td><center>CPF</center></td>
            <td><center>login</center></td>
            <td><center>senha</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
        <?php
        $sql_2 = "SELECT * FROM aluno_has_turma";
        $result_2 = mysqli_query($link, $sql_2);
        while($row = mysqli_fetch_array($result_2)){
            if($idTurma == $row['turma_id']){
                $alunoTurma = $row['aluno_id'];

            $sql_3 = "SELECT * FROM aluno";
            $result_3 = mysqli_query($link, $sql_3);
            while($row = mysqli_fetch_array($result_3)){
                if($alunoTurma == $row['id']){
                        ?>
        <tr class="tabela-linha">
            <!--<td><?php //echo($row['id'])?></td>-->
            <td><?php echo($row['nome_completo']);?></td>
            <td><?php echo($row['sexo']);?></td>
            <td><?php echo($row['email']);?></td>
            <td><?php echo($row['telefone']);?></td>
            <td><?php echo(date("d/m/Y", strtotime($row['nascimento'])));?></td>
            <td><?php echo($row['rg']);?></td>
            <td><?php echo($row['cpf']);?></td>
            <td><?php echo($row['login']);?></td>
            <td><?php echo($row['senha']);?></td>
            <td><?php echo('<a href="read.php?id='.$row['id'].'&i='.$idAluno.'&t='.$idTurma.'&c='.$idCurso.'" class="crud_link">Exibir</a>')?></td>
            <td><?php echo('<a href="update.php?id='.$row['id'].'&i='.$idAluno.'&t='.$idTurma.'&c='.$idCurso.'" class="crud_link">Alterar</a>')?></td>
            <td><?php echo('<a href="delete.php?id='.$row['id'].'&i='.$idAluno.'&t='.$idTurma.'&c='.$idCurso.'" class="crud_link">Excluir</a>')?></td>
        </tr>
        <?php }
            }
        }
    } ?>
    </table>
    </div>
    <div class="voltar">
        <p><a href='../index.php?i=<?php echo $idAluno; ?>&c=<?php echo($idCurso)?>'>Voltar</a></p>
    </div>
</div>

</body>
</html>