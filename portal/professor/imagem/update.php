<?php
require_once "../../../util/config.php";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se um arquivo foi enviado
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == UPLOAD_ERR_OK) {
        $idProfessor = $_POST["idProfessor"];
        // Caminho temporário do arquivo
        $caminhoTemp = $_FILES["imagem"]["tmp_name"];

        // Converte a imagem para base64
        $base64Imagem = base64_encode(file_get_contents($caminhoTemp));

        // Exibe o texto de base64
        //echo "Texto de Base64 da imagem:\n\n";
        //echo $base64Imagem;

            $sql = "UPDATE professor SET imagem = ? WHERE id_professor = ?";
            $stmt = mysqli_prepare($link, $sql);
        
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "si", $base64Imagem, $idProfessor);
                if (mysqli_stmt_execute($stmt)) {
                    echo "Funcionário cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar o funcionário: " . mysqli_error($link);
                }
        
                mysqli_stmt_close($stmt);
            } else {
                echo "Erro na preparação da declaração: " . mysqli_error($link);
            }
        
            mysqli_close($link);
        }
    } else {
        echo "Erro ao enviar a imagem.";
    }

// Redirecionamento de volta para a página anterior
header("Location: ../usuario.php?i=$idProfessor");
exit(); // Certifique-se de sair após o redirecionamento
?>