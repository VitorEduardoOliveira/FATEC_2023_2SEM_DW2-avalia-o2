<?php
    require_once('header.php');
    require_once('dados_banco.php');

    //session_start();

    if (!isset($_SESSION['online']) || !$_SESSION['online']) {
        header("location: index.php");
        exit;
    }

    try {
        $dsn = "mysql:host=$servername;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM veiculos";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $stmt = $conn->query($sql);
    $conn = NULL;
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Portaria Fatec</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h2>
            <?php echo $_SESSION["username"]; ?>
            <br>
        </h2>
    </div>
    <p>
        <label>Selecione a placa</label>
        <br>
        <form action="registros_encontrados.php" method="POST">
            <select name="placa_id">
                <?php
                while ($row = $stmt->fetch()) {
                    echo "<option value=" . $row['id'] . ">" . $row['placa'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" class="btn btn-primary" value="Acessar">
        </form>
    </p>
    <a href="principal.php" class="btn btn-primary">Voltar</a>
    <br><br>
</body>
</html>
