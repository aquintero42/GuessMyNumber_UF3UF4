<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>UF4 Ejercici 1</title>
        <link rel="stylesheet" href="css/mystyle.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
            function windowCredits() {
                //window.open("./credits.txt", "", "width=200,height=100");
                window.open("./credits.txt","","height=200,width=400,scrollbars=no");
            }
            windowCredits();
        </script>        
        <script src="js/my_functions.js"></script>
    </head>
    <body onload="showEstadistiques('Totes')">
        <h2>Registro de la tabla 'estadístiques'</h2>
        <h1>MP07 UF3-UF4 (Tècniques d'accés a dades i serveis web)</h1>    
        <?php      
        include_once 'DB/DatabaseOOP.php';

        $credits = fopen("credits.txt", "w+") or die("Unable to open file!");
        $txtName = "Nombre: Adrian Quintero Gimenez\n";
        $txtEmail = "Email: adri.bcn.98@gmail.com\n";
        $txtDate = "Fecha de hoy: ".date("F d Y H:i:s", filemtime("credits.txt"));
        fwrite($credits, $txtName);
        fwrite($credits, $txtEmail);
        fwrite($credits, $txtDate);       
        fclose($credits);

        $db = new DatabaseOOP("localhost", "administrador", "admin", "m07uf3");
        $db->connect();
        $modalitat = null;
        $result = $db->selectByModalitat($modalitat);
        ?>
        <form>
            <label>Modalitats:</label>
            <select class="dropdown-content" name="modalitats" onchange="showEstadistiques(this.value)">
                <option value="Totes">Totes</option>
                <option value="Huma">Huma</option>
                <option value="Maquina">Maquina</option>
            </select>
        </form>
        <br>
        <div id="taula_estadistiques_id"></div>        
    </body>
</html>
