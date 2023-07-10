<?php

    $topics = $result["data"]['topics'];
    $posts = $result["data"]['posts'];
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

    <form class="searchForm" action="index.php?ctrl=forum&action=search" method="post">
        <div class="searchDiv">
            <input type ="text" name="searchInput" placeholder="Keyword" required>
            <input id="searchSubmit" type="submit" value="Search">
        </div>            
    </form>
    
    <br>
        <div class="separatorLine"></div>
    <br>

    <?php
    var_dump($topics);
    if(!empty($topics)) {
        foreach($topics as $topic)
            {
                //var_dump($topic);
                /*
                $dateTopic = new DateTime(trim(str_replace("/", "-", $topic->getCreationdate()), ","), new DateTimeZone("+0000"));

                $dateNow = new DateTime(date("Y-m-d H:i:s"), new DateTimeZone("+0000"));

                $dateDiff = $dateTopic->diff($dateNow);
                $dateDiffText = $dateDiff->format("%dj %Hh %im ago");*/ 
                ?>
                <a href="index.php?ctrl=forum&action=topicDetail&id=<?=$topic->getId()?>">
                    <div class="topicCard">
                        <div class="topicCardHeader">
                            <span class="topicCardTitleLine">
                                <span class="topicCardTitle"><?=$topic->getTitle()?></span>
                            </span>
                            <div class="topicHeaderRight">
                                <span class="categoryLabel"><?=$topic->getCategory()->getName()?></span>
                            </div>
                        </div>
                    </div>
                </a>
                <p><?=$topic->getNbPosts()?></p>
                
    <?php   }
        }
    else { ?>
            <p>No results :/</p>
    <?php   }?>
