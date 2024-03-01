<?php

session_start();
require_once "../../util/config.php";

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

    if (mysqli_stmt_execute($stmt_end)) {
        "Curso cadastrado com sucesso!";
    } else {
        "Erro ao cadastrar o curso: " . mysqli_error($link);
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
	$genero = $_POST["genero"];
	$email = $_POST["email"];
    $telefone = $_POST["telefone"];
	$nascimento = $_POST["nascimento"];

    $dataNascimento = new DateTime($_POST['nascimento']);
    $dataAtual = new DateTime();
    $diferenca = $dataAtual->diff($dataNascimento);
    $idade = $diferenca->y;

	$rg = $_POST["rg"]; 
	$cpf = $_POST["cpf"]; 
	$pcd = $_POST["pcd"];
	$pcd_desc = $_POST["pcd_desc"];
	$login = $_POST["login"];
	$senha = $_POST["senha"];

    $sql_aluno = "INSERT INTO aluno (nome_completo, nome, sobrenome, sexo, email, telefone, nascimento, idade, rg, cpf, pcd, pcd_desc, login, senha, endereco_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_aluno = mysqli_prepare($link, $sql_aluno);
    
    if ($stmt_aluno) {
        mysqli_stmt_bind_param($stmt_aluno, "sssssssississsi", $nome_completo, $nome, $sobrenome, $genero, $email, $telefone, $nascimento, $idade, $rg, $cpf, $pcd, $pcd_desc, $login, $senha, $endereco_id);
    
        if (mysqli_stmt_execute($stmt_aluno)) {
            echo "Aluno cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o aluno: " . mysqli_error($link);
        }
    
        mysqli_stmt_close($stmt_aluno);
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
    <title>Cadastro de Aluno</title>
    <link rel="stylesheet" type="text/css" href="../../css/cad_aluno.css" />
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
<div class="container-geral">
<div class = "fundo">
        <div class = "area">
        <div class = "quadrado"> 
            <br>
            <br>
            <div class ="titulo">Cadastro do Aluno</div>
            <div class ="texto">Preencha os dados</div>
            <div class ="formulario">
                <form method = "POST">
                    <div class = "cad">
                    <div class = "input-cad"><input type = "text" name = "nome_completo" placeholder = "Nome completo"></div>
                    <label for="genero">Gênero</label>
                    <select class="input-selecao" id="genero" name="genero">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="N">Outro gênero</option>
                    </select><br><br>
                    </div>
                  
                    <div class = "input-cad"><input type = "email" name = "email" placeholder = "Informe seu email"></div>
                    <label class="nascimento">Data de nascimento:</label>
                    <div class = "input-cad" id="nascimento"><input type = "date" name = "nascimento" placeholder = "Data de nascimento"></div> 
                    <div class = "input-cad" id="telefone"><input type = "telefone" name = "telefone" placeholder = "Telefone"></div> 
                    <div class = "input-cad"><input type = "rg" name = "rg" placeholder = "Digite o seu RG"></div> 
                    <div class = "input-cad"><input type = "cpf" name = "cpf" placeholder = "Digite o seu CPF"></div>                  
                    </div>
                 <br>
                    <label for="PCD">PCD?</label>
                    <select class="input-selecao" id="pcd" name="pcd">
                    <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select><br>
                    <div class = "input-end"><input type = "text" name = "pcd_desc" placeholder = "Descreva se sim"></div>
                 <br><br>
                    <div class ="texto">Endereço</div>
                    <div class = "end">
                    <div class = "input-end"><input type = "text" name = "logradouro" placeholder = "Logradouro"></div> 
                    <div class = "input-end"><input type = "text" name = "numero" placeholder = "Numero"></div>
                    <div class = "input-end"><input type = "text" name = "bairro" placeholder = "Bairro"></div>
                    <div class = "input-end"><input type = "text" name = "cep" placeholder = "Cep"></div>
                    <div class = "input-end"><input type = "text" name = "complemento" placeholder = "Complemento"></div>
                    <div class = "input-end"><input type = "text" name = "cidade" placeholder = "Cidade"></div>
                    <div class = "input-end"><input type = "text" name = "estado" placeholder = "Estado"></div> 
                 <br>
                    <div class ="texto">Login</div>
                    <div class = "input-cad"><input type = "login" name = "login" placeholder = "Crie um login"></div>
                    <div class = "input-cad"><input type = "senha" name = "senha" placeholder = "Crie a senha"></div>
                    <!-- Botão de salvar -->
                    <button type="submit" id="botao-cadastrar">Cadastrar</button>

                    
                    </div>
                    <div class="voltar">
    <p><a href='index.php?i=<?php echo $idAluno; ?>'>Voltar</a></p>
</div>
                </form>
            </div>
        </div>   
        </div>   
    </div>
</div>   
</body>
</html>