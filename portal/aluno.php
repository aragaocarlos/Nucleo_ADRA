<?php
    session_start();
    unset($_SESSION['msg']);
    require_once ".././util/config.php";
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = "SELECT * FROM aluno WHERE email = ? AND senha = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $senha);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
        if(mysqli_num_rows($result) > 0){
            header("location: ./aluno/curso.php?i=" . $row['id']);
            $_SESSION['email'] = $row['email'];
            $_SESSION['senha'] = $row['senha'];
        }else{
            $_SESSION['msg'] = "Usuario ou senha inválido";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal do Aluno</title>
    <link rel="stylesheet" type="text/css" href=".././css/login-estilo.css" />
</head>
<body>
    <div class="fundo-aluno">
        <div class="area-aluno">
        <div class="quadrado-aluno">
            <div class="logo"><img src=".././imagens/nucleo-adra-branco.png"></div>
            <div class="titulo-aluno">Portal do Aluno</div>
            <div class="texto">Seja bem vindo.</div>
            <div class="texto">Faça login para ter acesso a sua conta.</div>
            <div class="formulario">
            <form method="POST">
                <div class="login">
                    <div class="input-login"><input type="text" name="email" placeholder="Informe seu e-mail"></div>
                    <div class="input-login"><input type="password" name="senha" placeholder="Senha"></div>
                    <button type="submit" id="botao-aluno">Entrar</button>
                </div>
                    <?php
                              if (isset($_SESSION['msg']) == true) {
                                echo "<div class='aviso'>";
                                echo $_SESSION['msg'];
                                echo "</div>";
                              }
                    ?>
            </form>
            </div>
            <div class="aba-institucional">
                <a href=".././portal/professor.php"><div class="portal-institucional">
                    <div class="texto-institucional">
                        Ir para o Portal do Professor
                    </div>
                </div></a>
            </div>
        </div>
        </div>
    </div>
</body>
</html>