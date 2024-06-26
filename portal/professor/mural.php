<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once "../../util/config.php";

    if ($_SESSION != null){
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

    $idProfessor = $_SESSION['idProfessor'];
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

    $sql_perfil = "SELECT * FROM professor";
    $result_perfil = mysqli_query($link, $sql_perfil);
    while ($row = mysqli_fetch_array($result_perfil)) {
        if($row['id_professor'] == $idProfessor){
            $imagem64Professor = $row['imagem'];
            if (!empty($row['imagem'])) {
                        // Decodifica o texto em base64
                        $imagemDecode = base64_decode($row['imagem']);

                        // Determina o tipo de conteúdo da imagem
                        $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecode, FILEINFO_MIME_TYPE);

                        // Gera um URI de dados para a imagem
                        $imagemDataUriProfessor = "data:$tipoConteudo;base64," . base64_encode($imagemDecode);
            } else {
                $imagemDataUriAluno = "../../imagens/perfil-branco.png";
            }
            }
        }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $nomeProfessor;
        $sobrenome = $sobrenomeProfessor;
        $cargo = $cargoProfessor;
        $conteudo = $_POST["conteudo"];
        $horario = date('d/m H:i');
        $turma = $idTurma;
        $perfilProfessor = $imagem64Professor;
        $base64Imagem = "";

    // Verifica se um arquivo foi enviado
    if (isset($_FILES["imagem"]["error"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) {
        // Caminho temporário do arquivo
        $caminhoTemp = $_FILES["imagem"]["tmp_name"];

        // Lê os dados binários da imagem
        $imagemBinaria = file_get_contents($caminhoTemp);

        // Cria uma imagem a partir dos dados binários
        $imagemOriginal = imagecreatefromstring($imagemBinaria);

        // Redimensiona a imagem para uma largura máxima de 800 pixels (ajuste conforme necessário)
        $larguraOriginal = imagesx($imagemOriginal);
        $alturaOriginal = imagesy($imagemOriginal);
        $novaLargura = 800;
        $novaAltura = round(($alturaOriginal / $larguraOriginal) * $novaLargura);

        $imagemRedimensionada = imagescale($imagemOriginal, $novaLargura, $novaAltura);

        // Converte a imagem redimensionada para base64
        ob_start();
        imagejpeg($imagemRedimensionada, null, 50);
        $base64Imagem = base64_encode(ob_get_clean());
    }
        
        $sql = "INSERT INTO post (aluno_id, anexo, nome, sobrenome, cargo, conteudo, horario, turma, imagem) VALUES(?,?,?,?,?,?,?,?,?)";
        
        $stmt = mysqli_prepare($link, $sql);
        
        mysqli_stmt_bind_param($stmt, "issssssis", $idProfessor, $base64Imagem, $nome, $sobrenome, $cargo, $conteudo, $horario, $turma, $perfilProfessor);
        
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
    <!-- Confirmação de Exclusão -->
    <script>
        function confirmarExclusao(event) {
            var confirmacao = confirm("Você tem certeza que quer excluir?");
            if (!confirmacao) {
                event.preventDefault(); // Cancela a ação de exclusão se o usuário clicar em "Não"
            }
        }
    </script>
</head>
<body>
<header>
        <main>
            <div class="cabecalho-conteudo">
                <a href="curso.php">
                <div id="logo" class="opcoes-nav">
                    <img src="../../imagens/nucleo-adra-branco-232x48.png" alt="logo-adra">
                </div>
                </a>
                <div class="opcoes-nav">
                <a href="mural.php?c=<?php echo $idCurso ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="mural-texto">
                            Mural
                        </div>
                    </div>
                </a>
                <a href="lista_atividade.php?c=<?php echo $idCurso ?>&t=<?php echo $idTurma; ?>">
                <div class="opcao-nav">
                    <div class="atividades">
                        Atividades
                    </div>
                </div>
                </a>
                <a href="avaliacao.php?c=<?php echo $idCurso ?>&t=<?php echo $idTurma; ?>">
                    <div class="opcao-nav">
                        <div class="notas-texto">
                            Avaliação
                        </div>
                    </div>
                </a>
                </div>
                <a href="usuario.php">
                    <div id="perfil" class="opcoes-nav">
                    <?php
                        echo "<img src='$imagemDataUriProfessor' alt=''>";
                        ?>
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
        <form method="post" enctype="multipart/form-data">
        <div class="container-caixa">
            <div class="container-alinhamento">
                <div class="caixa-texto">
                    <textarea name="conteudo" id="" cols="30" rows="10" placeholder="Escreva uma mensagem para a turma" required></textarea>
                </div>
                <div class="caixa-base">
                <div class="anexo">
                        <input type="file" name="imagem" id="imagem" accept="image/*">
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
            <a href="atividade.php?c=<?php echo $idCurso ?>&t=<?php echo $idTurma; ?>"><div class="postar-atividade">
                <div class="icone-atividade">
                    +
                </div>
                <div class="texto-atividade">
                    Inserir nova atividade
                </div>
            </div></a>
        </div>

        <?php
                $sql = "SELECT * FROM post ORDER BY horario DESC";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_array($result)){
                    if ($idTurma == $row['turma']){
                        $idPost = $row['id'];
                        $idProfessorPost = $row['aluno_id'];
        ?>
        <div class="post">
            <div class="post-alinhamento">
                <div class="cabecalho">
                    <div class="foto-aluno">
                        <?php
                        if (!empty($row['imagem'])) {
                            $imagem64Professor = $row['imagem'];
                            // Decodifica o texto em base64
                            $imagemDecode = base64_decode($row['imagem']);
    
                            // Determina o tipo de conteúdo da imagem
                            $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecode, FILEINFO_MIME_TYPE);
    
                            // Gera um URI de dados para a imagem
                            $imagemDataUriPost = "data:$tipoConteudo;base64," . base64_encode($imagemDecode);
                        } else {
                            $imagemDataUriPost = "../../imagens/perfil.png";
                        }
                        echo "<img src='$imagemDataUriPost' alt=''>";        
                        ?>
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
                    <div class="post_icone">
                        <!--<button><div class="editar">
                            <img src="../../imagens/editar.png" alt="">
                        </div></button>-->
                        <div class="excluir"><?php echo '<a href="./post/excluir.php?id='.$idPost.'&t='.$idTurma.'&c='.$idCurso.'"><img src="../../imagens/excluir.png" alt=""></a>'?></div>
                    </div>
                </div>
                <div class="conteudo-post">
                    <p><?php echo $row['conteudo']; ?></p>
                </div>
                <div class="post_anexo">
                    <?php
                        if (!empty($row['anexo'])) {
                            // Decodifica o texto em base64
                            $imagemDecodificada = base64_decode($row['anexo']);

                            // Determina o tipo de conteúdo da imagem
                            $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecodificada, FILEINFO_MIME_TYPE);

                            // Gera um URI de dados para a imagem
                            $imagemDataUri = "data:$tipoConteudo;base64," . base64_encode($imagemDecodificada);

                            // Exibe a imagem usando a tag <img>
                            echo "<img src='$imagemDataUri' alt=''>";
                } else {
                    echo '<img src="../../imagens/perfil-branco-200px.png" alt="">';
                }
                ?>
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
        $cargoComentario = null;

        // Loop interno para comentários
        $sql_comentario = "SELECT * FROM comentario WHERE post_id = $idPost";
        $result_comentario = mysqli_query($link, $sql_comentario);
        while ($row_comentario = mysqli_fetch_array($result_comentario)) {
            $comentario_contador += 1;
            $idComentario = $row_comentario['id'];
            $idProfessorComentario = $row_comentario['aluno_id'];
            $comentarioNome = $row_comentario['nome'] . ' ' . $row_comentario['sobrenome'];
            $comentarioData = $row_comentario['data'];
            $comentarioConteudo = $row_comentario['texto'];
            $cargoComentario = $row_comentario['cargo'];
            if($cargoComentario == 'Professor'){
                $sql_professor = "SELECT * FROM professor";
                $result_professor = mysqli_query($link, $sql_professor);
                while($row = mysqli_fetch_array($result_professor)){
                    if($row['id_professor'] == $idProfessorComentario){
                        if (!empty($row['imagem'])) {
                            $imagem64Professor = $row['imagem'];
                            // Decodifica o texto em base64
                            $imagemDecode = base64_decode($row['imagem']);
    
                            // Determina o tipo de conteúdo da imagem
                            $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecode, FILEINFO_MIME_TYPE);
    
                            // Gera um URI de dados para a imagem
                            $imagemDataUriComentario = "data:$tipoConteudo;base64," . base64_encode($imagemDecode);
                        } else {
                            $imagemDataUriComentario = "../../imagens/perfil.png";
                        }
                    }
                }
            } elseif($cargoComentario == 'Professor'){
                $sql_aluno = "SELECT * FROM professor";
                $result_aluno = mysqli_query($link, $sql_aluno);
                while($row = mysqli_fetch_array($result_aluno)){
                    if($row['id_professor'] == $idProfessorComentario){
                        if (!empty($row['imagem'])) {
                            $imagem64Professor = $row['imagem'];
                            // Decodifica o texto em base64
                            $imagemDecode = base64_decode($row['imagem']);
    
                            // Determina o tipo de conteúdo da imagem
                            $tipoConteudo = finfo_buffer(finfo_open(), $imagemDecode, FILEINFO_MIME_TYPE);
    
                            // Gera um URI de dados para a imagem
                            $imagemDataUriComentario = "data:$tipoConteudo;base64," . base64_encode($imagemDecode);
                        } else {
                            $imagemDataUriComentario = "../../imagens/perfil.png";
                        }
                    }
                }
            } else{
                $imagemDataUriComentario = "../../imagens/perfil.png";
            }
        }
            ?>
            <div class="container_comentarios">
                <?php
                    if($comentario_contador > 1){
                ?>
                <a href="post.php?p=<?php echo $idPost; ?>&c=<?php echo $idCurso; ?>&t=<?php echo $idTurma;?>" class="comentarios_link"><div class="comentarios">
                    Mostrar todos os <?php echo $comentario_contador; ?> comentários
                </div></a>
                <?php
                }
                if($idComentario != null){
                ?>
                <div class="comentario_feito">
                    <div class="comentarios_foto-aluno">
                        <?php echo "<img src='$imagemDataUriComentario' alt=''>"; ?>
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
                    <div class="comentarios_post_icone">
                        <!--<button><div class="editar">
                            <img src="../../imagens/editar.png" alt="">
                        </div></button>-->
                        <div class="excluir"><?php echo '<a href="./comentario/excluir.php?id='.$idComentario.'&t='.$idTurma.'&c='.$idCurso.'" class="crud_link" onclick="confirmarExclusao(event)"><img src="../../imagens/excluir.png" alt=""></a>'?></div>
                    </div>
                </div>
                <?php }?>
                <div class="comentarios_input">
                        <div class="comentarios_perfil-aluno">
                            <?php echo "<img src='$imagemDataUriProfessor' alt=''>"; ?>
                        </div>
                            <form action="./comentario/postar.php" method="POST">
                                <div class="comentarios_container-input">
                                    <input type="text" name="comentario_texto" placeholder="Insira seu comentário">
                                    <input type="hidden" name="idPost" value="<?php echo $idPost; ?>">
                                    <input type="hidden" name="idTurma" value="<?php echo $idTurma; ?>">
                                    <input type="hidden" name="nome" value="<?php echo $nomeProfessor; ?>">
                                    <input type="hidden" name="sobrenome" value="<?php echo $sobrenomeProfessor; ?>">
                                    <input type="hidden" name="idCurso" value="<?php echo $idCurso; ?>">
                                    <input type="hidden" name="idProfessor" value="<?php echo $idProfessor; ?>">
                                    <input type="hidden" name="cargo" value="Professor">
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
    <?php
    } else{
    // Redirecionamento de volta para a página anterior
    header("Location: ../professor.php");
    exit(); // Certifique-se de sair após o redirecionamento
    }?> 
</body>
</html>