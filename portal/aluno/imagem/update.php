<?php
require_once "../../../util/config.php";
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se um arquivo foi enviado
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) {
        $idAluno = $_POST["idAluno"];

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

        // Exibe o texto de base64
        //echo "Texto de Base64 da imagem:\n\n";
        //echo $base64Imagem;

        // Insere o dado no banco de dados
        $sql = "UPDATE aluno SET imagem = ? WHERE id = ?";
        $stmt = mysqli_prepare($link, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $base64Imagem, $idAluno);
            if (mysqli_stmt_execute($stmt)) {
                //echo "Imagem atualizada com sucesso!";
            } else {
                //echo "Erro ao atualizar a imagem: " . mysqli_error($link);
            }

            mysqli_stmt_close($stmt);
        } else {
            //echo "Erro na preparação da declaração: " . mysqli_error($link);
        }

        // Libera a memória alocada para as imagens
        imagedestroy($imagemOriginal);
        imagedestroy($imagemRedimensionada);

        mysqli_close($link);
    } else {
        //echo "Erro ao enviar a imagem.";
    }
}

// Redirecionamento de volta para a página anterior
header("Location: ../usuario.php");
exit(); // Certifique-se de sair após o redirecionamento
?>