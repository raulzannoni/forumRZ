<?php

    $topics = $result["data"]['topics'];
    //$posts = $result["data"]['posts'];
    $categories = $result["data"]['categories'];
    $totalCountTopics = $result["data"]['totalCountTopics'];

    $nbTopicsEachCat = $result["data"]['nbTopicsEachCat'];

    $categoryName = (isset($result["data"]["categoryName"])) ? 
        $result["data"]["categoryName"] :
        "";

    $category = (isset($result["data"]["category"])) ?
        $result["data"]["category"] :
        "";

    $resPluSing = ($totalCountTopics["count"] == 1) ? "result" : "results";

    var_dump($topics);
    //var_dump($posts);
    //var_dump($categories);
    //var_dump($totalCountTopics);
    

    if(!empty($result["data"]["title"]) && $result["data"]["title"] == "Search") 
        { ?>
            <div class="titleDiv">
                <h1 class="titleUnderline">Search "<?= $result["data"]["searchText"] ?>"</h1>
                <span>(<?= $totalCountTopics["count"] ?> <?=$resPluSing?>) <?= $categoryName ?></span>
            </div>
<?php   }
    else if(($result["data"]["title"] == "List of Topics") || (empty($result["data"]["title"])))
        {?>
            <div class="titleDiv">
                <h1 class="titleUnderline">List of Topics</h1>
                <span>(<?= $totalCountTopics["count"] ?> <?=$resPluSing?>)</span>
            </div>
<?php   }
    else if (($result["data"]["title"] == "List of Topics by Category") || (empty($result["data"]["title"]))) 
        {?>
        <div class="titleDiv">
            <h1 class="titleUnderline"><?= $categoryName ?></h1>
            <span> (<?= $totalCountTopics["count"] ?> <?=$resPluSing?>)</span>
        </div>
<?php   }?>
    
    <br>
        <div class="separatorLine"></div>
    <br>

    <?php
    if(!empty($topics)) {
        foreach($topics as $topic)
            {?>
                <p><?=$topic->getTitle()?></p>
    <?php   }
        }
    else { ?>
            <p>No results :/</p>
    <?php   }?>
