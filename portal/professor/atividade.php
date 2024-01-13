<?php
    $idAluno = $_GET['i'];
    $idCurso = $_GET['c'];
    $idTurma = $_GET['t'];
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Atividade</title>
    <link rel="stylesheet" href="./css/mural.css">
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="cursos_professor.php?i=<?php echo $idAluno; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="./imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div class="opcoes-nav">
                <a href="mural-professor.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="mural-texto">
                            Mural
                        </div>
                    </div>
                </a>
                <a href="lista_atividades_professor.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
                <div class="opcao-nav">
                    <div class="atividades">
                        Atividades
                    </div>
                </div>
                </a>
                <a href="avaliacao_professor.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="notas-texto">
                            Avaliação
                        </div>
                    </div>
                </a>
                </div>
                <a href="usuario.php?c=<?php echo $idCurso ?>&i=<?php echo $idAluno; ?>&t=<?php echo $idTurma; ?>">
                <div id="perfil" class="opcoes-nav">
                </div>
                </a>
            </div>
        </main>
    </header>
    <div class="container">
        <div class="container-geral">
            <div class="post_atividade_cadastro">
                <div class="atividade_titulo">
                    Cadastro de Atividade
                </div>
        <form id="atividadeForm">
            <div id="atividade_info">
                <p>Título da Atividade:</p>
                <p>
                    <div class="caixa-texto-atividade">
                        <textarea name="conteudo" id="" cols="30" rows="1" placeholder="Escreva o título da atividade"></textarea>
                    </div>
                <p>Comando da Atividade:</p>
                <p>
                    <div class="caixa-texto-atividade">
                        <textarea name="conteudo" id="" cols="30" rows="7" placeholder="Escreva o comando da atividade"></textarea>
                    </div>
                </p>
            </div>
            <div id="atividade_info">            
                <p><strong>Prazo de Entrega:</strong></p>
                <p><input type="datetime-local" id="prazo" name="prazo" required></p>
            </div>
            <div id="atividade_sub">
                <button type="button" onclick="cadastrarAtividade()">Cadastrar Atividade</button>
            </div>
        </form>
            </div>
        </div>
    </div>

    <script>
        function cadastrarAtividade() {
        var comando = document.getElementById("comando").value;
        var prazo = document.getElementById("prazo").value;

        // Aqui você pode processar os dados, como enviá-los para o servidor

        alert("Atividade cadastrada:\nComando: " + comando + "\nPrazo de Entrega: " + prazo);

        // Limpar o formulário após a submissão
        document.getElementById("atividadeForm").reset();
        }
    </script>
</body>
</html>