 

<?php

include 'banco.php';
$id = 0;
$pdo = Banco::conectar();
if(!empty($_GET['id']))
{
    $id = $_REQUEST['id'];
    #$data = $_REQUEST['data'];
    #$quitado = $_REQUEST['quitado'];
}

if(!empty($_POST))
{
    $id = $_POST['id'];
    $data = $_POST['data'];
    $quitado = $_POST['quitado'];
    $mensal = $_POST['mensal'];

    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE pessoa set data = '0000-00-00', quitado = 'sim', mensal = '000' WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Banco::desconectar();
    header("Location: inicio.php");
}
?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <title>Deletar Contato</title>
    </head>

    <body>
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
        <div class="container">
            <div class="span10 offset1">
                <div class="row">
                    <h3 class="well">Quitar Contrato</h3>
                </div>
                <form class="form-horizontal" action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>" />
                    <div class="alert alert-danger"> Deseja quitar o contrato?
                    </div>
                    <div class="form actions">
                        <button type="submit" class="btn btn-danger">QUITAR</button>
                        <a href="inicio.php" type="btn" class="btn btn-default">RETORNA</a>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

    </html>
