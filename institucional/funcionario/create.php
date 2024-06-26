<?php
require_once "../../util/config.php";
session_start();

if ($_SESSION != null){
$idAdmin = $_SESSION['idAdmin'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST["nome"];
    $login = $_POST["login"];
    $senha =  $_POST["senha"];

    $sql = "INSERT INTO administracao (nome, login, senha) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $nome, $login, $senha);
        if (mysqli_stmt_execute($stmt)) {
            echo "Funcionário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o funcionário: " . mysqli_error($link);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionário</title>
    <link rel="stylesheet" type="text/css" href="../../css/cad_funcionario.css" />
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="../administrador.php?i=<?php echo $idAdmin; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <a href="usuario.php?i=<?php echo $idAdmin; ?>">
                    <div id="perfil" class="opcoes-nav">
                    <?php
                        echo "<img src='$imagemDataUri' alt=''>";
                        ?>
                    </div>
                </a>
            </div>
        </main>
    </header>
<div class="container-geral">
<div class = "fundo">
        <div class = "area">
        <div class = "quadrado"> 
            <div class ="titulo">Cadastro de Funcionário</div>
            <div class ="texto">Preencha os dados</div>
            <div class ="formulario">
                <form method = "POST">
                    <div class = "cad">
                    <div class = "input-cad"><input type = "text" name = "nome" placeholder = "Nome completo"></div>
                    <div class = "input-end"><input type = "text" name = "login" placeholder = "Login"></div>
                    <div class = "input-end"><input type = "text" name = "senha" placeholder = "Senha"></div> 
                    <!-- Botão de salvar -->
                    <button type="submit" id="botao-cadastrar">Cadastrar</button>
                    </div>
                    <div class="voltar">
                        <p><a href='index.php'>Voltar</a></p>
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
header("Location: ../../index.php");
exit(); // Certifique-se de sair após o redirecionamento
}?>  
</body>
</html>