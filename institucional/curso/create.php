<?php
    require_once "../../util/config.php";

    $idAluno = $_GET['i'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Curso</title>
    <link rel="stylesheet" type="text/css" href="../../css/cad_funcionario.css" />
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
            <div class ="titulo">Cadastro de Curso</div>
            <div class ="texto">Preencha os dados</div>
            <form method = "POST">
                <div class = "cad">
                    <div class = "input-cad"><input type="text" id="nome" name="nome" placeholder = "Nome do Curso"></div>
                    <div class = "input-cad"><input type="text" id="sigla" name="sigla" placeholder = "Sigla"></div>
                    <div class = "input-cad"><input type="text" id="descricao" name="descricao" placeholder = "Descrição"></div>
                    <div class = "input-cad"><input type="number" id="ch" name="ch" placeholder="Carga Horária"></div>
                    <br>
                    <label for="periodo">Período:</label>
                    <select id="periodo" name="periodo">
                        <option value="M">Manhã</option>
                        <option value="V">Tarde</option>
                        <option value="N">Noite</option>
                    </select><br><br>
                
                    <label for="curso_inicio">Data de Início:</label>
                    <div class = "input-cad" id="data"><input type="date" id="curso_inicio" name="curso_inicio"></div>
                    <br>
                    <label for="curso_fim">Data de Término:</label>
                    <div class = "input-cad" id="data"><input type="date" id="curso_fim" name="curso_fim"></div>
                    <br>
                    <label for="hora_inicio">Hora de Início:</label>
                    <div class = "input-cad" id="data"><input type="time" id="horario_inicio" name="horario_inicio"></div>
                    <br>
                    <label for="hora_fim">Hora de Término:</label>
                    <div class = "input-cad" id="data"><input type="time" id="horario_fim" name="horario_fim"></div>
                
                    <div class = "input-cad"><input type="number" step="0.01" id="valor" name="valor" placeholder="Valor"></div>
                
                    <button type="submit" id="botao-cadastrar">Cadastrar</button>
                    </div>
                </form>
        </div>
        </div>
</div> 
</div>
</body>
</html>