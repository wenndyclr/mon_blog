
<?php 

if(isset($_GET['id']) && array_key_exists ($_GET['id'], $array_content)){ //On vérifie si l'id existe dans le tableau $array_content)
    if($_GET['id']<100){
        $dir = './view/';
    } else {
        $dir = './app/';
    }
    
    require  $dir . $array_content[$_GET['id']] . '.php';
}else{
    require './view/' . $array_content[1] . '.php';
}