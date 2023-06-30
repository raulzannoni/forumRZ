<?php

$categories = $result["data"]['categories'];

var_dump($categories);
    
?>

<div class="categoriesMain">
    <h1 class="titleUnderline">List of Categories</h1>
        <div class="categoriesDiv">
            <?php
            
            foreach($categories as $category){
                if($category->getNbTopics() > 0) {
                    ?>
                    <a class="categoryLink" href="" ><?=ucfirst($category->getName())?>
                        <br class="displayedPc">
                            <span class="opacityPc">(</span>
                                <?= $category->getNbTopics() ?>
                            <span class="opacityPc">)</span>
                        <br>
                    </a>
                    <?php
                    }
                else {
                    ?>
                    <p class="categoryLinkDisabled"><?= ucfirst($category->getName())?>
                        <br class="displayedPc">
                            <span class="opacityPc">(</span>
                                <?= $category->getNbTopics() ?>
                            <span class="opacityPc">)</span></p>
                    <?php
                    }
                }
            
            ?>
        </div>
</div>