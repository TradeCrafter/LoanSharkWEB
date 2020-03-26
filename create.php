<?php
session_start();


    if (isset($_SESSION['loggedin'])) {  
    }
    else {
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>You need to login to access this page.</h4>
        <p><a href='index.php'>Login Here!</a></p></div>";
        exit;
    }
    // checking the time now when check-login.php page starts
    $now = time();           
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Your session has expire!</h4>
        <p><a href='index.php'>Login Here</a></p></div>";
        exit;
        }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Adicionar Cliente</title>
</head>

<body>
    
    <div class="container">
        <div clas="span10 offset1">
          <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Cliente </h3>
            </div>
            <div class="card-body">
            <form class="form-horizontal" action="create.php" method="post">

                <div class="control-group <?php echo !empty($nomeErro)?'error ' : '';?>">
                    <label class="control-label">Nome</label>
                    <div class="controls">
                        <input size="50" class="form-control" name="nome" type="text" placeholder="Nome" required="" value="<?php echo !empty($nome)?$nome: '';?>">
                        <?php if(!empty($nomeErro)): ?>
                            <span class="help-inline"><?php echo $nomeErro;?></span>
                            <?php endif;?>
                    </div>
                </div>



                <div class="control-group <?php echo !empty($valorErro)?'error ': '';?>">
                    <label class="control-label">Valor</label>
                    <div class="controls">
                        <input size="20" class="form-control" name="valor" type="number" placeholder="valor" required="" value="<?php echo !empty($valor)?$valor: '';?>">
                        <?php if(!empty($valorErro)): ?>
                            <span class="help-inline"><?php echo $valorErro;?></span>
                            <?php endif;?>
                    </div>

                <div class="control-group <?php echo !empty($valorErro)?'error ': '';?>">
                    <label class="control-label">Valor Mensal</label>
                    <div class="controls">
                        <input size="20" class="form-control" name="mensal" type="number" placeholder="valor mensal" required="" value="<?php echo !empty($mensal)?$mensal: '';?>">
                        <?php if(!empty($valorErro)): ?>
                            <span class="help-inline"><?php echo $valorErro;?></span>
                            <?php endif;?>
                    </div>

                    <div class="control-group <?php echo !empty($dataErro)?'error ': '';?>">
                    <label class="control-label">Data</label>
                    <div class="controls">
                        <input size="20" class="form-control" name="data" type="date" placeholder="Data" required="" value="<?php echo !empty($data)?$data: '';?>">
                        <?php if(!empty($dataErro)): ?>
                            <span class="help-inline"><?php echo $dataErro;?></span>
                            <?php endif;?>
                    </div>
                

                </div>

                
                <div class="form-actions">
                    <br/>

                    <button type="submit" class="btn btn-success">Adicionar</button>
                    <a href="inicio.php" type="btn" class="btn btn-default">Voltar</a>

                </div>
            </form>
          </div>
        </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>

<?php
    require 'banco.php';

    if(!empty($_POST))
    {
        //Acompanha os erros de validação
        $nomeErro = null;
        $valorErro = null;
        $mensalErro = null;
        $dataErro = null;
 

        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $mensal = $_POST['mensal'];
        $data = $_POST['data'];
        $total = $_POST['total'];

       

        //Validaçao dos campos:
        $validacao = true;
        if(empty($nome))
        {
            $nomeErro = 'Por favor digite o seu nome!';
            $validacao = false;
        }

        if(empty($valor))
        {
            $valorError = 'Por favor digite o valor';
            $validacao = false;
        }
        if(empty($data))
        {
            $dataError = 'Por favor digite a data';
            $validacao = false;
        }

        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO pessoa (nome, valor, mensal, data) VALUES(?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$valor,$mensal,$data));
            Banco::desconectar();
            header("Location: inicio.php");
        }
    }
?>
