<?php
  session_start();
  abstract class GuessMyNumber {
    public $nivell;

    function __construct($nivell) {
      $this->nivell = $nivell;
    }

    function set_nivell($nivell) {
      $this->nivell = $nivell;
    }

    function get_nivell() {
      return $this->nivell;
    }

    function check_intentos() {
      if (!isset($_SESSION['intentos'])) { 
        $_SESSION['intentos'] = 0;
      }
    }

    function sumar_intentos() {
      if (isset($_SESSION['intentos'])) {
        $_SESSION['intentos'] = $_SESSION['intentos']+1;
      }
    }

    function volverIndice() {
      session_unset();
      session_destroy();
      header("Location: index.php");       
    }
    
  }
?>