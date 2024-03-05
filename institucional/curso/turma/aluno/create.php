<?php

session_start();
require_once "../../../../util/config.php";

$idAluno = $_GET['i'];
$idCurso = $_GET['c'];
$idTurma = $_GET['t'];

$sql_end_2 = "SELECT * FROM turma";
$result_2 = mysqli_query($link, $sql_end_2);
while($row = mysqli_fetch_array($result_2)){
    if($row['id'] == $idTurma){
        $codigo = $row['codigo'];
    }
}

$sql_end_1 = "SELECT * FROM curso";
$result_1 = mysqli_query($link, $sql_end_1);
while($row = mysqli_fetch_array($result_1)){
    if($row['id_curso'] == $idCurso){
        $nomeCurso = $row['nome'];
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$aluno = $_POST['aluno'];
    $turma = $idTurma;

    $sql_avaliacao = "INSERT INTO avaliacao (aluno_id, turma_id) VALUES(?,?)";
	$stmt_avaliacao = mysqli_prepare($link, $sql_avaliacao);
	mysqli_stmt_bind_param($stmt_avaliacao, "ii", $aluno, $turma);

    if (mysqli_stmt_execute($stmt_avaliacao)) {
        "Curso cadastrado com sucesso!";
    } else {
        "Erro ao cadastrar o curso: " . mysqli_error($link);
    }

	$sql = "INSERT INTO aluno_has_turma (aluno_id, turma_id) VALUES(?, ?)";
	$stmt = mysqli_prepare($link, $sql);
	mysqli_stmt_bind_param($stmt, "ii", $aluno, $turma);

    if (mysqli_stmt_execute($stmt)) {
        echo "Aluno matriculado com sucesso!";
    } else {
        echo "Erro ao cadastrar o curso: " . mysqli_error($link);
    }
}

?>
    
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <link rel="stylesheet" type="text/css" href="../../../../css/cad_funcionario.css" />
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
<div class="container-geral">
<div class = "fundo">
        <div class = "area-matricula">
        <div class = "quadrado"> 
            <br>
            <br>
            <div class ="titulo">Matrícula do Aluno</div>
            <div class ="texto">Turma "<?php echo $codigo ?>" do curso <?php echo $nomeCurso ?></div>
            <div class ="formulario">
                <form method = "POST">
                    <div class = "cad">
                    <div class="input-selecao">
                        <select name="aluno">
                        <?php
                            $sql_end_3 = "SELECT * FROM aluno";
                            $result_3 = mysqli_query($link, $sql_end_3);
                            while($row = mysqli_fetch_array($result_3)){
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nome_completo']; ?></option>
                        <?php } ?>
                        </select>
                    </div>

                    <!-- Botão de salvar -->
                    <button type="submit" id="botao-cadastrar">Cadastrar</button>

                    
                    </div>
                    <div class="voltar">
        <p><a href='index.php?i=<?php echo $idAluno; ?>&c=<?php echo $idCurso; ?>&t=<?php echo $idTurma; ?>'>Voltar</a></p>
    </div>
                </form>
            </div>
        </div>   
        </div>   
    </div>
</div>   
</body>
</html>