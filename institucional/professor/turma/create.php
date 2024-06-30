<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Turma</title>
    <link rel="stylesheet" type="text/css" href="../../../css/cad_funcionario.css" />
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

    <!-- INÍCIO PHP -->
    <?php

    session_start();
    require_once "../../../util/config.php";

    if ($_SESSION != null){
    $idAdmin = $_SESSION['idAdmin'];
    $idProfessor = $_GET['p'];

    $sql_end_2 = "SELECT * FROM professor";
    $result_2 = mysqli_query($link, $sql_end_2);
    while($row = mysqli_fetch_array($result_2)){
        if($row['id_professor'] == $idProfessor){
            $nomeProfessor = $row['nome_completo'];
        }
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $professor = $idProfessor;
        $turma = $_POST['turma'];

        $sql = "INSERT INTO professor_turma (professor_id, turma_id) VALUES(?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $professor, $turma);

        if (mysqli_stmt_execute($stmt)) {
            "Curso cadastrado com sucesso!";
        } else {
            "Erro ao cadastrar o curso: " . mysqli_error($link);
        }
    }

    ?>
        <!-- FIM PHP -->

<div class="container-geral">
<div class = "fundo">
        <div class = "area-matricula">
        <div class = "quadrado"> 
            <br>
            <br>
            <div class ="titulo">Cadastro de Turma</div>
            <div class ="texto">Professor: <?php echo $nomeProfessor ?></div>
            <div class ="formulario">
                <form method = "POST">
                    <div class = "cad">
                    <div class="input-selecao">
                        <select name="turma">
                        <?php
                            $sql_end_3 = "SELECT * FROM curso";
                            $result_3 = mysqli_query($link, $sql_end_3);
                            while($row = mysqli_fetch_array($result_3)){
                                $idCurso = $row['id_curso'];
                                $nomeCurso = $row['nome'];
                                $sql_end_4 = "SELECT * FROM turma";
                                $result_4 = mysqli_query($link, $sql_end_4);
                                while($row = mysqli_fetch_array($result_4)){
                                    if($row['curso_id_curso'] == $idCurso){
                                        $idTurma = $row['id'];
                        ?>
                            <option value="<?php echo $idTurma; ?>"><?php echo $row['codigo'] . ' - ' . $nomeCurso;  ?></option>
                        <?php       }
                                 }
                            } ?>
                        </select>
                    </div>

                    <!-- Botão de salvar -->
                    <button type="submit" id="botao-cadastrar">Cadastrar</button>

                    
                    </div>
                    <div class="voltar">
        <p><a href='index.php?p=<?php echo $idProfessor; ?>'>Voltar</a></p>
    </div>
                </form>
            </div>
        </div>   
        </div>   
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