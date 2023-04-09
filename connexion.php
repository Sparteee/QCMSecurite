<?php
define("SERVEUR","localhost");
define("USER","USER");
define("MDP","PASSWORD");
define("BD","projetqcm");
try {
    $connexion= new PDO('mysql:host='.SERVEUR.';dbname='.BD, USER, MDP);
    $connexion->exec("SET CHARACTER SET utf8");
    $connexion -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

}
catch(Exception $e) {
    echo 'Erreur : '.$e->getMessage().'
';
    echo 'N° : '.$e->getCode();
}

?>