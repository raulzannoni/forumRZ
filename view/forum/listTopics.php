<?php

$topics = $result["data"]['topics'];

$posts = $result["data"]['posts'];

$categories = $result["data"]['categories'];

$totalCountTopics = $result["data"]['totalCountTopics'];

?>

<div class="topicsMain">
    <h1 class="titleUnderline">List of Topics</h1>
        <div class="topicsDiv">
            <?php
            
            if(!empty($topics))
                {
                    foreach($topics as $topic){
                        var_dump($topic);
                        
                        ?>
                        <p><?=$topic->getTitle()?></p>
                        <?php
                    }
                }
            else 
                { ?>
                    <p>Aucun résultat :/</p>
        <?php   }
            ?>
        </div>
</div>
