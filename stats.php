<!DOCTYPE html>
<?php
session_start();
?>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>

<body>
    <?php
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
          <div class="jumbotron">
            <div class="row">
                <h2><img src="shark.png">Løan$hark® - WEB  <span class="badge badge-secondary">v 1.0.0</span></h2>

            </div>
          </div>
            </br>
            <div class="row">
                <p>
                    <a href="inicio.php" class="btn btn-success">Inicio</a>
                    <a href="create.php" class="btn btn-success">Adicionar</a>
                    <a href="listar.php" class="btn btn-success">Listar</a>
                    <a href="stats.php" class="btn btn-success">Estatística</a>
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                           
                            <th scope="col">Total investido</th>
                            <th scope="col">Total a Receber</th>
                            <th scope="col">Lucro</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        
                        $sql = 'SELECT SUM(valor)total_investido FROM pessoa ORDER BY id DESC';

                        foreach($pdo->query($sql)as $row)
                        {
                            

                            echo '<td>'. $row['total_investido'] . '</td>';

                        }

                        $sql = 'SELECT SUM(mensal)total_receber FROM pessoa ORDER BY id DESC';

                        foreach($pdo->query($sql)as $row)
                        {
                         

                            echo '<td>'. $row['total_receber'] . '</td>';

                        }

                        $sql = 'SELECT SUM(recebido)total_recebido FROM pessoa ORDER BY id DESC';



                        foreach($pdo->query($sql)as $row)
                        {
                         

                            echo '<td>'. $row['total_recebido'] . '</td>';

                        }

                        

                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
