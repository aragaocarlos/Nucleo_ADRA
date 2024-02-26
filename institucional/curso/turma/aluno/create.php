<?php

session_start();
require_once "../../../../util/config.php";

$idAluno = $_GET['i'];

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$logradouro = $_POST["logradouro"];
	$numero = $_POST["numero"];
	$complemento =  $_POST["complemento"];
	$bairro = $_POST["bairro"];
	$cep = $_POST["cep"];
	$cidade = $_POST["cidade"];
	$estado = $_POST["estado"];

	$sql_end_1 = "INSERT INTO endereco (logradouro, numero, complemento, bairro, cep, cidade, estado) VALUES(?, ?, ?, ?, ?, ?, ?)";
	$stmt_end = mysqli_prepare($link, $sql_end_1);
	mysqli_stmt_bind_param($stmt_end, "sssssss", $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $estado);

	if(mysqli_stmt_execute($stmt_end)){
		$_SESSION['msg'] = "Endereço cadastrado com sucesso";
		$_SESSION['msg'] = "Erro no cadastro do endereço";
	}

    // Compara endereço cadastrado com o banco de dados para obter id
    $sql_end_2 = "SELECT * FROM endereco";
    $result = mysqli_query($link, $sql_end_2);
	while($row = mysqli_fetch_array($result)){
	if($logradouro == $_POST["logradouro"])
		$endereco_id = $row['id'];
	}

	$nome_completo = $_POST["nome_completo"];

    // Divide nome completo em nome e sobrenome
	$partes = explode(' ', $nome_completo);
	$ultimo_valor = count($partes)-1;

	$nome = $partes[0];
	$sobrenome = $partes[$ultimo_valor];
	$sexo = $_POST["sexo"];
	$email = $_POST["email"];
	$nascimento = $_POST["nascimento"];
	$rg = $_POST["rg"]; 
	$cpf = $_POST["cpf"]; 
	$pcd = $_POST["pcd"];
	$pcd_desc = $_POST["pcd_desc"];
	$login = $_POST["login"];
	$senha = $_POST["senha"];

	$sql_aluno = "INSERT INTO aluno (nome_completo, nome, sobrenome, sexo, email, nascimento, rg, cpf, pcd, pcd_desc, login, senha, endereco_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$stmt_aluno = mysqli_prepare($link, $sql_aluno);
	mysqli_stmt_bind_param($stmt_aluno, "ssssssssisssi", $nome_completo, $nome, $sobrenome, $sexo, $email, $nascimento, $rg, $cpf, $pcd, $pcd_desc, $login, $senha, $endereco_id);

	if(mysqli_stmt_execute($stmt_aluno)){
		$_SESSION['msg'] = "Aluno cadastrado com sucesso";
		$_SESSION['msg'] = "Erro no cadastro do aluno";
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
            <div class ="texto">Turma TAL</div>
            <div class ="formulario">
                <form method = "POST">
                    <div class = "cad">
                    <div class="input-selecao">
                        <select name="sexo">
                            <option value="masculino">Alunos</option>
                            <option value="feminino">Feminino</option>
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