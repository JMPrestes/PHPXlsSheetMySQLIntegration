<?php
    //Início de Sessão  
    session_start();
    //Conecção com BD
    require_once '../db_connect.php';
    if(isset($_POST['btn-deletar'])):
  
        $id = mysqli_escape_string($connect, $_POST["id"]);
       
            $sql = "DELETE from clientes WHERE id = '$id';";
       

        if(mysqli_query($connect, $sql)):
            $_SESSION['mensagem'] = "Deletado com sucesso!";
            header('Location: ../index.php');
        else:
            $_SESSION['mensagem'] = "Falha de Deletar!";
            header('Location: ../index.php');
        endif;
    endif;
?>

