<?php 
//Faz a conexão com o banco de dados
require_once 'db_connect.php';
//Importa a biblioteca de conversão de arquivos excel
require_once 'vendor/autoload.php';
//Variável contendo a data atual para nomear a planilha baixada
$dia=date('d-m-Y');
//Variável onde será contida a estrutura da planilha a ser baixada
$output = '';
//Verifica se a solicitação de download foi feita
if(isset($_POST['export']))
{
 
 //Query para solicitar todos os dados da tabela
 //contida no servidor BD
 $query = "SELECT * FROM clientes";
 //Variável recebe a array contendo os resultados
 //da variável $query
 $result = mysqli_query($connect, $query);
 //Executa a impressão dos valores caso haja dados 
 //na variável query
 if(mysqli_num_rows($result) > 0)
 {
  //Concatenação de dados na variável $output
  $output .= '
   <meta http-equiv="Content-Type"
   content="text/html; charset=utf-8"/>
   <table class="striped">
            <thead>
                <tr>
                    <th>ID:</th>
                    <th>Nome:</th>
                    <th>Sobrenome:</th>
                    <th>Email:</th>
                    <th>Idade:</th>
                </tr>
            </thead>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
            <tr>
                <td>'.$row["id"].'</td>
                <td>'.$row["nome"].'</td>  
                <td>'.$row["sobrenome"].'</td>  
                <td>'.$row["email"].'</td>  
                <td>'.$row["idade"].'</td>  
            </tr>
   ';
  }
  $output .= '</table>';
  header ('Cache-Control: no-cache, must-revalidate');
  header ('Pragma: no-cache');
  header ('Content-Type: application/x-msexcel');
  header ("Content-Disposition: attachment; filename=planilha-".$dia.".xls");
  echo $output;
 }else{
     $output .= '
   <meta http-equiv="Content-Type"
   content="text/html; charset=utf-8"/>
   <table class="striped">
            <thead>
                <tr>
                    <th>ID:</th>
                    <th>Nome:</th>
                    <th>Sobrenome:</th>
                    <th>Email:</th>
                    <th>Idade:</th>
                </tr>
            </thead>
            <tr>
                <td>-</td>
                <td>-</td>  
                <td>-</td>  
                <td>-</td>  
                <td>-</td>  
            </tr>';
  $output .= '</table>';
  header ('Cache-Control: no-cache, must-revalidate');
  header ('Pragma: no-cache');
  header ('Content-Type: application/x-msexcel');
  header ("Content-Disposition: attachment; filename=planilha-".$dia.".xls");
  echo $output;
 }
}

//fazer a importação neste mesmo arquivo
if(isset($_POST["import"]))
{
    //Verifica de o arquivo enviado está de acordo com o formato exigido
    $formatOk = array("xls");
    $extImport = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    //Variável para pular os valores do cabeçalho
    $id=0;
    //Condicional que verifica o envio
    if($_FILES['file']['name'])
    {
     //variável que verifica se o arquivo enviado é compatível com o formato requisitado
     if(in_array($extImport, $formatOk))
     {
      //Declara a variável que armazena o arquivo upado
      $fileName=$_FILES['file']['tmp_name'];
      //instancia o objeto PHPExcel e utiliza o método load()
      $objPHPExcel = PHPExcel_IOFactory::load($fileName);
      //inicializa o método de conversão para csv
      $objWriterCSV = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
      $objWriterCSV->setExcelCompatibility(true);
      //renomeia o arquivo gerado
      $objWriterCSV->save(str_replace('.php', '.csv', __FILE__));
      $file_name= basename(__FILE__, '.php').'.csv';
      $path = "/var/www/html/Jordan/Procedural/_crud/".$file_name;
      //Abre o arquivo CSV
      $handle = fopen($path, "r");
      //Loop para verificar todos os registros de cada linha do CSV
      while($data = fgetcsv($handle,0,';','"'))
      {
       //filtra os dados retirados do arquivo e os 
       //aloca em variáveis
       $id = mysqli_real_escape_string($connect, $data[0]);
       $nome = mysqli_real_escape_string($connect, $data[1]);
       $sobrenome = mysqli_real_escape_string($connect, $data[2]);  
       $email = mysqli_real_escape_string($connect, $data[3]);
       $idade = mysqli_real_escape_string($connect, $data[4]);
       //Altera os valores em seus respectivos registros
       if($id>1){
           $query = "
           UPDATE clientes 
           SET nome = '".$nome."', 
           sobrenome = '".$sobrenome."', 
           email = '".$email."',
           idade = ".$idade."
           WHERE id = ".$id.";
          ";
           mysqli_query($connect, $query);
        }
        $id++;
      }
      fclose($handle);
      unlink($path);
      session_start();
      $_SESSION['mensagem']="Sucesso!";
      header("location: index.php");
     }
     else
     {
        session_start();
        $_SESSION['mensagem']="Formato Incorreto";
        header("location: index.php");
     }
    }
    else
    {
        session_start();
        $_SESSION['mensagem']="Insira um Arquivo";
        header("location: index.php");
    }
}
    
    
?>
