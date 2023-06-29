<?php

$topics = $result["data"]['topics'];

$posts = $result["data"]['posts'];

$categories = $result["data"]['categories'];

$totalCountTopics = $result["data"]['totalCountTopics'];

var_dump($topics);
?>

<div class="topicsMain">
    <h1 class="titleUnderline">List of Topics</h1>
        <div class="topicsDiv">
            <?php
            
            foreach($topics as $topic){
                var_dump($topic);
                
                ?>
                <p><?=$topic?></p>
                <?php
            }
            
            ?>
        </div>
</div>
