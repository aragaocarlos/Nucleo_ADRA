<?php 
        require_once "../../util/config.php";
        $idAluno = $_GET['i'];
        if($_GET['id']){
            $id = $_GET['id'];
            $sql = "SELECT * FROM curso WHERE id_curso = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){        
            $nome = $_POST["nome"];
            $sigla = $_POST["sigla"];
            $descricao = $_POST["descricao"];
            $area = $_POST["area"];
            $ch = $_POST["ch"];
            $periodo = $_POST["periodo"];
            $curso_inicio = $_POST["curso_inicio"];
            $curso_fim = $_POST["curso_fim"];
            $hora_inicio = $_POST["hora_inicio"];
            $hora_fim = $_POST["hora_fim"];
            $valor = $_POST["valor"];
            $id = $_POST["id_curso"];
            $sql = "UPDATE produtos SET nome = ?, sigla = ?, descricao = ?, area = ?, ch = ?, periodo = ?, curso_inicio = ?, curso_fim = ?, hora_inicio = ?, hora_fim = ?, valor = ? WHERE id_curso = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "sssssissss", $nome, $sigla, $descricao, $area, $ch, $periodo, $curso_inicio, $curso_fim, $hora_inicio, $hora_fim, $valor);
            if(mysqli_stmt_execute($stmt)){
                header('location: index.php');
                exit;
            } else {
                echo "Ocorreu um erro";
            }
        }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Cursos</title>
        <link rel="stylesheet" href="../../css/mural.css">
    </head>
    <body>
<header>
    <main>
        <div class="cabecalho-conteudo">
            <a href="../administrador.php?i=<?php echo $idAluno; ?>">
            <div id="logo" class="opcoes-nav">
                <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
            </div>
            </a>
            <div id="perfil" class="opcoes-nav">
            </div>
        </div>
    </main>
</header>
<div class="container-admin">
    <h2>Alterar Cursos</h2>
    <form method="post" action="update.php">
        <p>Nome: <input type="text" name="nome" value="<?php echo $row['nome'] ?>"></p>
        <p>sigla: <input type="text" name="sigla" value="<?php echo $row['sigla'] ?>"></p>
        <p>descricao: <input type="text" name="descricao" value="<?php echo $row['descricao'] ?>"></p>
        <p>area: <input type="text" name="area" value="<?php echo $row['area'] ?>"></p>
        <p>ch: <input type="text" name="ch" value="<?php echo $row['ch'] ?>"></p>
        <p>periodo: <input type="text" name="periodo" value="<?php echo $row['periodo'] ?>"></p>
        <p>curso_inicio: <input type="text" name="curso_inicio" value="<?php echo $row['curso_inicio'] ?>"></p>
        <p>curso_fim: <input type="text" name="curso_fim" value="<?php echo $row['curso_fim'] ?>"></p>
        <p>hora_inicio: <input type="text" name="hora_inicio" value="<?php echo $row['hora_inicio'] ?>"></p>
        <input type="hidden" name="id" value="<?php echo $row['id_curso'] ?>">
        <p><input type="submit" class="botao_funcionario" value="Alterar"></p>
    </form>

</div>
<div class="voltar">
    <p><a href='index.php?i=<?php echo $idAluno; ?>'>Voltar</a></p>
</div>
    </body>
    </html>