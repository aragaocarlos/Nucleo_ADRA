<?php
    require_once "../../util/config.php";

    $nome = "Marcos";
    $valor = "9199884512";
    $detalhe = "Rua joaquim tavora, 234";
    $validade = "123456";
    $marca = "marcos.tavora@gmail.com";

    $sql = "INSERT INTO produtos (nome, valor, detalhe, validade, marca) VALUES(?, ?, ?, ?, ?)";
    
    $stmt = mysqli_prepare($link, $sql);
    
    mysqli_stmt_bind_param($stmt, "sssis", $nome, $valor, $detalhe, $validade, $marca);

    if(mysqli_stmt_execute($stmt)){
        echo " Registro concluido";
    }else{
        echo " Erro no Registro";
    }

?>