<?php
require_once "config.php";

    $query = 'DELETE FROM posts WHERE id = ?';
    // preparação
    $sql = $pdo->prepare($query); 
    // execução
    if ($sql->execute([$_GET['id']])) { 
        $message="Registo apagado com sucesso"; 
    } else {
        $message="Não foi possível apagar o registo, tente novamente";
    }
    
    header("Location: blog-read.php");