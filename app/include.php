<?php 
require 'toolbox.php';
require 'bdd.php';

/**
 * Routing
 */

/* Views */
$array_content[1]='home';
$array_content[2]='jk_rolling';
$array_content[3]='harry_potter';
$array_content[4]='animaux_fantastiques';
$array_content[5]='inscription';
$array_content[6]='connexion';
$array_content[7]='contact';

/* Treatment pages : must be > 100 */
$array_content[100] = 'inscription_back';
$array_content[101] = 'connexion_back';

/**
 * Errors
*/

$array_errors[1] = 'Email incorrect !';