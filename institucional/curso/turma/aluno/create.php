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

?>
    
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <link rel="stylesheet" type="text/css" href="../../../../css/cad_funcionario.css" />
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div id="perfil" class="opcoes-nav">
                </div>
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
                        <select name="sexo">
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
                </form>
            </div>
        </div>   
        </div>   
    </div>
</div>   
</body>
</html>