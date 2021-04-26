<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registros tabla estadistiques</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            function windowCredits() {
                window.open("./credits.txt","","height=200,width=400,scrollbars=no");
            }
            windowCredits();
        </script>
    </head>
    <body>
        <h2>Registro de la tabla 'estadístiques'</h2>
        <h1>MP07 UF3 (Tècniques d'accés a dades)</h1>
        <?php
        session_start();
        include_once 'DB/EstadistiquesRow.php';
        include_once 'DB/DatabaseOOP.php';

        $credits = fopen("credits.txt", "w+") or die("Unable to open file!");
        $txtName = "Nombre: Adrian Quintero Gimenez\n";
        $txtEmail = "Email: adri.bcn.98@gmail.com\n";
        $txtDate = "Fecha de hoy: ".date("F d Y H:i:s", filemtime("credits.txt"));
        fwrite($credits, $txtName);
        fwrite($credits, $txtEmail);
        fwrite($credits, $txtDate);       
        fclose($credits);
        
        $db = null;
        try {
            $db = new DatabaseOOP("localhost:3306", "administrador", "admin", "m07uf3");
            $db->connect();
            echo DatabaseOOP::TABLE_START;
            $stmt = $db->selectAll();
            foreach (new EstadistiquesRow(new RecursiveArrayIterator($row = $stmt->fetch_all(MYSQLI_ASSOC))) as $key => $row) {
                echo $row;
            }
        } catch (Exception $error) {
            echo "connection failed: " . $error->getMessage();
        }
        DatabaseOOP::TABLE_END
        ?>

    </body>
</html>
