<?php
    //Início de Sessão  
    session_start();
    //Conecção com BD
    require_once '../db_connect.php';
    include_once 'clear.php';
    if(isset($_POST['btn-atualizar'])):
        $nome = clear($_POST['nome']);
        $sobrenome = clear($_POST['sobrenome']);
        $email = clear($_POST['email']);
        $idade = clear($_POST['idade']);
        $id = clear($_POST["id"]);
        
        if(filter_var($idade, FILTER_VALIDATE_INT)):
            $sql = "UPDATE clientes SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', idade = '$idade' WHERE id = '$id';";
        endif;

        if(mysqli_query($connect, $sql)):
            $_SESSION['mensagem'] = "Atualizado com sucesso!";
            header('Location: ../index.php');
        else:
            $_SESSION['mensagem'] = "Falha de Atualização!";
            header('Location: ../index.php');
        endif;
    endif;
?>

