<?php
    require_once "../../util/config.php";

    $idAluno = $_GET['i'];
    $idCurso = $_GET['c'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Curso</title>
    <link rel="stylesheet" type="text/css" href="../../css/cad_curso.css" />
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
<form action="processar_formulario.php" method="post">

    <h1>Cadastro de Curso</h1>
    <label for="nome">Nome do Curso:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="sigla">Sigla:</label>
    <input type="text" id="sigla" name="sigla"><br><br>

    <label for="descricao">Descrição:</label><br>
    <textarea id="descricao" name="descricao" rows="4" cols="50" required></textarea><br><br>

    <label for="ch">Carga Horária:</label>
    <input type="number" id="ch" name="ch"><br><br>

    <label for="periodo">Período:</label>
    <select id="periodo" name="periodo">
        <option value="M">Manhã</option>
        <option value="V">Tarde</option>
        <option value="N">Noite</option>
    </select><br><br>

    <label for="curso_inicio">Data de Início:</label>
    <input type="date" id="curso_inicio" name="curso_inicio"><br><br>

    <label for="curso_fim">Data de Término:</label>
    <input type="date" id="curso_fim" name="curso_fim"><br><br>

    <label for="hora_inicio">Hora de Início:</label>
    <input type="time" id="hora_inicio" name="hora_inicio"><br><br>

    <label for="hora_fim">Hora de Término:</label>
    <input type="time" id="hora_fim" name="hora_fim"><br><br>

    <label for="valor">Valor:</label>
    <input type="number" step="0.01" id="valor" name="valor"><br><br>

    <input type="submit" value="Enviar">
</form>
</div>
</body>
</html>