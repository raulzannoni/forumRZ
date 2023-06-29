<?php

$categories = $result["data"]['categories'];

var_dump($categories);
    
?>

<div class="categoriesMain">
    <h1 class="titleUnderline">List of Categories</h1>
        <div class="categoriesDiv">
            <?php
            
            foreach($categories as $category){
                var_dump($category);
                
                ?>
                <p><?=$category->getName()?></p>
                <?php
            }
            
            ?>
        </div>
</div>