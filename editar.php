<?php
//Conexão com BD para edição do banco
include_once 'db_connect.php';
//Cabeçalho
include_once 'includes/header.php';
//Select
if(isset($_GET['id'])):
    $id = mysqli_escape_string($connect, $_GET['id']);
    $sql = "SELECT * FROM clientes WHERE ID = '$id'";
    $resultado = mysqli_query($connect, $sql);
    $dados = mysqli_fetch_array($resultado);
endif;
?>
<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class="light">Editar Cliente</h3>
        <form action="php_action/update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $dados['id'];?>"/>
            <div class="input-field col s12">
                <input type="text" name="nome" id="nome" value="<?php echo $dados['nome']?>">
                <label for="nome">Nome</label>
            </div>
            
            <div class="input-field col s12">
                <input type="text" name="sobrenome" id="sobrenome" value="<?php echo $dados['sobrenome']?>">
                <label for="sobrenome">Sobremome</label>
            </div>
            
            <div class="input-field col s12">
                <input type="email" name="email" id="email" value="<?php echo $dados['email']?>">
                <label for="email">E-mail</label>
            </div>
            
            <div class="input-field col s12">
                <input type="text" name="idade" id="idade" value="<?php echo $dados['idade']?>">
                <label for="idade">Idade</label>
            </div>
            <button type="submit" name="btn-atualizar" class="btn">Atualizar</button>
            <a href="index.php" class="btn green">Lista de Clientes</a>
        </form>
    </div>
</div>
<?php
//Rodapé
include_once 'includes/footer.php';
?>
