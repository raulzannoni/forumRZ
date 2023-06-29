<?php

$topics = $result["data"]['topics'];

$posts = $result["data"]['posts'];

$categories = $result["data"]['categories'];

$totalCountTopics = $result["data"]['totalCountTopics'];
?>

<h1>List of Topics</h1>

<?php
foreach($topics as $topic){
    ?>
    <p><?=$topic->getTitle()?></p>
    <?php
}


  
