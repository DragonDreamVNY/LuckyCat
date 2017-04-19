<?php

function sanitizeString($var){
    // apply stripslashes if magic_quotes_gpc is enabled
    if (get_magic_quotes_gpc()){  $var = stripcslashes($var) ; }
    // remove whitespaces
    $var = trim($var); 
    $var = htmlentities($var);
    $var = strip_tags($var);
    return $var;
} //end Sanitize String

// a mySQL connection is required before using this function
function sanitizeMySQL($var){
        $var = mysqli_real_escape_string($var);
        $var = sanitizeString($var);
        return $var;
} // end sanitize MySQL

?>