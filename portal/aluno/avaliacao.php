<?php
    session_start();
    require_once "../../util/config.php";

    if ($_SESSION != null){

    $idTurma = $_GET['t'];
    $idCurso = $_GET['c'];

    $idAluno = $_SESSION['idAluno'];
    $sql = "SELECT * FROM aluno";
    $result = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($result)){
        if($row['id'] == $idAluno){
            $nomeAluno = $row['nome'];
            $sobrenomeAluno = $row['sobrenome'];
        }
    }

    $sql = "SELECT * FROM avaliacao";
    $result = mysqli_query($link, $sql);
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
                <a href="atividade.php?c=<?php echo $idCurso ?>&t=<?php echo $idTurma; ?>">
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
                <a href="usuario.php?i=<?php echo $idAluno; ?>">
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
                <td><center>Unidade 1</center></td>
                <td><center>Unidade 2</center></td>
                <td><center>Unidade 3</center></td>
                <td><center>Faltas</center></td>
                <td><center>Situação</center></td>
                
            </tr>
            <?php
            while($row = mysqli_fetch_array($result)){
                if($row['turma_id'] == $idTurma){
                    if($idAluno == $row['aluno_id']){
            ?>
            <tr class="tabela-linha">
                <td><?php echo $row['n1'];?></td>
                <td><?php echo $row['n2'];?></td>
                <td><?php echo $row['n3']; ?></td>
                <td><?php echo $row['faltas']; ?></td>
                <td><?php echo $row['situacao'];?></td>
            </tr>
            <?php
                    }
                }
                }
    ?>
        </table>
    </div>

</div>
<?php
} else{
// Redirecionamento de volta para a página anterior
header("Location: ../aluno.php");
exit(); // Certifique-se de sair após o redirecionamento
}?>
</body>
</html>