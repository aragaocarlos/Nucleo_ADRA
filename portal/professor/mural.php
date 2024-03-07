<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../../util/config.php";
    $idCurso = $_GET['c'];
    $idTurma = $_GET['t'];

    function traduzNomeMes($nomeMesIngles) {
        $mesesTraduzidos = array(
            'January' => 'janeiro',
            'February' => 'fevereiro',
            'March' => 'março',
            'April' => 'abril',
            'May' => 'maio',
            'June' => 'junho',
            'July' => 'julho',
            'August' => 'agosto',
            'September' => 'setembro',
            'October' => 'outubro',
            'November' => 'novembro',
            'December' => 'dezembro'
        );

        return $mesesTraduzidos[$nomeMesIngles];
    }

    $sql_1 = "SELECT * FROM curso";
    $result_1 = mysqli_query($link, $sql_1);
    while($row = mysqli_fetch_array($result_1)){
        if($row['id_curso'] == $idCurso){
            $nomeCurso = $row['nome'];
        }
    }

    $idProfessor = $_GET['i'];
    $sql_2 = "SELECT * FROM professor";
    $result_2 = mysqli_query($link, $sql_2);
    while($row = mysqli_fetch_array($result_2)){
        if($row['id_professor'] == $idProfessor){
            $nomeProfessor = $row['nome'];
            $sobrenomeProfessor = $row['sobrenome'];
            $cargoProfessor = 'Professor';
            $email = $row['email'];
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $nomeProfessor;
        $sobrenome = $sobrenomeProfessor;
        $cargo = $cargoProfessor;
        $conteudo = $_POST["conteudo"];
        $horario = date('d/m H:i');
        $turma = $idTurma;

        $sql = "INSERT INTO post (aluno_id, nome, sobrenome, cargo, conteudo, horario, turma) VALUES(?,?,?,?,?,?,?)";
        
        $stmt = mysqli_prepare($link, $sql);
        
        mysqli_stmt_bind_param($stmt, "isssssi", $idProfessor, $nome, $sobrenome, $cargo, $conteudo, $horario, $turma);

        if(mysqli_stmt_execute($stmt)){
            $_SESSION['msg'] = " Post enviado";
        }else{
            $_SESSION['msg'] = " Tente novamente mais tarde";
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mural</title>
    <link rel="stylesheet" href="../../css/mural.css">
    <link rel="icon" href="../../imagens/nucleo-adra-icone.png" >
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="curso.php?i=<?php echo $idProfessor; ?>">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div class="opcoes-nav">
                <a href="mural.php?c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="mural-texto">
                            Mural
                        </div>
                    </div>
                </a>
                <a href="lista_atividade.php?c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>">
                <div class="opcao-nav">
                    <div class="atividades">
                        Atividades
                    </div>
                </div>
                </a>
                <a href="avaliacao.php?c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="notas-texto">
                            Avaliação
                        </div>
                    </div>
                </a>
                </div>
                <a href="usuario.php?i=<?php echo $idProfessor; ?>">
                    <div id="perfil" class="opcoes-nav">
                        <img src="../../imagens/usuario/159158661_3884476911618851_7142528251732469605_n.jpg" alt="">
                    </div>
                </a>
            </div>
        </main>
    </header>

<div class="container">
    <div class="container-geral">
        <div class="titulo-curso">
            <div class="titulo-texto">
                <?php echo $nomeCurso; ?>
            </div>
        </div>
        <form method="post">
        <div class="container-caixa">
            <div class="container-alinhamento">
                <div class="caixa-texto">
                    <textarea name="conteudo" id="" cols="30" rows="10" placeholder="Escreva uma mensagem para a turma"></textarea>
                </div>
                <div class="caixa-base">
                    <a href=""><div class="anexo">
                        <img src="../../imagens/paper-clip-branco.png" alt="">
                    </div></a>
                    <div class="publicar">
                        <button type="submit">Publicar</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- INSERIR NOVA ATIVIDADE -->
        <div class="aba-atividade">
            <a href="atividade.php?c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>"><div class="postar-atividade">
                <div class="icone-atividade">
                    +
                </div>
                <div class="texto-atividade">
                    Inserir nova atividade
                </div>
            </div></a>
        </div>

        <?php
                $sql = "SELECT * FROM post";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    if ($idTurma == $row['turma']){
                        $idPost = $row['id'];
        ?>
        <div class="post">
            <div class="post-alinhamento">
                <div class="cabecalho">
                    <div class="foto-aluno">
                        <img src="../../imagens/usuario/159158661_3884476911618851_7142528251732469605_n.jpg" alt="">
                    </div>
                    <div class="container-nome">
                        <div class="nome-aluno">
                        <?php echo $row['nome']; ?>
                        <?php echo $row['sobrenome']; ?>
                        </div>
                        <div class="tipo-aluno">
                        <?php echo $row['cargo']; ?>
                        </div>
                    </div>
                    <?php if($row['aluno_id'] == $idProfessor){?>
                    <div class="post_icone">
                        <!--<button><div class="editar">
                            <img src="../../imagens/editar.png" alt="">
                        </div></button>-->
                        <div class="excluir"><?php echo '<a href="./post/excluir.php?id='.$idPost.'&i='.$idProfessor.'&t='.$idTurma.'&c='.$idCurso.'"><img src="../../imagens/excluir.png" alt=""></a>'?></div>
                    </div>
                    <?php } ?>
                </div>
                <div class="conteudo-post">
                    <p><?php echo $row['conteudo']; ?></p>
                </div>
                <div class="data">
                    <?php
                    // Cria um objeto DateTime usando a data original e o formato
                    $dataObj = DateTime::createFromFormat('d/m H:i', $row['horario']);

                    // Obtém o dia e o mês da data no formato desejado
                    $dia = $dataObj->format('d');
                    $mes = $dataObj->format('F'); // 'F' retorna o nome completo do mês em inglês

                    // Traduz o nome do mês para português (ou outro idioma, se necessário)
                    $mesTraduzido = traduzNomeMes($mes);

                    // Formata a data no novo formato
                    $dataFormatoNovo = $dia . ' de ' . $mesTraduzido;

                    echo $dataFormatoNovo;
                    ?>
                </div>
            </div>
            <?php
            
        // Inicializa as variáveis de comentário antes do loop interno
        $comentario_contador = 0;
        $idComentario = null;
        $comentarioNome = null;
        $comentarioData = null;
        $comentarioConteudo = null;

        // Loop interno para comentários
        $sql_comentario = "SELECT * FROM comentario WHERE post_id = $idPost";
        $result_comentario = mysqli_query($link, $sql_comentario);

        while ($row_comentario = mysqli_fetch_array($result_comentario)) {
            $comentario_contador += 1;
            $idComentario = $row_comentario['id'];
            $comentarioNome = $row_comentario['nome'] . ' ' . $row_comentario['sobrenome'];
            $comentarioData = $row_comentario['data'];
            $comentarioConteudo = $row_comentario['texto'];
        }
            ?>
            <div class="container_comentarios">
                <?php
                    if($comentario_contador > 1){
                ?>
                <div class="comentarios"><a href="post.php?p=<?php echo $row['id'] ?>&c=<?php echo $idCurso ?>&i=<?php echo $idProfessor; ?>&t=<?php echo $idTurma; ?>">
                    Mostrar todos os <?php echo $comentario_contador; ?> comentários
                </a></div>
                <?php
                }
                if($idComentario != null){
                ?>
                <div class="comentario_feito">
                    <div class="comentarios_foto-aluno">
                        <img src="../../imagens/usuario/159158661_3884476911618851_7142528251732469605_n.jpg" alt="">
                    </div>
                    <div class="comentarios_container-texto">
                        <div class="comentarios_container-nome">
                            <div class="comentarios_nome-aluno">
                            <?php echo 
                            $comentarioNome; ?>
                            </div>
                            <div class="comentarios_data">
                                <?php
                                // Cria um objeto DateTime usando a data original e o formato
                                $dataObj = DateTime::createFromFormat('Y-m-d', $comentarioData);

                                // Obtém o dia e o mês da data no formato desejado
                                $dia = $dataObj->format('d');
                                $mes = $dataObj->format('F'); // 'F' retorna o nome completo do mês em inglês
            
                                // Traduz o nome do mês para português (ou outro idioma, se necessário)
                                $mesTraduzido = traduzNomeMes($mes);
            
                                // Formata a data no novo formato
                                $dataFormatoNovo = $dia . ' de ' . $mesTraduzido;
            
                                echo $dataFormatoNovo;                    
                                ?>
                            </div>
                        </div>
                        <div class="comentarios_conteudo">
                            <?php echo $comentarioConteudo; ?>
                        </div>
                    </div>
                    <?php if($row['aluno_id'] == $idProfessor){?>
                    <div class="comentarios_post_icone">
                        <!--<button><div class="editar">
                            <img src="../../imagens/editar.png" alt="">
                        </div></button>-->
                        <div class="excluir"><?php echo '<a href="./comentario/excluir.php?id='.$idComentario.'&i='.$idProfessor.'&t='.$idTurma.'&c='.$idCurso.'"><img src="../../imagens/excluir.png" alt=""></a>'?></div>
                    </div>
                        <?php
                        }?>
                </div>
                                <?php }?>
                <div class="comentarios_input">
                        <div class="comentarios_perfil-aluno">
                            <img src="../../imagens/usuario/159158661_3884476911618851_7142528251732469605_n.jpg" alt="">
                        </div>
                            <form action="./comentario/postar.php" method="POST">
                                <div class="comentarios_container-input">
                                    <input type="text" name="comentario_texto" placeholder="Insira seu comentário">
                                    <input type="hidden" name="idPost" value="<?php echo $idPost; ?>">
                                    <input type="hidden" name="idTurma" value="<?php echo $idTurma; ?>">
                                    <input type="hidden" name="nome" value="<?php echo $nomeProfessor; ?>">
                                    <input type="hidden" name="sobrenome" value="<?php echo $sobrenomeProfessor; ?>">
                                    <input type="hidden" name="idCurso" value="<?php echo $idCurso; ?>">
                                    <input type="hidden" name="idProfessor" value="<?php echo $idProfessor ; ?>">
                                </div>
                                <div class="comentarios_container-enviar">
                                    <button type="submit"><img src="../../imagens/enviar.png"></button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
        </div>
    </div>
</body>
</html>