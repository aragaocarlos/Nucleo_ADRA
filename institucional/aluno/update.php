<?php 
        require_once "../../util/config.php";
        $idAluno = $_GET['i'];
        if($_GET['id']){
            $id = $_GET['id'];
            $sql = "SELECT * FROM aluno WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);
        }
        if($_SERVER['REQUEST_METHOD'] == "POST"){        
            $nome_completo = $_POST["nome_completo"];

            // Divide nome completo em nome e sobrenome
            $partes = explode(' ', $nome_completo);
            $ultimo_valor = count($partes)-1;

            $nome = $partes[0];
            $sobrenome = $partes[$ultimo_valor];
            $sexo = $_POST["sexo"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];
            $nascimento = date("Y-m-d", strtotime($_POST["nascimento"]));

            $dataNascimento = new DateTime($nascimento);
            $dataAtual = new DateTime();
            $diferenca = $dataAtual->diff($dataNascimento);
            $idade = $diferenca->y;

            $rg = $_POST["rg"];
            $cpf = $_POST["cpf"];
            $pcd = $_POST["pcd"];
            $pcd_desc = $_POST["pcd_desc"];
            $login = $_POST["login"];
            $senha = $_POST["senha"];
            $id = $_POST["id"];
            $sql = "UPDATE aluno SET nome_completo = ?, nome = ?, sobrenome = ?, sexo = ?, email = ?, telefone = ?, nascimento = ?, idade = ?, rg = ?, cpf = ?, pcd = ?, pcd_desc = ?, login = ?, senha = ? WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "sssssssississsi", $nome_completo, $nome, $sobrenome, $sexo, $email, $telefone, $nascimento, $idade, $rg, $cpf, $pcd, $pcd_desc, $login, $senha, $id);

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
        <title>Alterar Alunos</title>
        <link rel="stylesheet" href="../../css/mural.css">
        <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
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
            <a href="../usuario.php?i=<?php echo $idAluno; ?>">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
        </div>
    </main>
</header>
<div class="container-admin">
    <h2>Alteração de Alunos</h2>
    <form method="post" action="update.php?i=<?php echo $idAluno; ?>&id=<?php echo $id ?>">
        <p>Nome: <input type="text" name="nome_completo" value="<?php echo $row['nome_completo'] ?>"></p>
        <p>Sexo: <input type="text" name="sexo" value="<?php echo $row['sexo'] ?>"></p>
        <p>Email: <input type="text" name="email" value="<?php echo $row['email'] ?>"></p>
        <p>Telefone: <input type="text" name="telefone" value="<?php echo $row['telefone'] ?>"></p>
        <p>Nascimento: <input type="text" name="nascimento" value="<?php echo(date("d/m/Y", strtotime($row['nascimento']))) ?>"></p>
        <p>RG: <input type="text" name="rg" value="<?php echo $row['rg'] ?>"></p>
        <p>CPF: <input type="text" name="cpf" value="<?php echo $row['cpf'] ?>"></p>
        <p>PCD: <select name="pcd">
                    <?php
                                        if($row['pcd'] == 1){
                                            $pcdValor = 1;
                                            $pcdValorOposto = 0;
                                            $pcdString = 'Sim';
                                            $pcdStringOposto = 'Não';
                                        } else{
                                            $pcdValor = 0;
                                            $pcdValorOposto = 1;
                                            $pcdString = 'Não';
                                            $pcdStringOposto = 'Sim';
                                        } 
                    ?>
                    <option value="<?php echo $pcdValor; ?>"><?php echo $pcdString; ?></option>
                    <option value="<?php echo $pcdValorOposto; ?>"><?php echo $pcdStringOposto; ?></option>
                </select></p>
        <p>PCD Tipo: <input type="text" name="pcd_desc" value="<?php echo $row['pcd_desc'] ?>"></p>
        <p>Login: <input type="text" name="login" value="<?php echo $row['login'] ?>"></p>
        <p>Senha: <input type="text" name="senha" value="<?php echo $row['senha'] ?>"></p>
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <p><input type="submit" class="botao_funcionario" value="Alterar"></p>
    </form>

</div>
<div class="voltar">
    <p><a href='index.php?i=<?php echo $idAluno; ?>'>Voltar</a></p>
</div>
    </body>
    </html>