<?php 
        require_once "../../../util/config.php";
        session_start();

        $idAdmin = $_SESSION['idAdmin'];
        $idCurso = $_GET['c'];
        
        $sql_1 = "SELECT * FROM curso";
        $result_1 = mysqli_query($link, $sql_1);
        while($row = mysqli_fetch_array($result_1)){
            if($idCurso == $row['id_curso']){
                $nomeCurso = $row['nome'];
            }
        }

        if($_GET['id']){
            $id = $_GET['id'];
            $sql = "SELECT * FROM turma WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){        
            $codigo = $_POST["codigo"];
            $sala = $_POST["sala"];
            $id = $_POST["id"];
            $sql = "UPDATE turma SET codigo = ?, sala = ? WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "ssi", $codigo, $sala, $id);
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
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Turmas</title>
        <link rel="stylesheet" href="../../../css/mural.css">
        <link rel="icon" href="../../../imagens/nucleo-adra-icone.png" >
    </head>
    <body>
<header>
    <main>
        <div class="cabecalho-conteudo">
            <a href="../../administrador.php">
            <div id="logo" class="opcoes-nav">
                <img src="../../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
            </div>
            </a>
            <a href="../../usuario.php">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
        </div>
    </main>
</header>
<div class="container-admin">
<h2>Curso "<?php echo $nomeCurso ?>"</h2>
    <h3>Alterar Turma</h3>
    <br>
    <form method="post" action="update.php?id=<?php echo $id ?>&c=<?php echo $idCurso ?>">
        <p>Turma: <input type="text" name="codigo" value="<?php echo $row['codigo'] ?>"></p>
        <p>Sala: <input type="text" name="sala" value="<?php echo $row['sala'] ?>"></p>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <p><input type="submit" class="botao_funcionario" value="Alterar"></p>
    </form>

</div>
<div class="voltar">
    <p><a href='index.php?c=<?php echo $idCurso; ?>'>Voltar</a></p>
</div>
    </body>
    </html>