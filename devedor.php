<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>

<body>
        <div class="container">
          <div class="jumbotron">
            <div class="row">
                <h2><img src="shark.png">Løan$hark® - WEB  <span class="badge badge-secondary">v 1.0.0</span></h2>

            </div>
          </div>
            </br>
            <div class="row">
                <p>
                    <a href="read.php" class="btn btn-success">Inicio</a>
                    <a href="create.php" class="btn btn-success">Adicionar</a>
                    <a href="create.php" class="btn btn-success">listar</a>
                    <a href="stats.php" class="btn btn-success">Estatística</a>
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Valor Mensal</th>
                            <th scope="col">Data</th>
                            <th scope="col">Total Pago</th>
                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * from pessoa where data between date_add(current_date, interval -7 day) and curdate()';

                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<tr>';
			                echo '<th scope="row">'. $row['id'] . '</th>';
                            echo '<td>'. $row['nome'] . '</td>';
                            echo '<td>'. $row['valor'] . '</td>';
                            echo '<td>'. $row['mensal'] . '</td>';
                            echo '<td>'. $row['data'] . '</td>';
                            echo '<td>'. $row['recebido'] . '</td>';


                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update.php?id='.$row['id'].'">Pagar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Quitar</a>';
                            echo '</td>';
                            echo '</tr>';
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
