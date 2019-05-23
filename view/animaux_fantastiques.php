<?php 
if(!isset($_GET['page'])){
    $currentPage = 1;
} else {
    $currentPage = $_GET['page'];
}

$sqlCategorie1 = cat_getArticles(3,$currentPage);
// echo '<pre>';
//    print_r($sqlCategorie1); 
//    echo '</pre>'; ?>

<div class="container">
    <div class="row padding_top">
<?php foreach($sqlCategorie1 as $v): ?>

        <div class="col-md-4 ">
            <div class="col_cst">
                <h1 class="white"><?= $v->p_title ?> </h1>
                <p class="gray"><?=$v->p_content ?><p>
            </div>
        </div>
<?php endforeach ?>
    </div>
</div>