<?php //Ici il y aura toutes mes fonctions

/**
 * 
 */
define('MAXARTBYPAGE', 10);

 function home_getArticles(){
     return getArticles(null, 0, 3);
};

 function cat_getArticles($categorie_id, $num_page){
    return getArticles($categorie_id, ($num_page-1) * MAXARTBYPAGE);
 };


function getArticles($categorieId=null, $offset=0, $limit= MAXARTBYPAGE){ // offset : à partir de quel élément, limite : nombre d'élément qu'on retourne
   $connexion = dbConnect();

   $sql = 'SELECT * FROM blog_post';
   if(!is_null($categorieId)){
      $sql.= ' WHERE p_fk_category_id = :p_fk_category_id';
   }
   $sql.= ' ORDER BY p_id DESC LIMIT :limit OFFSET :offset';

   $sqlCat1 = $connexion->prepare($sql);
   if(!is_null($categorieId)){
      $sqlCat1->bindValue(':p_fk_category_id', $categorieId, PDO::PARAM_INT);
   }
   $sqlCat1->bindValue(':limit', $limit, PDO::PARAM_INT);
   $sqlCat1->bindValue(':offset', $offset, PDO::PARAM_INT);
   $sqlCat1->execute();
   $results = $sqlCat1->fetchAll(PDO::FETCH_OBJ);

   /*
   echo '<pre>';
   print_r($sqlCategorie1); 
   echo '</pre>'; ?>
   */

   return $results;
};




