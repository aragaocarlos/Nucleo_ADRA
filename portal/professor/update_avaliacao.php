<?php 
        require_once "../../util/config.php";
        $idProfessor = $_GET['i'];
        $idTurma = $_GET['t'];
        $idCurso = $_GET['c'];
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Cursos</title>
        <link rel="stylesheet" href="../../css/mural.css">
        <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
    </head>
    <body>
<header>
    <main>
        <div class="cabecalho-conteudo">
            <a href="../../institucional/administrador.php?i=<?php echo $idProfessor; ?>">
            <div id="logo" class="opcoes-nav">
                <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
            </div>
            </a>
            <a href="usuario.php?i=<?php echo $idProfessor; ?>">
                <div id="perfil" class="opcoes-nav">
                <?php
                $sql_perfil = "SELECT * FROM professor";
                $result_perfil = mysqli_query($link, $sql_perfil);
                while ($row = mysqli_fetch_array($result_perfil)) {
                    if($row['id_professor'] == $idProfessor){
                        if (!empty($row['imagem'])) {
                                    // Decodifica o texto em base64
                                    $imagemDecodificada = base64_decode($row['imagem']);

                                    // Determina o tipo de conteúdo da imagem
                                    $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecodificada, FILEINFO_MIME_TYPE);

                                    // Gera um URI de dados para a imagem
                                    $imagemDataUri = "data:$tipoConteudo;base64," . base64_encode($imagemDecodificada);

                                    // Exibe a imagem usando a tag <img>
                                    echo "<img src='$imagemDataUri' alt=''>";
                        } else {
                            echo '<img src="../../imagens/perfil-branco-200px.png" alt="">';
                        }
                        }
                    }
                        ?>
                </div>
            </a>
        </div>
    </main>
</header>
<?php
        if($_GET['a']){
            $idAluno = $_GET['a'];
            $sql_aluno = "SELECT * FROM aluno";
            $result_aluno = mysqli_query($link, $sql_aluno);
            while($row = mysqli_fetch_array($result_aluno)){
                if($row['id'] == $idAluno){
                    $nomeAluno = $row['nome_completo'];
                }
            }
        }

        if($_GET['id']){
            $id = $_GET['id'];
            $sql = "SELECT * FROM avaliacao WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){        
            $n1 = $_POST["n1"];
            $n2 = $_POST["n2"];
            $n3 = $_POST["n3"];
            $faltas = $_POST["faltas"];

            $mediaNota = ($_POST["n1"] + $_POST["n2"] + $_POST["n3"])/3;
            if($mediaNota >= 7){
                $situacao = "APROVADO";
            }else{
                $situacao = "REPROVADO";
            }

            $id = $_POST["id"];
            $sql = "UPDATE avaliacao SET n1 = ?, n2 = ?, n3 = ?, faltas = ?, situacao = ? WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "dddisi", $n1, $n2, $n3, $faltas, $situacao, $id);
    
            if (mysqli_stmt_execute($stmt)) {
                echo "Registro atualizado com sucesso.";
            } else {
                echo "Erro na atualização: " . mysqli_error($link);
            }
    
            mysqli_stmt_close($stmt);
        }
?>
<div class="container-admin">
    <h2>Fazer avaliação</h2>
    <h3>Aluno: <?php echo $nomeAluno ?></h3>
    <form method="post" action="">
        <p>N1: <input type="text" name="n1" value="<?php echo $row['n1'] ?>"></p>
        <p>N2: <input type="text" name="n2" value="<?php echo $row['n2'] ?>"></p>
        <p>N3: <input type="text" name="n3" value="<?php echo $row['n3'] ?>"></p>
        <p>Faltas: <input type="text" name="faltas" value="<?php echo $row['faltas'] ?>"></p>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <p><input type="submit" class="botao_funcionario" value="Salvar"></p>
    </form>

</div>
<div class="voltar">
    <p><a href='avaliacao.php?i=<?php echo $idProfessor; ?>&c=<?php echo $idCurso; ?>&t=<?php echo $idTurma; ?>'>Voltar</a></p>
</div>
    </body>
    </html>