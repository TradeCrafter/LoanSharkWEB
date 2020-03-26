<?php

	require 'banco.php';

	$id = null;


	if ( !empty($_GET['id']))
            {
		$id = $_REQUEST['id'];
            }

	if ( null==$id )
            {
		header("Location: index.php");
            }

	if ( !empty($_POST))
            {

		$nomeErro = null;
		$mensalErro = null;
		$dataErro = null;
        $recebidoErro = null;
        $receberErro = null;
        

        $nome = $_POST['nome'];
        $mensal = $_POST['mensal'];
        $data = $_POST['data'];
        $recebido = $_POST['recebido'];
        $receber = $_POST['receber'];

		//Validação
		$validacao = true;
		if (empty($nome))
                {
                    $nomeErro = 'Por favor digite o nome!';
                    $validacao = false;
                }

		if (empty($mensal))
                {
                    $mensalErro = 'Por favor digite o valor!';
                    $validacao = false;
		}

		if (empty($data))
                {
                    $dataErro = 'Por favor digite a data!';
                    $validacao = false;
		}

        if (empty($recebido))
                {
                    $recebidoErro = 'Por favor digite o valor!';
                    $validacao = false;
		}

        if (empty($receber))
                {
                    $receberErro = 'Por favor digite o valor!';
                    $validacao = false;
        }
        

		// update data
		if ($validacao)
                {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE pessoa set data = ?, recebido = ? + $receber WHERE id = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($data,$recebido,$id));
                    Banco::desconectar();
                    header("Location: inicio.php");
		}
	}

        else
            {
                $pdo = Banco::conectar();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM pessoa where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
        $data = $q->fetchAll();
foreach ($data as $raw) {
    $nome = $raw['nome'];
    $mensal = $raw['mensal'];
    $data = $raw['data'];
    $recebido = $raw['recebido'];
    $receber = $raw['receber'];
}
		#$data = $q->fetch(PDO::FETCH_ASSOC);
       # var_dump($data);exit#
        # print_r($data);
		#$nome = $data['nome'];
      #  $mensal = $data['mensal'];
       # $data = $data['data'];
        #$recebido = $data['recebido'];
		Banco::desconectar();
	}




?>
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
				<title>Atualizar Contato</title>
    </head>

    <body>
 

        <div class="container">

            <div class="span10 offset1">
							<div class="card">
								<div class="card-header">
                    <h3 class="well"> Atualizar Contato </h3>
                </div>
								<div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">

                    <div class="control-group <?php echo !empty($nomeErro)?'error':'';?>">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" value="<?php echo !empty($nome)?$nome:'';?>">
                            
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($enderecoErro)?'error':'';?>">
                        <label class="control-label">Mensal</label>
                        <div class="controls">
                            <input name="mensal" class="form-control" size="80" type="numer" placeholder="Pagamento" value="<?php echo !empty($mensal)?$mensal:'';?>">
                            
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($telefoneErro)?'error':'';?>">
                        <label class="control-label">Data</label>
                        <div class="controls">
                            <input name="data" class="form-control" size="30" type="date" placeholder="Data" value="<?php echo !empty($data)?$data:'';?>">
                            
                        </div>
                    </div>
                    <div class="control-group <?php echo !empty($recebidoErro)?'error':'';?>">
                        <label class="control-label">Receber</label>
                        <div class="controls">
                            <input name="receber" class="form-control" size="30" type="number" placeholder="receber" value="<?php echo !empty($receber)?$receber:'';?>">
                            
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($receberErro)?'error':'';?>">
                        <label class="control-label">Recebido</label>
                        <div class="controls">
                            <input name="recebido" class="form-control" size="30" type="number" placeholder="recebido" value="<?php echo !empty($recebido)?$recebido:'';?>">
                            
                        </div>
                    </div>

                    
                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">Pagar</button>
                        <a href="inicio.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
                </form>
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
