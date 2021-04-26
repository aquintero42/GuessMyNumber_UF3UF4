/*
 * XMLHttpRequest es un objeto JavaScript que fue diseñado por Microsoft y
 * adoptado por Mozilla, Apple y Google.
 *
 * Actualmente es un estándar de la W3C.
 *
 * Proporciona una forma fácil de obtener información de una URL sin tener
 * que recargar la página completa.
 *
 * Una página web puede actualizar sólo una parte de la página sin interrumpir
 * lo que el usuario está haciendo. XMLHttpRequest es ampliamente usado en la
 * programación AJAX.
 *
 * A pesar de su nombre, XMLHttpRequest puede ser usado para recibir cualquier
 * tipo de dato, no solo XML, y admite otros formatos además de HTTP
 * (incluyendo file y ftp).
 *
 * XMLHttpRequest soporta tanto comunicaciones síncronas como asíncronas.
 *
 * No deberias usar XMLHttpRequests síncronas porque, dada la naturaleza
 * inherentemente asíncrona del intercambio de datos en las redes,
 * hay multiples formas en que la memoria y eventos se puedan perder usando
 * solicitudes síncronas.
 *
 * Asynch call
 */
function showEstadistiques(value) {
  var xmlhttp = new XMLHttpRequest();
  /*
   * Una función del objeto JavaScript que se llama cuando el atributo
   * readyState cambia.
   * El callback se llama desde la interfaz del usuario.
   *
   * @returns {undefined}
   */
  xmlhttp.onreadystatechange = function () {
    getResponse(this);
  };
  xmlhttp.open("GET", "getestadistiques.php?modalitat=" + value, true);
  xmlhttp.send();
}

function getResponse($response) {
  /*
   * readyState = 4 COMPLETED, La operacioón esta terminada.
   * status = 200 OK.
   * responseText La respuesta al pedido como texto, o null si el pedido no
   * fue exitoso o todavía no se envió. Sólo lectura.
   */
  if ($response.readyState == 4 && $response.status == 200) {
    document.getElementById("taula_estadistiques_id").innerHTML =
      $response.responseText;
  }
}

function deleteEstadistiques(value) {
  var xmlhttp2 = new XMLHttpRequest();

  xmlhttp2.open("GET", "getestadistiques.php?id=" + value, true);
  xmlhttp2.send();
}
