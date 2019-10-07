<?php
    //Início de Sessão  
    session_start();
    //Conecção com BD
    require_once '../db_connect.php';
    //Clear
    include_once 'clear.php';
    if(isset($_POST['btn-cadastrar'])):
        $nome = clear($_POST['nome']);
        $sobrenome = clear($_POST['sobrenome']);
        $email = clear($_POST['email']);
        $idade = clear($_POST['idade']);
        if(filter_var($idade, FILTER_VALIDATE_INT)):
            $sql = "INSERT INTO clientes (nome, sobrenome, email, idade) VALUES ('$nome','$sobrenome','$email','$idade')";
        endif;

        if(mysqli_query($connect, $sql)):
            $_SESSION['mensagem'] = "Cadastrado com Sucesso!";
            header('Location: ../index.php');
        else:
            $_SESSION['mensagem'] = "Falha de Cadastro!";
            header('Location: ../index.php');
        endif;
    endif;
?>


