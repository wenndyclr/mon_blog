<?php 
$arr_articles = home_getArticles();
// echo '<pre>';
// var_dump($arr_articles);
// echo '</pre>'; ?>
<div class="container">
    <div class="row padding_top">
<?php foreach($arr_articles as $v): ?>
        <div class="col-md-4 ">
            <div class="col_cst">
                <h1 class="white"><?= $v->p_title ?> </h1>
                <img src="images">
                <p class="gray"><?=$v->p_content ?><p>
            </div>
        </div>
<?php endforeach ?>
    </div>
</div>


