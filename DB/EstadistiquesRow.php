<?php

/**
 * Iterador recursiu de taules
 *
 * @author Pep
 */
class EstadistiquesRow extends RecursiveIteratorIterator {

    function __construct($it) {
        parent::__construct($it);
    }

    function current() {
        return "<td style='width:150px;border:1px solid blue;background:silver;'>" . parent::current() . "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        //echo "<td style='padding:0px;width:50px;border:1px solid blue;background:silver;'><button id='deleteField' onclick='deleteEstadistiques(this)'>Delete</button></td>";        
        echo "</tr>" . "\n"; 
    }

}
