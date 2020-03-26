<?php
session_start();
    require 'banco.php';
    $id = null;
    if(!empty($_GET['id']))
    {
        $id = $_REQUEST['id'];
    }

    if(null==$id)
    {
        header("Location: index.php");
    }
    else
    {
       $pdo = Banco::conectar();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM pessoa where id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       Banco::desconectar();
    }
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Informações do Cliente</title>
    </head>

    <body>
        <?php
    if (isset($_SESSION['loggedin'])) {  
    }
    else {
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>You need to login to access this page.</h4>
        <p><a href='login.php'>Login Here!</a></p></div>";
        exit;
    }
    // checking the time now when check-login.php page starts
    $now = time();           
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "<div class='alert alert-danger mt-4' role='alert'>
        <h4>Your session has expire!</h4>
        <p><a href='inicio.php'>Login Here</a></p></div>";
        exit;
        }
    ?>
    
        <div class="container">
            <div class="span10 offset1">
                  <div class="card">
    								<div class="card-header">
                    <h3 class="well">Informações do Cliente</h3>
                </div>
                <div class="container">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Nome</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['nome'];?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Valor</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['valor'];?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Mensal</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['mensal'];?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Data</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['data'];?>
                            </label>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Total Pago</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['recebido'];?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Quitado</label>
                        <div class="controls">
                            <label class="carousel-inner">
                                <?php echo $data['quitado'];?>
                            </label>
                        </div>
                    </div>


                    </div>
                    <br/>
                    <div class="form-actions">
                        <a href="inicio.php" type="btn" class="btn btn-default">Voltar</a>
                    </div>
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
