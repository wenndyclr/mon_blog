<?php

if (isset($_POST) && !empty($_POST)){
    
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        
        $connexion = dbConnect();
        $userEmail=$connexion->prepare('SELECT * FROM blog_user WHERE u_email=:u_email');
        $userEmail->bindValue(':u_email', $_POST['email'],  PDO::PARAM_STR);
        $userEmail->execute();
        $sqlEmail=$userEmail->fetchAll();

        if(empty($sqlEmail)){

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $hasAvatar = false;

            //Je mets des conditions d'image pour les images d'avatar
            if(!empty($_FILES)){
            
                // echo '<pre>';
                // var_dump($_FILES);
                // echo '</pre>';
                // var_dump($_FILES['avatar']['error']);
                if($_FILES['avatar']['error']===0){
                        $maxSize = 1000*1024;
                        if($_FILES['avatar']['size'] <= $maxSize){
                            
                            $fileInfo = pathinfo($_FILES['avatar']['name']);
                            
                            $extension = strtolower($fileInfo['extension']);
                            $extensions_autorisees=['jpg', 'jpeg'];

                            if(in_array($extension, $extensions_autorisees)){
                                $image_name = md5(uniqid(rand(), true));
                                
                                $config_miniature_width = 150;

                                // Copie de l'image d'origine (qui est dans un répertoire temporaire de PHP)
                                $new_image = imagecreatefromjpeg($_FILES['avatar']['tmp_name']);

                                // Détermine les tailles de l'image ,d'origine
                                $original_width= imagesx($new_image);
                                $original_height= imagesy($new_image);

                                // On calcule la proportionnelle en hauteur par rapport à une largeur de "150"
                                $miniature_height = ($original_height * $config_miniature_width) / $original_width;

                                // On crée une image VIDE miniature aux dimensions proportionnelles à l'origine avec une largeur de "150"
                                $miniature = imagecreatetruecolor($config_miniature_width, $miniature_height); 

                                // On colle l'image d'origine dans la miniature et on la redimensionne aux dimensions de la miniature
                                imagecopyresampled($miniature,  
                                                $new_image,
                                                0, 0, 0, 0,
                                                $config_miniature_width,
                                                $miniature_height,
                                                $original_width,
                                                $original_height);
                            
                                // On détermine le chemin de destination des miniatures
                                $folder = './images/miniatures/';

                                // On sauvegarde l'image miniature au bon endroit
                                imagejpeg($miniature, $folder . $image_name . '.' . $extension);

                                move_uploaded_file($_FILES['avatar']['tmp_name'], './images/' .$image_name . '.' . $extension);

                                $hasAvatar = true;
                            }
                        }

                }
            }

            $connexion = dbConnect();

            $sql = 'INSERT INTO blog_user (u_email, u_password, u_name, u_surname,';
            if($hasAvatar){
                $sql .= ' u_avatar,';
            } 
            $sql .= ' u_dob) VALUES (:u_email, :u_password, :u_name, :u_surname, ';
            if($hasAvatar){
                $sql .= ':u_avatar,';
            } 
            $sql .= ':u_dob)';

            $user=$connexion->prepare($sql);

            $user->bindValue(':u_email', $_POST['email'], PDO::PARAM_STR);
            $user->bindValue(':u_password', $password, PDO::PARAM_STR);
            $user->bindValue(':u_name', $_POST['name'], PDO::PARAM_STR);
            $user->bindValue(':u_surname', $_POST['surname'], PDO::PARAM_STR);
            if($hasAvatar){
                $user->bindValue(':u_avatar', $image_name . '.' . $extension, PDO::PARAM_STR);
            }
            $user->bindValue(':u_dob', $_POST['date'], PDO::PARAM_STR);

            $user->execute();
        } else {
            echo "email déjà présent";
        }
       
    } else {
        header('location: index.php?id=5&error=1');
    }
}