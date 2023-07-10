<?php

$categories = $result["data"]['categories'];

var_dump($categories);
    
?>

<div class="categoriesMain">
    <h1 class="titleUnderline">List of Categories</h1>
        <div class="categoriesDiv">
            <?php

            foreach($categories as $category)
                {  
                    //var_dump($category);
                    if($category->getNbTopics() > 0) { ?>
                        <tr>
                            <td><a class="categoryLink" href="index.php?ctrl=form&action=listTopicByCategory&id=<?= $category->getId() ?>"><?=$category->getName()?></a></td>
                            <td>(<?=$category->getNbTopics()?>)</td>
                        </tr>
                <?php   }
                    else    { ?>
                        <tr>
                            <td><a class="categoryLinkDisabled"><?=$category->getName()?></a></td>
                        </tr>
                <?php   } 
                }?>
        </div>
</div>