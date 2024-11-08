<?php
function connect($config){
    try{
        $db= new PDO('mysql:host='.$config['serveur'].';dbname='.$config['bd'],$config['login'],
        $config['mdp']);
    }
    catch(exception $e){
        $db=NULL;
    }
    return $db;
}