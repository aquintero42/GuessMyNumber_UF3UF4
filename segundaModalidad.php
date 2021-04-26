<?php
  require('guessMyNumber.php');
  include_once 'DB/DatabaseOOP.php';

  class GameSegundaModalidad extends GuessMyNumber { 

    function check_secretNumber($nivell) {
      if ( !isset($_SESSION["secretNumber"]) ) {
        $_SESSION["secretNumber"] = rand(1,$nivell);
      }  
    }

    function check_fnumber() {
      if (isset($_POST['fnumber'])) {
        $_SESSION['number'] = htmlspecialchars($_POST['fnumber']);
      } else {
        $_SESSION['number'] = null;
      }      
    }

  }

  $_SESSION['posibilidad'] = $_POST['posibilidad'];
  $nivell = $_SESSION['posibilidad'];
  $segundaModalidad = new GameSegundaModalidad($nivell);
  $segundaModalidad->check_secretNumber($nivell);
  $db = new DatabaseOOP("localhost:3306", "administrador", "admin", "m07uf3");
  $db->connect();
?>
<!DOCTYPE HTML>
<html>
  <head>
      <meta charset="utf-8">
      <title>Segunda modalidad</title>
      <link rel="stylesheet" href="./style.css">
  </head>
  <body>
    <h1 class="tituloModalidad">Segunda modalidad</h1>
    <div id="formularioSegundaModalidad">
      <h4>Introduce un número del 1 al <?= $_SESSION["posibilidad"] ?></h2>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <!--Número: <input type="text" name="fnumber">-->
      <input type="number" name="fnumber" min="1" max="<?= $_SESSION["posibilidad"] ?>" required>
      <input type="hidden" name="posibilidad" value="<?= $_POST['posibilidad'] ?>">
      <input type="submit" name="submit" value="Confirmar" class="button" id="botonConfirmar">
      <?php
        $segundaModalidad->check_intentos();
        $segundaModalidad->check_fnumber();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_SESSION['number'])) {
            echo "<br> No puedes introducir un campo vacío";
          } else {
            if ($_SESSION['number'] == $_SESSION['secretNumber']) {
              $segundaModalidad->sumar_intentos();
              echo "<br> Has acertado el número " . $_SESSION['secretNumber'] . "<br>";
              echo "Intentos: " . $_SESSION['intentos'] . "<br>";
              $last_record = $db->insert(ModalitatEnum::MAQUINA, $nivell, $_SESSION['intentos']);
              echo "<p>Registro $last_record inseritado correctamente</p>";
            } elseif ($_SESSION['number'] > $_SESSION['secretNumber']) {
              echo "<br> El número a adivinar es más pequeño que " . $_SESSION['number'];
              $segundaModalidad->sumar_intentos();
            } elseif ($_SESSION['number'] < $_SESSION['secretNumber']) {
              echo "<br> El número a adivinar es más grande que " . $_SESSION['number'];
              $segundaModalidad->sumar_intentos();
            }
          } 
        }

        if ( isset($_POST['volverIndice']) ) {
          $segundaModalidad->volverIndice();    
        }
      ?>

      </form>
      <form action="" method="POST">
      <button type='submit' name='volverIndice' value='volverIndice' class="button" id="volverAJugar">Volver a selección de modalidad</button>
      <?php
        if ( isset($_POST['volverIndice']) ) {
          $segundaModalidad->volverIndice();
        }      
      ?>
    </form>      
    </div>
  </body>
</html>