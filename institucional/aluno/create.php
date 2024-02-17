<?php 
        require_once "../../util/config.php";
        $idAluno = $_GET['i'];
            $id = $_GET['id'];
            $sql = "SELECT * FROM aluno WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result);

        // Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nomeCompleto = $_POST["nome"];
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $nascimento = $_POST["data"];
    $rg = $_POST["rg"];
    $cpf = $_POST["cpf"];
    $pcd = isset($_POST["pcd"]) ? 1 : 0; // Assume 1 se a checkbox estiver marcada, 0 caso contrário
    $pcd_desc = $_POST["descricao_pcd"];
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $logradouro = $_POST["logradouro"];
    $numero = $_POST["numero"];
    $complemento = $_POST["complemento"];
    $bairro = $_POST["bairro"];
    $cep = $_POST["cep"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["uf"];
    $telefones = isset($_POST["telefones"]) ? $_POST["telefones"] : [];

    // Inicia uma transação
    $conexao->begin_transaction();

    try {
        // Inserir dados de endereço na tabela endereco
        $sql_endereco = "INSERT INTO endereco (logradouro, numero, complemento, bairro, cep, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_endereco = $conexao->prepare($sql_endereco);
        $stmt_endereco->bind_param("sssssss", $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $estado);
        $stmt_endereco->execute();
        $endereco_id = $stmt_endereco->insert_id;
        $stmt_endereco->close();

        // Inserir dados do aluno na tabela aluno
        $sql_aluno = "INSERT INTO aluno (nome_completo, nome, sobrenome, sexo, email, nascimento, rg, cpf, pcd, pcd_desc, login, senha, endereco_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_aluno = $conexao->prepare($sql_aluno);
        $stmt_aluno->bind_param("ssssssssisssi", $nomeCompleto, $nome, $sobrenome, $sexo, $email, $nascimento, $rg, $cpf, $pcd, $pcd_desc, $login, $senha, $endereco_id);
        $stmt_aluno->execute();
        $aluno_id = $stmt_aluno->insert_id;
        $stmt_aluno->close();

        // Inserir telefones do aluno na tabela telefone_aluno
        $sql_telefone = "INSERT INTO telefone_aluno (numero, aluno_id) VALUES (?, ?)";
        $stmt_telefone = $conexao->prepare($sql_telefone);
        foreach ($telefones as $telefone) {
            $stmt_telefone->bind_param("si", $telefone, $aluno_id);
            $stmt_telefone->execute();
        }
        $stmt_telefone->close();

        // Commit da transação
        $conexao->commit();

        echo "Cadastro realizado com sucesso!";
    } catch (Exception $e) {
        // Rollback da transação em caso de erro
        $conexao->rollback();
        echo "Erro ao cadastrar aluno: " . $e->getMessage();
    }
    
    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    // Se o formulário não foi submetido, redireciona de volta para a página de cadastro
    header("Location: cadastro_aluno.php");
    exit();
}
?>
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <link rel="stylesheet" type="text/css" href="../../css/cad_aluno.css" />
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
<div class="container-geral">
<div class = "fundo">
        <div class = "area">
        <div class = "quadrado"> 
            <div class ="titulo">Cadastro do Aluno</div>
            <div class ="texto">Preencha os dados</div>
            <div class ="formulario">
                <form method = "POST">
                    <div class = "cad">
                    <div class = "input-cad"><input type = "text" name = "nome" placeholder = "Primeiro nome"></div>
                    <div class = "input-cad"><input type = "text" name = "sobrenome" placeholder = "Sobrenome"></div>
                    <div class="input-cad">
                        <select name="sexo">
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                        </select>
                    </div>
                  
                    <div class = "input-cad"><input type = "email" name = "email" placeholder = "Informe seu email"></div>
                    <div class = "input-cad"><input type = "fone" name = "fone" placeholder = "Telefone"></div> 
                    <div class = "input-cad"><input type = "login" name = "login" placeholder = "Crie um login"></div> 
                    <div class = "input-cad"><input type = "password" name = "senha" placeholder = "Digite uma senha"></div>
                    <div class = "input-cad"><input type = "date" name = "data" placeholder = "Data de nascimento"></div> 
                    <div class = "input-cad"><input type = "rg" name = "rg" placeholder = "Digite o seu Rg"></div> 
                    <div class = "input-cad"><input type = "cpf" name = "cpf" placeholder = "Digite o seu cpf"></div>                  
                    </div>
                 <br>
                    <label for="radio">Possui alguma deficiência?(PCD)</label>
                    <div class = "radio"><input type="radio" name = "pcd" value="sim">
                    <label for="sim">SIM!</label><br>
                    <div class = "radio"><input type="radio" name = "pcd" value="nao">
                    <label for="nao">NÃO!</label><br>
                    </div>
                    <div class = "input-end"><input type = "text" name = "descricao_pcd" placeholder = "Descreva se sim!"></div>
                 <br>
                    <div class ="texto">Endereço</div>
                    <div class = "end">
                    <div class = "input-end"><input type = "text" name = "logradouro" placeholder = "Logradouro"></div> 
                    <div class = "input-end"><input type = "text" name = "numero" placeholder = "Numero"></div>
                    <div class = "input-end"><input type = "text" name = "bairro" placeholder = "Bairro"></div>
                    <div class = "input-end"><input type = "text" name = "cep" placeholder = "Cep"></div>
                    <div class = "input-end"><input type = "text" name = "complemento" placeholder = "Complemento"></div>
                    <div class = "input-end"><input type = "text" name = "cidade" placeholder = "Cidade"></div>
                    <div class = "input-end"><input type = "text" name = "uf" placeholder = "UF"></div> 
                    <!-- Botão de salvar -->
                    <button type="submit" id="botao-cadastrar">Cadastrar</button>

                    
                    </div>
                </form>
            </div>
            <div class="aba-institucional">
                <a href="index.php"><div class="portal-institucional">
                    <div class="texto-institucional">
                        Ir para a Área Institucional
                    </div>
                </div></a>
            </div>
        </div>   
        </div>   
    </div>
</div>   
</body>
</html>