<?php
    
    //Sessão
    include_once 'db_connect.php';
    //Cabeçalho
    include_once 'includes/header.php';
    //Mensagem
    include_once 'includes/mensagem.php';
    
?>
        
<div class="row">
    <div class="col s12 m6 push-m3">
        <h3 class="light">Clientes</h3>
        <div>
            
            <table class="striped">
            <thead>
                <tr>
                    <th>Nome:</th>
                    <th>Sobrenome:</th>
                    <th>Email:</th>
                    <th>Idade:</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    $sql = "SELECT * FROM clientes";
                    $resultado = mysqli_query($connect, $sql);
                    
                    if(mysqli_num_rows($resultado)>0):
                        while($dados = mysqli_fetch_array($resultado)):
                ?>
                <tr>
                    <td><?php echo $dados['nome'];?></td>
                    <td><?php echo $dados['sobrenome'];?></td>
                    <td><?php echo $dados['email'];?></td>
                    <td><?php echo $dados['idade'];?></td>
                    <td><a href="editar.php?id=<?php echo $dados['id'];?>" class="btn-floating orange"><i class="material-icons">edit</i></a></td>
                    
                    <td><a href="#modal<?php echo $dados['id'];?>" class="btn-floating red modal-trigger"><i class="material-icons">delete</i></a></td>
                    
                    <div id="modal<?php echo $dados['id'];?>" class="modal">
                        <div class="modal-content">
                          <h4>Aviso!</h4>
                          <p>Você está certo desta exclusão?</p>
                        </div>
                        <div class="modal-footer">
                          
                          <form action="php_action/delete.php" method="POST">
                              <input type="hidden" name="id" value="<?php echo $dados['id'];?>">
                              <button type="submit" name="btn-deletar" class="btn red">Sim</button>
                              <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
                          </form>
                        </div>
                    </div>
                    
                </tr>
                <?php
                        endwhile;
                    else:
                ?>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr> 
                <?php
                    endif;
                ?>
            </tbody>
        </table>
        </div>
        <br>
        <div class="panel-heading">               
            <form method="post" action="convert.php">
                <input type="submit" name="export" class="btn btn-success" value="Exportar .xls"/>
                <a href="adicionar.php" class="btn">Adicionar Cliente</a>
            </form>
            <form method="post" action="convert.php" enctype="multipart/form-data">
                <label>Insira Aqui o Arquivo</label><input type="file" name="file" id="file" accept=".xls">
                <input type="submit" id="submit" name="import" class="btn btn-success" value="Importar Planilha"/><br>
            </form>
        </div>  
        </div>
    </div>
</div>
    
<?php
//Rodapé
include_once 'includes/footer.php';
?>
