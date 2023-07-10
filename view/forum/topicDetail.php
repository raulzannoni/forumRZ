<?php

    $topic = $result["data"]['topic'];

    $posts = $result["data"]['posts'];

    $postsCount = $result["data"]['NbPosts'];

    if (!empty($result["data"]['categories'])) {
        $categories = $result["data"]['categories'];
    }

    if (!empty($result["data"]['userConnectedRoleFromBdd'])) {
        $userConnectedRoleFromBdd = $result["data"]['userConnectedRoleFromBdd'];
    }
/*
    if(App\Session::getUser()) {
        if($topic->getUser()->getId() == $_SESSION["user"]->getId()) {
            $authorTopicClass = "authorTopic";
        }
        else {
            $authorTopicClass = "";
        }
    }
    else {
        $authorTopicClass = "";
    }
*/
?>

<div class="topicDetailHeader">

        <div class="titleDiv">
            <h1 class="titleUnderline">Topic n°<?= $topic->getId()?></h1>
            
        </div>
        <br>
        <div class="categoryAndNbPostsLine">
        <?php
            if((empty($userConnectedRoleFromBdd)) || ($userConnectedRoleFromBdd == "ROLE_USER")) {
            ?>
                <span><a href="index.php?ctrl=forum&action=listTopicByCat&id=<?= $topic->getCategory()->getId() ?>&categoryName=<?= $topic->getCategory()->getName() ?>">(<?= $topic->getCategory()->getName() ?>)</a></span>
            <?php
            } 
            else {
            ?>
                <form action="index.php?ctrl=forum&action=changeTopicCategory&id=<?= $topic->getId() ?>" method="post">
                    <select name="category_Select" id="category_Select" onchange='this.form.submit()'>
                        <?php 
                        foreach ($categories as $category) {
                            // Si Topic->Categorie->name = Category->name alors $selected="selected"
                            if($topic->getCategory()->getId() == $category->getId()) {
                                $selected = "selected";
                            }
                            else {
                                $selected = "";
                            }
                        ?>
                        <option value="<?= $category->getId() ?>" <?=$selected?>><?= $category->getName() ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <noscript><input type="submit" value="change"></noscript>
                </form>
            <?php
            }
            ?>
            <span class="topicDetailNbrPosts">N° of posts: <?= "blqllo" ?>  
                <i class="fa-solid fa-comments"></i>
            </span>
        </div>
        <?php
    if (isset($posts)) {
        foreach ($posts as $post) {
            // Check si l'user est auteur du post
            if(App\Session::getUser()) {
                if ($post->getUserId() == $_SESSION["user"]->getId()) {
                    $authorPostClass = "authorPostClass";
                }
                else {
                    $authorPostClass = "";
                }
            }
            else {
                $authorPostClass = "";
            } ?>

        <div class="postCard">
            <p class="postText"><?= $post->getText() ?></p>
                <div class="postCardBottomLine">
                    <!-- like -->
                </div>
            <?php
            }
            ?>

            <span class="postInfos">by 
                <a class="<?= $authorPostClass ?>" href="index.php?ctrl=security&action=viewUserProfile&id=<?= $post->getUserId() ?>">
                <?= $post->getUser()->getUsername() ?>
                </a>, at <?= $post->getCreationdate() ?>
            </span>

        </div>

    <?php
    }
    else {?>
        <p class="postCard">No posts</p>
<?php   }?>

