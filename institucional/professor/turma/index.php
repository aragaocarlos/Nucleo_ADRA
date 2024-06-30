<?php
    require_once "../../../util/config.php";
    session_start();

    if ($_SESSION != null){
    $idAdmin = $_SESSION['idAdmin'];
    $idProfessor = $_GET['p'];

    $sql_1 = "SELECT * FROM professor";
    $result_1 = mysqli_query($link, $sql_1);
    while($row = mysqli_fetch_array($result_1)){
        if($row['id_professor'] == $idProfessor){
            $nomeProfessor = $row['nome_completo'];
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas do Professor</title>
    <link rel="stylesheet" href="../../../css/mural.css">
    <link rel="icon" href="../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../../administrador.php?i=<?php echo $idAdmin; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../../usuario.php?i=<?php echo $idAdmin; ?>">
                    <div id="perfil" class="opcoes-nav">
                    <?php
                        echo "<img src='$imagemDataUri' alt=''>";
                        ?>
                    </div>
                </a>
            </div>
        </main>
    </header>

<div class="container-admin">
<h2>Professor: <?php echo $nomeProfessor?></h2>
    <h3>Turmas</h3>
    <br>
    <p><a href="create.php?p=<?php echo $idProfessor; ?>" class="incluir">Incluir</a></p>
    <br>
    <?php 
        $sql_1 = "SELECT * FROM professor_turma";
        $result_1 = mysqli_query($link, $sql_1);
        while($row = mysqli_fetch_array($result_1)){
            if($row['professor_id'] == $idProfessor){
                $idTurma = $row['turma_id'];
                $sql_2 = "SELECT * FROM turma";
                $result_2 = mysqli_query($link, $sql_2);
                while($row = mysqli_fetch_array($result_2)){
                    if($row['id'] == $idTurma){
                        $codigo = $row['codigo'];
                        $sala = $row['sala'];
                        $idCurso = $row['curso_id_curso'];
                        $sql_3 = "SELECT * FROM curso";
                        $result_3 = mysqli_query($link, $sql_3);
                        while($row = mysqli_fetch_array($result_3)){
                            if($row['id_curso'] == $idCurso){
                                $nomeCurso = $row['nome'];
    ?>
    <table border="0" class="tabela-admin">
        <h3>Curso "<?php echo $nomeCurso ?>"</h3>
        <tr class="tabela-titulo">
            <!--<td>Id</td>-->
            <td><center>Turma</center></td>
            <td><center>Sala</center></td>
            <td colspan="4"><center>Ações</center></td>
        </tr>
            <tr class="tabela-linha">
                <td><?php echo $codigo ?></td>
                <td><?php echo $sala ?></td>
            </div>
            <td><?php echo('<a href="delete.php?id='.$idTurma.'&p='.$idProfessor.'" class="crud_link">Excluir</a>')?></td>
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
    <div class="voltar">
        <p><a href='../index.php'>Voltar</a></p>
    </div>
</div>
<?php
} else{
// Redirecionamento de volta para a página anterior
header("Location: ../../../index.php");
exit(); // Certifique-se de sair após o redirecionamento
}?>
</body>
</html>