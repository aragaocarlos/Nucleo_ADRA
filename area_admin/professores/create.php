<?php
    $idAluno = $_GET['i'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset ="UTF-8">
    <meta http-equiv ="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Professor</title>
    <link rel="stylesheet" type="text/css" href="../../css/cad_prof.css" />
</head>
<body>
    <header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="administrador.php?i=<?php echo $idAluno; ?>">
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
            <div class ="titulo">Cadastro do Educador</div>
            <div class ="formulario">
                <form method = "POST">
                    <div class = "cad">
                    <div class = "input-cad"><input type = "text" name = "nome" placeholder = "Primeiro nome"></div>
                    <div class = "input-cad"><input type = "text" name = "sobrenome" placeholder = "Sobrenome"></div>
                    <div class = "input-cad"><input type = "email" name = "email" placeholder = "Informe seu email"></div>
                    <div class = "input-cad"><input type = "fone" name = "fone" placeholder = "telefone"></div> 
                    <div class = "input-cad"><input type = "password" name = "senha" placeholder = "Digite uma senha"></div>
                    <div class = "input-cad"><input type = "date" name = "data" placeholder = "Data de nascimento"></div>                  
                    </div>
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
                    <button type="submit" id="botao-cadastrar">Salvar</button>

                    
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