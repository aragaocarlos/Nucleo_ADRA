<?php 

session_start();
require_once "../../../util/config.php";

$idAluno = $_GET['i'];
$idCurso = $_GET['c'];

$sql_1 = "SELECT * FROM curso";
$result_1 = mysqli_query($link, $sql_1);
while($row = mysqli_fetch_array($result_1)){
    if($idCurso == $row['id_curso']){
        $nomeCurso = $row['nome'];
    }
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$codigo = $_POST['codigo'];
    $curso = $idCurso;
    $sala = $_POST['sala'];

	$sql = "INSERT INTO turma (codigo, curso_id_curso, sala) VALUES (?,?,?)";
	$stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sis", $codigo, $curso, $sala);
        if (mysqli_stmt_execute($stmt)) {
            echo "Curso cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o curso: " . mysqli_error($link);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da declaração: " . mysqli_error($link);
    }

    mysqli_close($link);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Curso</title>
    <link rel="stylesheet" type="text/css" href="../../../css/cad_funcionario.css" />
    <link rel="icon" href="../../../imagens/nucleo-adra-icone.png" >
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../../administrador.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="../../usuario.php?i=<?php echo $idAluno; ?>">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>  

<div class="container-geral">
<div class = "fundo">
        <div class = "area">
        <div class = "quadrado">
            <div class ="titulo">Cadastro de Turma</div>
            <div class ="texto">Curso "<?php echo $nomeCurso;?>"</div>
            <form method = "POST">
                <div class = "cad">
                <div class="input-selecao">
                        <select name="codigo">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class = "input-cad"><input type="text" id="sala" name="sala" placeholder = "Sala"></div>

                    <button type="submit" id="botao-cadastrar">Cadastrar</button>
                    </div>
                    <div class="voltar">
                        <p><a href='index.php?i=<?php echo $idAluno; ?>&c=<?php echo $idCurso; ?>'>Voltar</a></p>
                    </div>
                </form>
        </div>

        </div>
</div>
</div>
</body>
</html>