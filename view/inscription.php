<span class="error">
    <?php
        if(isset($_GET['error'])){
            echo $array_errors[$_GET['error']];
        } 
    ?>
</span>
<span class="warning">
    <?php
        if(isset($_GET['warning'])){
            echo $array_errors[$_GET['error']];
        } 
    ?>
</span>
<span class="success">
    <?php
        if(isset($_GET['success'])){
            echo $array_errors[$_GET['error']];
        } 
    ?>
</span>

<form action="./index.php?id=100" method="POST" enctype="multipart/form-data">
    <Label>Votre email </Label>
    <input type="email" name="email" placeholder="email" require>

    <Label>Votre MDP</Label>
    <input type="password" name="password" placeholder="Votre MDP" require>

    <Label>Votre prénom moldus</Label>
    <input type="text" name="name" placeholder="Votre nom moldus" require>

    <Label>Votre nom de sorcier</Label>
    <input type="text" name="surname" placeholder="Votre nom de sorcier" require>

    <Label>Avatar</Label>
    <input type="file" name="avatar" placeholder="Votre avatar">
    
    <Label>Date d'anniversaire</Label>
    <input type="date" name="date">


    <button type="submit">Envoyer</button>

</form>