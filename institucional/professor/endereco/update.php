<?php 
        require_once "../../../util/config.php";
        $idAluno = $_GET['i'];
        if($_GET['id']){
            $id = $_GET['id'];
            $sql_1 = "SELECT * FROM endereco WHERE id = ?";
            $stmt_1 = mysqli_prepare($link, $sql_1);
            mysqli_stmt_bind_param($stmt_1, "i", $id);
            mysqli_stmt_execute($stmt_1);
            $result_1 = mysqli_stmt_get_result($stmt_1);
            $row = mysqli_fetch_array($result_1);
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){        
            $logradouro = $_POST["logradouro"];
            $numero = $_POST["numero"];
            $complemento = $_POST["complemento"];
            $bairro = $_POST["bairro"];
            $cep = $_POST["cep"];
            $cidade = $_POST["cidade"];
            $estado = $_POST["estado"];
            $id = $_POST["id"];
            $sql = "UPDATE endereco SET logradouro = ?, numero = ?, complemento = ?, bairro = ?, cep = ?, cidade = ?, estado = ? WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "sssssssi", $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $estado, $id);

            if (mysqli_stmt_execute($stmt)) {
                echo "Registro atualizado com sucesso.";
            } else {  
                echo "Erro na atualização: " . mysqli_error($link);
            }
    
            mysqli_stmt_close($stmt);
        }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Endereço</title>
        <link rel="stylesheet" href="../../../css/mural.css">
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
<div class="container-admin">
    <h2>Alteração de Endereço</h2>
    <form method="post" action="update.php?i=<?php echo $idAluno; ?>&id=<?php echo $id ?>">
        <p>Logradouro: <input type="text" name="logradouro" value="<?php echo $row['logradouro'] ?>"></p>
        <p>Número: <input type="text" name="numero" value="<?php echo $row['numero'] ?>"></p>
        <p>Complemento: <input type="text" name="complemento" value="<?php echo $row['complemento'] ?>"></p>
        <p>Bairro: <input type="text" name="bairro" value="<?php echo $row['bairro'] ?>"></p>
        <p>CEP: <input type="text" name="cep" value="<?php echo $row['cep'] ?>"></p>
        <p>Cidade: <input type="text" name="cidade" value="<?php echo $row['cidade'] ?>"></p>
        <p>Estado: <input type="text" name="estado" value="<?php echo $row['estado'] ?>"></p>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <p><input type="submit" class="botao_funcionario" value="Alterar"></p>
    </form>

</div>
<div class="voltar">
        <p><a href='index.php?i=<?php echo $idAluno; ?>&id=<?php echo $id; ?>'>Voltar</a></p>
    </div>
    </body>
    </html>