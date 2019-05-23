<?php
/**
 * Connects to the DB
 * 
 * @return PDO The connection to the DB
 */
function dbConnect(){    
    $dbname = 'mon_blog';
    $user = 'root';
    $password = '';    

    try{
        $connexion = new PDO('mysql:host=localhost;dbname='.$dbname, $user,$password);
        return $connexion;
    }catch (PDOExeption $e){
        print 'Erreur'.$e->getMessage().'<br/>';
    }
}
