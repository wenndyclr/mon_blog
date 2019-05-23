<?php
// var_dump($_POST);
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    
        $connexion = dbConnect();
        $user=$connexion->prepare('SELECT * FROM blog_user WHERE u_email=:u_email');
        $user->bindValue(':u_email', $_POST['email'],  PDO::PARAM_STR);
        $user->execute();
        $sql=$user->fetchAll(PDO::FETCH_OBJ);
 
        $password_verify=password_verify(($_POST['password']), $sql[0]->u_password);
       
        if(!empty($sql) && $password_verify){
            $_SESSION['user']= $sql[0]->u_email;
            
            // header('location: index.php?id=1');
            
        }else{
            // echo 'Votre email ou votre mot de passe est incorrect';
        }

}

var_dump($_SESSION['user']);